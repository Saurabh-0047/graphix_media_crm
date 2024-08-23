<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\ProjectMessageModel;
use App\Models\NotificationModel;
use App\Models\AssignedProjectModel;
use App\Models\ServiceModel;
use App\Models\UserModel;
use App\Models\ModuleModel;
use Illuminate\Support\Facades\Auth;




class ProjectController extends Controller
{
    public function index()
    {
        $projects = ProjectModel::all();
        return view('admin.projects', ['projects' => $projects]);
    }

    public function add_projects()
    {
        $services = ServiceModel::all();
        $users = UserModel::all();
        return view('admin.add_projects', ['services' => $services, 'users' => $users]);
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
        'assigned_to' => 'required|array',
        'modules.*.heading' => 'required|string|max:255',
        'modules.*.description' => 'nullable|string',
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

    // Save modules
    if ($request->has('modules')) {
        foreach ($request->modules as $module) {
            ModuleModel::create([
                'project_id' => $project->id,
                'module_heading' => $module['heading'],
                'module_description' => $module['description'] ?? '',
                'module_status' => 'Pending',
            ]);
        }
    }

    // Create a new notification
    $notification = new NotificationModel();
    $notification->heading = 'Project Assigned';
    $notification->message = 'New Project Assigned To You By Admin';
    $notification->project_id = $project->id;
    $notification->unread_by = $assigned_user_ids_json;
    $notification->read_by = json_encode([]);
    $notification->save();

    // Assign project to users
    foreach ($assigned_ids as $user_id) {
        AssignedProjectModel::create([
            'project_id' => $project->id,
            'user_id' => $user_id,
        ]);
    }

    return redirect()->route('admin.add_project.post')->with('success', 'Project added successfully!');
}




public function project_details($id)
{
    $project_details = ProjectModel::with(['user', 'modules.user'])->findOrFail($id);
    $project_messages = ProjectMessageModel::with('user')
        ->where('project_id', $id)
        ->get();

    return view('admin.project_details', compact('project_details', 'project_messages'));
}



    //Users Part 

    public function __construct()
    {
        $this->middleware('auth'); // For users, this should ensure authentication
    }

    public function user_projects()
{
    $userId = Auth::id(); // Get the authenticated user's ID

    // Get all project IDs assigned to this user
    $assignedProjects = AssignedProjectModel::where('user_id', $userId)->pluck('project_id')->toArray();

    // Get all project details for these project IDs
    $projects = ProjectModel::whereIn('id', $assignedProjects)->get();

    return view('user.all_projects', ['projects' => $projects]);
}


public function user_all_projects()
    {
        $projects = ProjectModel::all();
        return view('user.all_projects', ['projects' => $projects]);
    }

    
 
    public function user_project_details($id)
    {
        $project_details = ProjectModel::with(['user', 'modules.user'])->findOrFail($id);
        $project_messages = ProjectMessageModel::with('user')
            ->where('project_id', $id)
            ->get();
        return view('user.project_details', compact('project_details', 'project_messages'));
    }
    

    
}
