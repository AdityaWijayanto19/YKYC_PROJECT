<?php

namespace App\Http\Traits;

use App\Models\Notification;
use App\Models\User;

trait Notifiable
{
    public function sendNotification(User $user, string $title, string $message, string $type, array $data = []): void
    {
        Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'data' => $data,
        ]);
    }
}
