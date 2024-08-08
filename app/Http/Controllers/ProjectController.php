<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
class ProjectController extends Controller
{
    public function index(){
        $projects = ProjectModel::all();
        return view('admin.projects',['projects' => $projects]);
    }
}
