<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Data Pemasukkan Keuangan (Menggunakan kolom dari migrasi Anda: 'payment_status' dan 'total_price')
        $incomeToday = Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_price');
        $incomeThisMonth = Order::where('payment_status', 'paid')->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('total_price');
        $incomeThisYear = Order::where('payment_status', 'paid')->whereYear('created_at', now()->year)->sum('total_price');

        // 2. Data untuk Grafik Pendapatan Bulanan
        $monthlyRevenue = Order::select(
                DB::raw('SUM(total_price) as revenue'),
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name") // Menggunakan format nama bulan
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month_name')
            ->orderByRaw("MIN(created_at) ASC") // Urutkan berdasarkan tanggal bulan
            ->get();
            
        $chartLabels = $monthlyRevenue->pluck('month_name');
        $chartData = $monthlyRevenue->pluck('revenue');

        // 3. Riwayat Transaksi Hari Ini (Menggunakan relasi 'user' dari model Order)
        $todayTransactions = Order::with('user')
            ->whereDate('created_at', today())
            ->latest()
            ->take(5)
            ->get();
            
        // 4. Jadwal Admin (Fitur ini bisa diimplementasikan nanti dengan modelnya sendiri)
        $schedules = [];

        return view('admin.dashboard', compact(
            'incomeToday',
            'incomeThisMonth',
            'incomeThisYear',
            'chartLabels',
            'chartData',
            'todayTransactions',
            'schedules'
        ));
    }

      public function peraturan()
    {
        return view('admin.peraturan');
    }
}