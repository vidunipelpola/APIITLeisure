<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications for the authenticated user
     */
    public function unread()
    {
        // Reset all booking notifications to unread on each login
        Notification::where('user_id', auth()->id())
            ->where('type', 'booking')
            ->update(['is_read' => false]);

        // Get upcoming bookings notifications
        $notifications = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->where('type', 'booking')
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter out past bookings
        $notifications = $notifications->filter(function ($notification) {
            if (preg_match('/Date: (.*?)\nTime:/', $notification->message, $matches)) {
                $bookingDate = Carbon::parse($matches[1]);
                return $bookingDate->isFuture();
            }
            return true;
        });

        return response()->json([
            'notifications' => $notifications->values()
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        $count = Auth::user()->notifications()->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}
