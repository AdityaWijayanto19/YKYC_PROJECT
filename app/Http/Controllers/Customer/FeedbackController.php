<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{

    public function create($orderId)
    {

        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        if ($order->status->name !== 'completed') {
            return redirect()->route('customer.history')->with('error', 'Pesanan ini belum selesai.');
        }

        if ($order->feedback) {
            return redirect()->route('customer.history')->with('warning', 'Anda sudah pernah memberi feedback untuk pesanan ini.');
        }

        return view('customer.feedback', ['order' => $order]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => [
                'required',
                'exists:orders,id',
                Rule::unique('feedbacks', 'order_id')
            ],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = Order::find($validated['order_id']);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        $feedback = Feedback::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'worker_id' => $order->worker_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $worker = $order->worker;

        if ($worker) {
            $completedStatusId = Status::where('name', 'completed')->value('id');

            $totalOrders = $worker->orders()
                ->where('status_id', $completedStatusId)
                ->count();

            $averageRating = Feedback::where('worker_id', $worker->id)->avg('rating') ?? 0;

            $worker->update([
                'total_orders' => $totalOrders,
                'average_rating' => round($averageRating, 2),
            ]);
        }

        return redirect()->route('customer.history')
            ->with('success', 'Terima kasih! Feedback Anda telah kami terima.');
    }
}
