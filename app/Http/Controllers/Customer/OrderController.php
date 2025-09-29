<?php

namespace App\Http\Controllers\Customer;

use App\Models\Service;  // <-- Tambahkan ini untuk mengambil data layanan
use App\Models\Location; // <-- Tambahkan ini untuk mengambil data lokasi
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // <-- Tambahkan ini untuk menangani data dari form
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Method ini bertugas untuk MENAMPILKAN halaman form pembuatan order.
     */
    public function create()
    {
        $services = Service::all();
        $locations = Location::all();

        return view('customer.order', [
            'services' => $services,
            'locations' => $locations,
        ]);
    }

    /**
     * Method ini bertugas untuk MEMPROSES data yang dikirim dari form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'delivery_method' => ['required', Rule::in(['drop-off', 'pickup'])],
            'location_id' => ['required_if:delivery_method,drop-off', 'nullable', 'exists:locations,id'],
            'address' => ['required_if:delivery_method,pickup', 'nullable', 'string', 'max:500'],
        ]);


        $service = Service::find($validated['service_id']);
        $deliveryFee = ($validated['delivery_method'] === 'pickup') ? 15000 : 0; // Sebaiknya nilai ini disimpan di config
        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $validated['service_id'],
            'delivery_method' => $validated['delivery_method'],
            'location_id' => $validated['location_id'] ?? null,
            'customer_address' => $validated['address'] ?? null,
            'service_price' => $service->price,
            'delivery_fee' => $deliveryFee,
            'total_price' => $service->price + $deliveryFee,
            'status' => 'pending', // Status pengerjaan
            'payment_status' => 'pending', // Status PEMBAYARAN
        ]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false); // false untuk sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $uniqueOrderId = 'YKYC-' . $order->id . '-' . Str::random(5);

        $order->order_id = $uniqueOrderId;
        $order->save();

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->order_id = $uniqueOrderId;
        $order->snap_token = $snapToken;
        $order->save();

        return redirect()->route('customer.order.payment', $order);
    }

    public function payment(Order $order)
    {
        if (!Auth::check() || $order->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK DIIZINKAN MENGAKSES HALAMAN INI.');
        }

        if ($order->payment_status === 'paid') {
            // Jika sudah lunas, kembalikan ke halaman status dengan pesan.
            return redirect()->route('customer.order.status')
                ->with('info', 'Pesanan dengan ID ' . $order->order_id . ' sudah lunas.');
        }

        return view('customer.order-payment', [
            'order' => $order
        ]);
    }

    public function status()
    {
        $userId = Auth::id();

        // Ambil semua order aktif customer, beserta relasi service dan worker
        $active_orders = Order::with(['service', 'worker'])
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'diproses', 'In Progress', 'Ready for Pickup'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.order_status', compact('active_orders'));
    }
}
