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
        $incomeToday = Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_price');
        $incomeThisMonth = Order::where('payment_status', 'paid')->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('total_price');
        $incomeThisYear = Order::where('payment_status', 'paid')->whereYear('created_at', now()->year)->sum('total_price');

        $monthlyRevenue = Order::select(
                DB::raw('SUM(total_price) as revenue'),
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name") 
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month_name')
            ->orderByRaw("MIN(created_at) ASC") 
            ->get();
            
        $chartLabels = $monthlyRevenue->pluck('month_name');
        $chartData = $monthlyRevenue->pluck('revenue');

        $todayTransactions = Order::with('user')
            ->whereDate('created_at', today())
            ->latest()
            ->take(5)
            ->get();
            
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