<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMessageModel;
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
