<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Service;
use App\Models\Status; 

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $worker = Auth::user()->worker;

        // Dapatkan ID dari status yang dianggap sebagai riwayat
        $historyStatusIds = Status::whereIn('name', ['completed', 'cancelled', 'dibatalkan'])->pluck('id');

        // Query utama menggunakan status_id
        $query = Order::where('worker_id', $worker->id)
            ->whereIn('status_id', $historyStatusIds);

        // Bagian filter Anda (sudah benar, tidak perlu diubah)
        if ($request->filled('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }
        if ($request->filled('service_type')) {
            $query->where('service_id', $request->service_type);
        }

        // Eager load relasi termasuk 'status'
        $history = $query->with(['user', 'service', 'status'])->orderBy('updated_at', 'desc')->get();
        $services = Service::pluck('name', 'id');

        if ($request->ajax()) {
            return response()->json(['history' => $history]);
        }

        return view('worker.history-pesanan', compact('history', 'services'));
    }
}
