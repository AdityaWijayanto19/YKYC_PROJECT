<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            // Log raw request untuk debugging
            Log::info('Midtrans Callback - Raw Request:', [
                'body' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            // Buat notification object dari Midtrans
            $notification = new \Midtrans\Notification();

            $status = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status ?? 'accept';

            Log::info('Midtrans Callback - Parsed Notification:', [
                'order_id' => $orderId,
                'status' => $status,
                'type' => $type,
                'fraud' => $fraud
            ]);

            // Cari order berdasarkan order_id
            $order = Order::where('order_id', $orderId)->first();

            if (!$order) {
                Log::error("Midtrans callback: Order $orderId not found");
                return response()->json(['message' => 'Order not found'], 404);
            }

            Log::info('Midtrans Callback - Order Found:', [
                'id' => $order->id,
                'current_payment_status' => $order->payment_status
            ]);

            // Jika sudah paid, skip
            if ($order->payment_status === 'paid') {
                Log::info("Midtrans callback: Order $orderId already paid");
                return response()->json(['message' => 'Payment already processed'], 200);
            }

            // Handle berdasarkan transaction status
            switch ($status) {
                case 'capture':
                    if ($type === 'credit_card') {
                        if ($fraud === 'accept') {
                            $order->payment_status = 'paid';
                            Log::info("Order $orderId marked as paid (capture)");
                        }
                    }
                    break;

                case 'settlement':
                    $order->payment_status = 'paid';
                    Log::info("Order $orderId marked as paid (settlement)");
                    break;

                case 'pending':
                    $order->payment_status = 'pending';
                    Log::info("Order $orderId marked as pending");
                    break;

                case 'deny':
                    $order->payment_status = 'failed';
                    $statusModel = Status::where('name', 'dibatalkan')->first();
                    if ($statusModel) {
                        $order->status_id = $statusModel->id;
                    }
                    Log::info("Order $orderId marked as failed (denied)");
                    break;

                case 'expire':
                    $order->payment_status = 'failed';
                    $statusModel = Status::where('name', 'dibatalkan')->first();
                    if ($statusModel) {
                        $order->status_id = $statusModel->id;
                    }
                    Log::info("Order $orderId marked as failed (expired)");
                    break;

                case 'cancel':
                    $order->payment_status = 'failed';
                    $statusModel = Status::where('name', 'dibatalkan')->first();
                    if ($statusModel) {
                        $order->status_id = $statusModel->id;
                    }
                    Log::info("Order $orderId marked as failed (cancelled)");
                    break;
            }

            // Save perubahan
            $order->save();

            Log::info("Midtrans callback processed successfully", [
                'order_id' => $orderId,
                'new_payment_status' => $order->payment_status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Notification processed successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Internal server error'
            ], 500);
        }
    }
}