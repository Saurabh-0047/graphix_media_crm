<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function unreadCount()
    {
        // Retrieve the currently authenticated user's ID
        $userId = Auth::user()->user_id;

        // Count the number of unread notifications for the current user
        $unreadCount = DB::table('tb_notifications')
            ->whereRaw('JSON_CONTAINS(unread_by, ?)', [json_encode($userId)])
            ->count();

        // Return the count (you can return it as JSON, view data, or whatever fits your use case)
        return response()->json(['unread_count' => $unreadCount]);

    }
}
