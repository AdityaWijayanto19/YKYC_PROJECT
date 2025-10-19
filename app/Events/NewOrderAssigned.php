<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Worker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    private $worker;

    public function __construct(Order $order, Worker $worker)
    {
        $this->order = $order;
        $this->worker = $worker;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('worker.' . $this->worker->id);
    }

    public function broadcastAs(): string
    {
        return 'new-order-assigned';
    }
}