<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationModel;

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

    public function getNotifications(){

        $userId = Auth::user()->user_id;

        // Fetch notifications from the database
        $notifications = DB::table('tb_notifications')
        
            ->whereRaw('JSON_CONTAINS(unread_by, ?)', [json_encode($userId)])
            ->orWhereRaw('JSON_CONTAINS(read_by, ?)', [json_encode($userId)])
            ->orderBy('id', 'desc')
            ->get();

        // Format the notifications to be returned as JSON
        $formattedNotifications = $notifications->map(function ($notification) {
            return [
                'message' => $notification->message,
                'heading' => $notification->heading,
                'date' => $notification->created_at,
                 'lead_id' => route('project.details', ['id' => $notification->project_id]),
            ];
        });

        return response()->json(['notifications' => $formattedNotifications]);
    }

    public function markAllAsRead(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $userId = $request->input('user_id');

        // Fetch all notifications that the user has not read yet
        $notifications = NotificationModel::whereRaw("JSON_CONTAINS(unread_by, '\"$userId\"')")
            ->get();

        foreach ($notifications as $notification) {
            // Decode JSON arrays
            $unreadBy = json_decode($notification->unread_by, true);
            $readBy = json_decode($notification->read_by, true);

            // Remove the user from unread_by and add to read_by
            if (($key = array_search($userId, $unreadBy)) !== false) {
                unset($unreadBy[$key]);
                $readBy[] = $userId;

                // Update the notification
                $notification->unread_by = json_encode(array_values($unreadBy));
                $notification->read_by = json_encode($readBy);
                $notification->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

}
