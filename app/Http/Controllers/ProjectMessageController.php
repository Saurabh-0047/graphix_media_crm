<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMessageModel;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\DB;



class ProjectMessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'new_message' => 'required|string',
            'user_id' => 'required|string',
            'project_id' => 'required|string',
        ]);

        ProjectMessageModel::create([
            'message' => $request->new_message,
            'sent_by_user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sender = DB::table('tb_users')
        ->where('user_id', $request->user_id)
        ->first();

    if (!$sender) {
        // If not found in tb_users, check tb_admin
        $sender = DB::table('tb_admin')
            ->where('user_id', $request->user_id)
            ->first();
    }

    // Get sender's name or default to 'Unknown Sender'
    $sender_name = $sender ? $sender->user_name : 'Unknown Sender';


    $project = DB::table('tb_projects')  // Adjust to the actual table name
        ->where('id', $request->project_id)
        ->first();
        if (!$project) {
            // Handle case where project is not found
            return response()->json(['error' => 'Project not found'], 404);
        };

     $assigned_ids = trim($project->assigned_to, '\"');  // Remove outer quotes
    $assigned_ids_array = explode(',', $assigned_ids); // Convert to array
    $assigned_ids_array = array_map('trim', $assigned_ids_array); // Remove any extra spaces

    // Fetch user IDs from tb_users
    $users = DB::table('tb_users')
        ->whereIn('id', $assigned_ids_array)
        ->pluck('user_id')
        ->toArray();

    // Encode user IDs to JSON
    $unread_by = json_encode($users);



    $notification = new NotificationModel();
    $notification->heading = 'New Message';
    $notification->message = "$sender_name Sent A Message";
    $notification->unread_by = $unread_by;  // Insert JSON array of user IDs
    $notification->project_id = $request->project_id;
    $notification->read_by = json_encode([]);
    $notification->save();
}
    
    // In your controller
    public function fetchMessages(Request $request)
{
    $project_id = $request->input('project_id');

    $messages = ProjectMessageModel::where('project_id', $project_id)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($message) {
            // Attempt to find the sender in tb_users
            $sender = DB::table('tb_users')
                ->where('user_id', $message->sent_by_user_id)
                ->first();

            if (!$sender) {
                // If not found in tb_users, check tb_admin
                $sender = DB::table('tb_admin')
                    ->where('user_id', $message->sent_by_user_id)
                    ->first();
            }

            $message->sender_name = $sender ? $sender->user_name : 'Unknown Sender';
            return $message;
        });

    return response()->json($messages);
}

    

}
