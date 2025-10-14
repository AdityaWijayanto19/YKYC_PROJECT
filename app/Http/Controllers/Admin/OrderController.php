<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman utama manajemen pesanan dengan filter dan pencarian.
     */
    public function index(Request $request)
    {
        // Mulai query dengan eager loading untuk efisiensi
        $query = Order::with(['user', 'status', 'service']);

        // 1. Logika Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('order_id', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // 2. Logika Filter Status
        if ($request->filled('status_id') && $request->status_id != 'all') {
            $query->where('status_id', $request->status_id);
        }

        // 3. Logika Filter Tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Urutkan berdasarkan yang terbaru dan lakukan paginasi
        $orders = $query->latest()->paginate(10)->withQueryString();

        // Ambil semua status untuk dropdown filter
        $statuses = Status::all();

        return view('admin.pesanan', compact('orders', 'statuses'));
    }

    /**
     * Mengambil data detail satu pesanan untuk ditampilkan di modal (via AJAX).
     */
    public function show(Order $order)
    {
        // Load relasi yang dibutuhkan
        $order->load(['user.customer', 'worker.user', 'status', 'service']);
        return response()->json($order);
    }

    /**
     * Memperbarui status pesanan (via AJAX).
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status_id' => 'required|exists:statuses,id']);

        $order->status_id = $request->status_id;
        $order->save();

        // Kirim status baru sebagai konfirmasi
        $order->load('status');
        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui.',
            'new_status_html' => $this->getStatusBadge($order->status)
        ]);
    }
    
    /**
     * Helper untuk membuat HTML badge status.
     */
    private function getStatusBadge($status)
    {
        $statusName = strtolower($status->name);
        $class = 'text-gray-800 bg-gray-100'; // Default
        
        if (in_array($statusName, ['completed', 'selesai'])) $class = 'text-green-800 bg-green-100';
        elseif (in_array($statusName, ['diproses', 'on-the-way', 'in progress'])) $class = 'text-amber-800 bg-amber-100';
        elseif (in_array($statusName, ['cancelled', 'dibatalkan'])) $class = 'text-red-800 bg-red-100';
        elseif (in_array($statusName, ['pending', 'waiting', 'baru'])) $class = 'text-blue-800 bg-blue-100';
        
        return "<span class='text-sm {$class} px-3 py-1 rounded-full font-semibold'>" . e(ucfirst($status->label)) . "</span>";
    }
}