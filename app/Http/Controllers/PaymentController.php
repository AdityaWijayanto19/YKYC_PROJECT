<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Data transaksi (dummy untuk sandbox)
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10000, // nominal transaksi
            ],
            'customer_details' => [
                'first_name' => 'Aditya',
                'last_name' => 'Wijayanto',
                'email' => 'aditya@example.com',
                'phone' => '081234567890',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout', ['snapToken' => $snapToken]);
    }
}
