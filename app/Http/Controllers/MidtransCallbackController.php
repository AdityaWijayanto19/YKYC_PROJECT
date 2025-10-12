<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\OrderPaid;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function notificationHandler(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            \Log::error("Midtrans callback: Order $orderId not found");
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Payment already processed']);
        }

        \Log::info('Midtrans Notification:', [
            'order_id' => $notification->order_id,
            'transaction_status' => $notification->transaction_status,
            'payment_type' => $notification->payment_type,
            'fraud_status' => $notification->fraud_status,
            'gross_amount' => $notification->gross_amount,
        ]);

        \Log::info('Midtrans Notification:', json_decode(json_encode($notification), true));

        switch ($status) {
            case 'capture':
                if ($type === 'credit_card' && $fraud === 'accept') {
                    $order->payment_status = 'paid';
                    $order->status = 'diproses'; 
                }
                break;
            case 'settlement':
                $order->payment_status = 'paid';
                $order->status = 'diproses'; 
                break;
            case 'pending':
                $order->payment_status = 'pending';
                break;
            case 'deny':
            case 'cancel':
            case 'dibatalkan':
            case 'expire':
                $order->payment_status = 'failed'; 
                $order->status = 'dibatalkan';    
                break;
        }

        $order->save();

        if ($order->payment_status === 'paid') {
            OrderPaid::dispatch($order);
        }

        \Log::info("Midtrans callback processed for order $orderId: status={$order->payment_status}");

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
