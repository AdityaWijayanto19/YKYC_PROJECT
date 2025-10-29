<?php

namespace App\Http\Controllers\Customer;

use App\Models\Service;
use App\Models\Order;
use App\Models\Status;
use App\Models\Worker;
use App\Models\ServiceArea;
use App\Models\Promo;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        $services = Service::all();
        $workers = Worker::where('worker_type', 'Mangkal')->where('is_active', true)->get();
        $serviceArea = ServiceArea::where('is_active', true)->first();
        $polygonForLeaflet = [];
        if ($serviceArea) {
            $geojson = json_decode($serviceArea->polygon_coordinates, true);

            if (!empty($geojson['features'][0]['geometry']['coordinates'][0])) {
                $coordinates = $geojson['features'][0]['geometry']['coordinates'][0];
                foreach ($coordinates as $coord) {
                    if (isset($coord[0], $coord[1])) {
                        $polygonForLeaflet[] = [$coord[1], $coord[0]];
                    }
                }
            }
        }

        $customerLocation = [
            'lat' => Auth::user()->customer?->latitude,
            'lng' => Auth::user()->customer?->longitude,
        ];

        return view('customer.order', [
            'services' => $services,
            'workers' => $workers,
            'serviceAreaPolygon' => $polygonForLeaflet,
            'customerLocation' => $customerLocation,
        ]);
    }
    public function store(Request $request)
    {
        // Log input yang diterima
        \Log::info('Order Store - Input:', $request->all());

        try {
            $validated = $request->validate([
                'service_id' => ['required', 'exists:services,id'],
                'delivery_method' => ['required', Rule::in(['drop-off', 'pickup'])],
                'worker_id' => ['nullable', 'exists:workers,id'],
            ]);

            \Log::info('Order Store - Validated:', $validated);

            $pendingStatus = Status::where('name', 'pending')->first();
            $waitingStatus = Status::where('name', 'waiting')->first();

            if (!$pendingStatus) {
                \Log::error('Status "pending" not found in database');
                return back()->withErrors(['error' => 'Status pending tidak ditemukan di database.'])->withInput();
            }

            \Log::info('Order Store - Pending Status:', ['id' => $pendingStatus->id]);

            $assignedWorkerId = $validated['worker_id'] ?? null;
            $statusId = $pendingStatus->id;
            $nearestWorker = null;

            if ($validated['delivery_method'] === 'pickup') {
                $nearestWorker = $this->findNearestAvailableWorker($request->customer_lat, $request->customer_lng);
                if (!$nearestWorker) {
                    \Log::warning('No available driver found');
                    return back()->withErrors(['error' => 'Maaf, tidak ada worker keliling yang tersedia...'])->withInput();
                }
                $assignedWorkerId = $nearestWorker->id;
                $statusId = Status::where('name', 'waiting_keliling')->value('id');
            } else {
                $statusId = Status::where('name', 'waiting_mangkal')->value('id');
            }

            if (!$statusId) {
                \Log::error('Status ID not found for delivery method: ' . $validated['delivery_method']);
                return back()->withErrors(['error' => 'Status tidak valid.'])->withInput();
            }

            $service = Service::find($validated['service_id']);

            if (!$service) {
                \Log::error('Service not found:', ['service_id' => $validated['service_id']]);
                return back()->withErrors(['error' => 'Layanan tidak ditemukan.'])->withInput();
            }

            $deliveryFee = ($validated['delivery_method'] === 'pickup') ? 15000 : 0;

            $orderData = [
                'user_id' => Auth::id(),
                'service_id' => $validated['service_id'],
                'delivery_method' => $validated['delivery_method'],
                'worker_id' => $assignedWorkerId,
                'customer_lat' => $request->customer_lat ?? null,
                'customer_lng' => $request->customer_lng ?? null,
                'service_price' => $service->price,
                'delivery_fee' => $deliveryFee,
                'total_price' => $service->price + $deliveryFee,
                'status_id' => $statusId,
                'payment_status' => 'pending',
            ];

            \Log::info('Order Store - Creating order with data:', $orderData);

            $order = Order::create($orderData);

            \Log::info('Order Store - Order created:', ['id' => $order->id]);

            // Midtrans Configuration
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $uniqueOrderId = 'YKYC-' . $order->id . '-' . Str::random(5);
            $order->order_id = $uniqueOrderId;
            $order->save();

            \Log::info('Order Store - Order ID updated:', ['order_id' => $uniqueOrderId]);

            $item_details = [
                [
                    'id' => 'SERVICE-' . $order->service->id,
                    'price' => (int) $order->service_price,
                    'quantity' => 1,
                    'name' => $order->service->name,
                ]
            ];

            if ($order->delivery_method === 'pickup' && $order->delivery_fee > 0) {
                $item_details[] = [
                    'id' => 'ONGKIR-01',
                    'price' => (int) $order->delivery_fee,
                    'quantity' => 1,
                    'name' => 'Biaya Jemput & Antar',
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int) $order->total_price,
                ],
                'item_details' => $item_details,
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->number_phone ?? '',
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $order->snap_token = $snapToken;
                $order->save();

                \Log::info('Order Store - Snap token generated:', ['token' => substr($snapToken, 0, 20) . '...']);
            } catch (\Exception $e) {
                \Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
                return back()->withErrors(['error' => 'Gagal membuat token pembayaran. Silakan coba lagi.'])->withInput();
            }

            if ($nearestWorker) {
                // NewOrderAssigned::dispatch($order, $nearestWorker);
            }

            \Log::info('Order Store - Redirecting to payment:', ['order_id' => $order->id]);

            return redirect()->route('customer.order.payment', ['order' => $order->id]);
        } catch (\Exception $e) {
            \Log::error('Order Store - Exception:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    private function findNearestAvailableWorker($customerLat, $customerLng)
    {
        $excludedStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $availableWorkers = Worker::where('worker_type', 'Keliling')
            ->where('is_active', true)
            ->whereDoesntHave('orders', function ($query) use ($excludedStatusIds) {
                $query->whereNotIn('status_id', $excludedStatusIds);
            })
            ->whereNotNull(['current_latitude', 'current_longitude'])
            ->get();

        if ($availableWorkers->isEmpty()) {
            return null;
        }

        $nearestWorker = null;
        $shortestDistance = -1;

        foreach ($availableWorkers as $worker) {
            $distance = $this->haversineDistance($customerLat, $customerLng, $worker->current_latitude, $worker->current_longitude);
            if ($shortestDistance == -1 || $distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestWorker = $worker;
            }
        }
        return $nearestWorker;
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $activePromos = Promo::where('is_active', true)->latest()->get();
        $activeAnnouncements = Announcement::where('is_active', true)->orderBy('order', 'asc')->get();

        $pendingStatusId = Status::where('name', 'pending')->value('id');
        $inProgressStatusIds = Status::whereIn('name', ['waiting', 'on-the-way', 'diproses'])->pluck('id');
        $readyStatusId = Status::where('name', 'ready for pick up')->value('id');

        $countPending = Order::where('user_id', $userId)->where('status_id', $pendingStatusId)->count();
        $countInProgress = Order::where('user_id', $userId)->whereIn('status_id', $inProgressStatusIds)->count();
        $countReady = Order::where('user_id', $userId)->where('status_id', $readyStatusId)->count();

        $recentOrders = Order::with(['service', 'status'])->where('user_id', $userId)->orderBy('created_at', 'desc')->take(3)->get();

        $activeWorkers = Worker::with('user')
            ->where('is_active', true)
            ->where('worker_type', 'Mangkal')
            ->whereNotNull('current_latitude')
            ->whereNotNull('current_longitude')
            ->get();

        $serviceArea = ServiceArea::where('is_active', true)->first();
        $polygonForLeaflet = [];
        if ($serviceArea) {
            $geojson = json_decode($serviceArea->polygon_coordinates, true);
            if (!empty($geojson['features'][0]['geometry']['coordinates'][0])) {
                foreach ($geojson['features'][0]['geometry']['coordinates'][0] as $coord) {
                    $polygonForLeaflet[] = [$coord[1], $coord[0]];
                }
            }
        }

        return view('customer.dashboard', [
            'activePromos' => $activePromos,
            'activeAnnouncements' => $activeAnnouncements,
            'countPending' => $countPending,
            'countInProgress' => $countInProgress,
            'countReady' => $countReady,
            'recentOrders' => $recentOrders,
            'activeWorkers' => $activeWorkers,
            'serviceAreaPolygon' => $polygonForLeaflet,
        ]);
    }

    public function payment(Order $order)
    {
        // Cek authorization
        if (!Auth::check() || $order->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK DIIZINKAN MENGAKSES HALAMAN INI.');
        }

        // Cek jika sudah dibayar
        if ($order->payment_status === 'paid') {
            return redirect()->route('customer.order.status')
                ->with('success', 'Pesanan dengan ID ' . $order->order_id . ' sudah lunas.');
        }

        return view('customer.order-payment', ['order' => $order]);
    }

    public function status()
    {
        $userId = Auth::id();

        $excludedStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $active_orders = Order::with(['service', 'worker', 'status'])
            ->where('user_id', $userId)
            ->whereNotIn('status_id', $excludedStatusIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.order-status', compact('active_orders'));
    }

    public function history()
    {
        $userId = Auth::id();

        $historyStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $history = Order::with(['service', 'worker', 'status'])
            ->where('user_id', $userId)
            ->whereIn('status_id', $historyStatusIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.history', compact('history'));
    }

    public function track(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK...');
        }
        if ($order->delivery_method !== 'pickup') {
            return redirect()->route('customer.status')->with('info', '...');
        }

        $order->load('worker.user', 'status');

        return view('customer.track-order', compact('order'));
    }
}
