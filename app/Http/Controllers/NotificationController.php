<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10); 

        if ($user->role === 'worker') {
            return view('worker.notifications', compact('notifications'));
        }

        return view('customer.notifications', compact('notifications'));
    }

    public function fetch()
    {
        $user = Auth::user();
        
        $notifications = $user->notifications()->where('is_read', false)->get();
        
        return response()->json([
            'unread_count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        $user->notifications()->where('is_read', false)->update(['is_read' => true]);
        
        return response()->json(['status' => 'success']);
    }
}