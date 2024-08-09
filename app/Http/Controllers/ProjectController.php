<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\ProjectMessageModel;
use App\Models\NotificationModel;
use App\Models\ServiceModel;
use App\Models\UserModel;

class ProjectController extends Controller
{
    public function index(){
        $projects = ProjectModel::all();

        
        return view('admin.projects',['projects' => $projects]);
    }

    public function add_projects(){
        $services = ServiceModel::all();
        $users = UserModel::all();
        return view('admin.add_projects',['services'=>$services,'users'=>$users]);
    }

    public function save_project(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'email_id' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'packages' => 'required|array',
            'remarks' => 'nullable|string',
            'sold_by_id' => 'required|integer|exists:tb_users,id',
            'assigned_to'=> 'required|array',
        ]);
    
        // Get the list of assigned user IDs
        $assigned_ids = $request->assigned_to;
    
        // Retrieve user_ids for the assigned IDs
        $assigned_user_ids = UserModel::whereIn('id', $assigned_ids)->pluck('user_id')->toArray();
        
        // Convert user_ids to a JSON string
        $assigned_user_ids_json = json_encode($assigned_user_ids);
    
        // Convert packages array to a comma-separated string
        $servicesString = implode(',', $request->packages);
    
        // Create a new project instance
        $project = new ProjectModel();
        $project->business_name = $request->business_name;
        $project->client_name = $request->client_name;
        $project->contact_no = $request->contact_no;
        $project->email_id = $request->email_id;
        $project->address = $request->address;
        $project->website = $request->website ?? '';
        $project->packages = $servicesString;
        $project->remarks = $request->remarks ?? '';
        $project->sold_by_id = $request->sold_by_id;
        $project->assigned_to = implode(',', $assigned_ids);
    
        // Save the project
        $project->save();
    
        // Create a new notification
        $notification = new NotificationModel();
        $notification->heading = 'Project Assigned';
        $notification->message = 'New Project Assigned To You By Admin';
        $notification->project_id = $project->id;
        $notification->unread_by = $assigned_user_ids_json;
        $notification->read_by = json_encode([]);
        $notification->save();
    
        // Redirect with success message
        return redirect()->route('admin.add_project.post')->with('success', 'Project added successfully!');
    }
    

    public function project_details($id)
    {
        $project_details = ProjectModel::findOrFail($id);
        
        // Eager load the user relationship to avoid N+1 query problem
        $project_messages = ProjectMessageModel::with('user')
        ->where('project_id', $id)
        ->get();        
        // Return a view with both project details and messages
        return view('admin.project_details', compact('project_details', 'project_messages'));
    }
    

    
   
}
