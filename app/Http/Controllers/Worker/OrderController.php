<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Status; 
use App\Http\Traits\Notifiable;

class OrderController extends Controller
{
    public function activeOrders()
    {
        $worker = Auth::user()->worker;

        $excludedStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $query = Order::with('user', 'service', 'status')
            ->where('worker_id', $worker->id)
            ->where('payment_status', 'paid')
            ->whereNotIn('status_id', $excludedStatusIds) 
            ->orderBy('created_at', 'desc');

        if ($worker->worker_type === 'Keliling') {
            $active_orders = $query->limit(1)->get();
        } else {
            $active_orders = $query->get();
        }

        return view('worker.pesanan-actived', compact('active_orders', 'worker'));
    }

    public function historyOrders()
    {
        $worker = Auth::user()->worker;

        $historyStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        $history_orders = Order::with('user', 'service', 'status')
            ->where('worker_id', $worker->id)
            ->whereIn('status_id', $historyStatusIds) 
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('worker.history-pesanan', compact('history_orders', 'worker'));
    }
}