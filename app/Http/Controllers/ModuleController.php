<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleModel;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function accept($id)
    {
        // Fetch the module by its ID
        $module = ModuleModel::findOrFail($id);

        // Update the module's user_id with the currently logged-in user's ID
        $module->user_id = Auth::id(); // Ensure the user is authenticated
        $module->module_status = 'Accepted'; // Optionally update the status as well
        $module->save();

        // Send a notification
        $this->sendNotification($module->project_id, 'Accepted', 'Accepted A Module');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Module accepted successfully.');
    }

    public function complete($id)
    {
        // Fetch the module by its ID
        $module = ModuleModel::findOrFail($id);

        // Ensure the module status is 'Accepted' before marking it as completed
        if ($module->module_status != 'Accepted') {
            return redirect()->back()->with('error', 'Module must be accepted before it can be completed.');
        }

        // Update the module's status to 'Completed'
        $module->module_status = 'Completed';
        $module->save();

        // Send a notification
        $this->sendNotification($module->project_id, 'Completed', 'Completed A Module');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Module marked as completed successfully.');
    }

    private function sendNotification($projectId, $status, $action)
    {
        // Get project details
        $project = DB::table('tb_projects')
            ->where('id', $projectId)
            ->first();

        if (!$project) {
            // Handle case where project is not found
            return;
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

        // Get sender's name from tb_users or tb_admin
        $sender = DB::table('tb_users')
            ->where('id', Auth::id())
            ->first();

        if (!$sender) {
            // If not found in tb_users, check tb_admin
            $sender = DB::table('tb_admin')
                ->where('id', Auth::id())
                ->first();
        }

        // Get sender's name or default to 'Unknown Sender'
        $sender_name = $sender ? $sender->user_name : 'Unknown Sender';

        // Create and save the notification
        $notification = new NotificationModel();
        $notification->heading = "Module $status";
        $notification->message = "$sender_name $action";
        $notification->unread_by = $unread_by;  // Insert JSON array of user IDs
        $notification->project_id = $projectId;
        $notification->read_by = json_encode([]);
        $notification->save();
    }
}
