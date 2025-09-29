<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPaid implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order; // bisa isi id order, status, worker_id, dsb.
    }

    public function broadcastOn()
    {
        // channel broadcast (public/private)
        return new Channel('orders');  
        // kalau worker spesifik: return new PrivateChannel('worker.'.$this->order->worker_id);
    }

    public function broadcastAs()
    {
        return 'order.paid';
    }
}
