<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkerLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Ganti properti menjadi lebih deskriptif
    public $updateData;

    // Ubah parameter constructor untuk menerima object, bukan data mentah
    public function __construct(Order $order, float $lat, float $lng)
    {
        $this->updateData = [
            'order_id' => $order->order_id,
            'user_id' => $order->user_id, // Tetap dibutuhkan untuk nama channel
            'worker_id' => $order->worker_id,
            'latitude' => $lat,
            'longitude' => $lng
        ];
    }

    public function broadcastOn(): array
    {
        // Channel sudah benar!
        return [
            new PrivateChannel('App.Models.User.' . $this->updateData['user_id']),
        ];
    }

    public function broadcastAs(): string
    {
        return 'worker.location.updated';
    }
}
