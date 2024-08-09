<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
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

        $servicesString = implode(',', $request->packages);
        $assigned_ids = implode(',', $request->assigned_to);
        

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
        $project->assigned_to = $assigned_ids;
        
        $project->save();

        return redirect()->route('admin.add_project.post')->with('success', 'Project added successfully!');
    }

}
