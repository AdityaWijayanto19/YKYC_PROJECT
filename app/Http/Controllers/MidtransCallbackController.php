<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    /**
     * Ini adalah method utama yang akan menangani notifikasi dari Midtrans.
     */
    public function notificationHandler(Request $request)
    {
        // 1. Set konfigurasi server key Midtrans Anda
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        // 2. Buat instance Midtrans Notification
        $notification = new \Midtrans\Notification();

        // 3. Lakukan validasi signature key untuk keamanan
        // Ini memastikan bahwa notifikasi benar-benar datang dari Midtrans, bukan dari pihak lain.
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Pisahkan ID order asli dari timestamp yang kita tambahkan
        $order = Order::find(explode('-', $orderId)[0]);

        // 4. Periksa apakah order ditemukan
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 5. Periksa apakah status pembayaran sudah 'paid'. Jika ya, jangan lakukan apa-apa.
        // Ini untuk mencegah update ganda jika Midtrans mengirim notifikasi berkali-kali.
        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Payment already processed']);
        }
        
        // 6. Logika utama untuk update status berdasarkan notifikasi
        if ($status == 'capture') {
            // Untuk Tipe Doku/CC
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO: Set transaction status on your database to 'challenge'
                } else {
                    $order->payment_status = 'paid';
                }
            }
        } else if ($status == 'settlement') {
            // Untuk tipe pembayaran lainnya (GoPay, Transfer Bank, dll)
            $order->payment_status = 'paid';
        } else if ($status == 'pending') {
            // TODO: Set transaction status on your database to 'pending'
        } else if ($status == 'deny') {
            $order->payment_status = 'failed';
        } else if ($status == 'expire') {
            $order->payment_status = 'expired';
        } else if ($status == 'cancel') {
            $order->payment_status = 'failed';
        }

        // 7. Simpan perubahan status ke database
        $order->save();

        // 8. Kirim respon OK ke Midtrans agar tidak mengirim notifikasi lagi
        return response()->json(['message' => 'Notification processed successfully']);
    }
}