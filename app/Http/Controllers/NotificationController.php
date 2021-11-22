<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\False_;

class NotificationController extends Controller
{
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $notifications = Auth::user()->unreadNotifications;
            $html = view('partials.notifications', [
                'notifications' => $notifications,
            ])->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => "Successfully retrieved notifications.",
            ]);
        }
        return false;
    }

    public function show(Request $request)
    {
        Auth::user()->unreadNotifications->where('id', $request->id)->markAsRead();;
        $notifications = Auth::user()->notifications->all();
        return view("notifications.notifications-list", ['notifications' => $notifications]);
    }
}
