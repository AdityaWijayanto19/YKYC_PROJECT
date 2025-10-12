<?php

namespace App\Http\Controllers\Worker;

// Impor kelas-kelas yang dibutuhkan
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use App\Events\OrderStatusUpdated;
use App\Events\WorkerLocationUpdated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $worker = Auth::user()->worker;

        $excludedStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $ordersQuery = Order::with('user', 'service', 'status')
            ->where('worker_id', $worker->id)
            ->whereNotIn('status_id', $excludedStatusIds) 
            ->orderBy('created_at', 'asc');

        if ($worker->worker_type === 'Keliling') {
            $orders = $ordersQuery->limit(1)->get();
        } else {
            $orders = $ordersQuery->get();
        }

        return view('worker.dashboard', [
            'worker' => $worker,
            'orders' => $orders
        ]);
    }

    public function toggleActiveStatus(Request $request)
    {
        $worker = Auth::user()->worker;

        $worker->is_active = $request->input('is_active', false);
        $worker->save();

        return response()->json(['success' => true, 'is_active' => $worker->is_active]);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        if ($order->worker_id !== Auth::user()->worker->id) {
            abort(403, 'Akses Ditolak.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'exists:statuses,name']
        ]);

        $newStatus = Status::where('name', $validated['status'])->firstOrFail();

        $order->status_id = $newStatus->id;
        $order->save();

        $order->load('status');

        OrderStatusUpdated::dispatch($order);

        return redirect()->back()->with('success', 'Status pesanan berhasil diubah!');
    }

    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
        ]);

        $worker = Auth::user()->worker;

        $worker->current_latitude = $validated['lat'];
        $worker->current_longitude = $validated['lng'];
        $worker->save();

        $trackableStatusIds = Status::whereIn('name', ['waiting', 'on-the-way'])->pluck('id');

        $activeOrder = Order::where('worker_id', $worker->id)
            ->whereIn('status_id', $trackableStatusIds) 
            ->first();

        if ($activeOrder) {
            WorkerLocationUpdated::dispatch($activeOrder, $worker->current_latitude, $worker->current_longitude);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
