<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications count (for AJAX).
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications (for dropdown).
     */
    public function getRecent()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'icon' => $notification->icon ?? 'fas fa-bell',
                    'color' => $notification->color ?? 'blue',
                    'link' => $notification->link,
                    'created_at' => $notification->created_at->toIso8601String(),
                    'is_read' => $notification->is_read,
                ];
            });

        $unreadCount = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        return response()->json(['success' => true]);
    }
}
