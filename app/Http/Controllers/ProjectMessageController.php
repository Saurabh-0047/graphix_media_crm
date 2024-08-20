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

    // Create the project message
    ProjectMessageModel::create([
        'message' => $request->new_message,
        'sent_by_user_id' => $request->user_id,
        'project_id' => $request->project_id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Get sender's information
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

    // Get project details
    $project = DB::table('tb_projects')  // Adjust to the actual table name
        ->where('id', $request->project_id)
        ->first();
    if (!$project) {
        // Handle case where project is not found
        return response()->json(['error' => 'Project not found'], 404);
    }

    // Parse assigned user IDs from the project
    $assigned_ids = trim($project->assigned_to, '\"');  // Remove outer quotes
    $assigned_ids_array = explode(',', $assigned_ids); // Convert to array
    $assigned_ids_array = array_map('trim', $assigned_ids_array); // Remove any extra spaces

    // Fetch user IDs from tb_users
    $user_ids_from_users = DB::table('tb_users')
        ->whereIn('id', $assigned_ids_array)
        ->pluck('user_id')
        ->toArray();

    // Fetch all user IDs from tb_admin
    $user_ids_from_admins = DB::table('tb_admin')
        ->pluck('user_id')
        ->toArray();

    // Combine both arrays and remove duplicates
    $all_user_ids = array_unique(array_merge($user_ids_from_users, $user_ids_from_admins));

    // Encode user IDs to JSON
    $unread_by = json_encode($all_user_ids);

    // Create and save the notification
    $notification = new NotificationModel();
    $notification->heading = 'New Message';
    $notification->message = "$sender_name Sent A Message";
    $notification->unread_by = $unread_by;  // Insert JSON array of user IDs
    $notification->project_id = $request->project_id;
    $notification->read_by = json_encode([]);
    $notification->save();

    return response()->json(['success' => 'Message and notification created successfully']);
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

    //For USers

    public function user_fetchMessages(Request $request)
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


public function user_store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'new_message' => 'required|string',
        'user_id' => 'required|string',
        'project_id' => 'required|string',
    ]);

    // Create the project message
    ProjectMessageModel::create([
        'message' => $request->new_message,
        'sent_by_user_id' => $request->user_id,
        'project_id' => $request->project_id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Get sender's information
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

    // Get project details
    $project = DB::table('tb_projects')  // Adjust to the actual table name
        ->where('id', $request->project_id)
        ->first();
    if (!$project) {
        // Handle case where project is not found
        return response()->json(['error' => 'Project not found'], 404);
    }

    // Parse assigned user IDs from the project
    $assigned_ids = trim($project->assigned_to, '\"');  // Remove outer quotes
    $assigned_ids_array = explode(',', $assigned_ids); // Convert to array
    $assigned_ids_array = array_map('trim', $assigned_ids_array); // Remove any extra spaces

    // Fetch user IDs from tb_users
    $user_ids_from_users = DB::table('tb_users')
        ->whereIn('id', $assigned_ids_array)
        ->pluck('user_id')
        ->toArray();

    // Fetch all user IDs from tb_admin
    $user_ids_from_admins = DB::table('tb_admin')
        ->pluck('user_id')
        ->toArray();

    // Combine both arrays and remove duplicates
    $all_user_ids = array_unique(array_merge($user_ids_from_users, $user_ids_from_admins));

    // Encode user IDs to JSON
    $unread_by = json_encode($all_user_ids);

    // Create and save the notification
    $notification = new NotificationModel();
    $notification->heading = 'New Message';
    $notification->message = "$sender_name Sent A Message";
    $notification->unread_by = $unread_by;  // Insert JSON array of user IDs
    $notification->project_id = $request->project_id;
    $notification->read_by = json_encode([]);
    $notification->save();

    return response()->json(['success' => 'Message and notification created successfully']);
}

}
