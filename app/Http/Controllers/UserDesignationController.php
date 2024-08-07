<?php

namespace App\Http\Controllers;

use App\Models\UserDesignationModel;
use Illuminate\Http\Request;

class UserDesignationController extends Controller
{
    public function index(){
        $designations = UserDesignationModel::all();
        return view('admin.user_designation',['designations'=>$designations]);
    }

    public function submit_data(Request $request)
    {
        $request->validate([
            'designation' => 'required|string|max:255',
        ]);

        $data = $request->only(['designation']);
        UserDesignationModel::create($data);
        return redirect()->route('admin.user_designation')->with('success', 'Designation added successfully!');
    }
}
