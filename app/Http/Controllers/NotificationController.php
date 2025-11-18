<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(20);

        // mark unread notifications as read when opening the list
        $user->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));
    }

    public function markAllRead(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('success', 'Semua notifikasi telah ditandai terbaca.');
    }
}