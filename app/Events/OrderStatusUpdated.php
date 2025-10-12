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

class OrderStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderData;

    public function __construct(Order $order)
    {
        $order->loadMissing('user', 'status');

        $this->orderData = [
            'order_id' => $order->order_id,
            'status_name' => $order->status->name,
            'status_label' => $order->status->label,
            'message' => $this->getStatusMessage($order->status->name), 
            'user_id' => $order->user_id,
        ];
    }

    private function getStatusMessage(string $status): string
    {
        return match ($status) {
            'diproses' => 'Pesanan Anda sedang dikerjakan oleh worker kami.',
            'ready for pickup' => 'Sepatu Anda sudah bersih! Pesanan siap untuk diambil.',
            'completed' => 'Pesanan Anda telah selesai. Terima kasih!',
            default => 'Status pesanan Anda telah diperbarui.',
        };
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.' . $this->orderData['user_id']),
        ];
    }

    public function broadcastAs(): string
    {
        return 'order.status.updated';
    }
}
