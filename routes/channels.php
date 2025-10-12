<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('worker.{workerId}', function ($user, $workerId) {
    return $user->is_worker && $user->worker->id == $workerId;
});
