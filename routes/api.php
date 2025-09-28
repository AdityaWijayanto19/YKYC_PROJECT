<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallbackController;

Route::get('/user', function (\Illuminate\Http\Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/midtrans-callback', [MidtransCallbackController::class, 'notificationHandler']);
