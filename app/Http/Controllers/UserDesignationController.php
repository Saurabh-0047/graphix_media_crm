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

    public function edit($id)
    {
        $designations = UserDesignationModel::findOrFail($id);

        return view('admin.user_designation_edit', compact('designations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'required|string|max:255',
        ]);

        $user_deisgnation = UserDesignationModel::findOrFail($id);
        $user_deisgnation->update([
            'designation' => $request->input('designation'),
        ]);

        return redirect()->route('admin.user_designation')->with('success', 'Designation updated successfully.');
    }

    public function toggleStatus($id)
{
    $user_designation = UserDesignationModel::findOrFail($id);
    $user_designation->status = $user_designation->status == 1 ? 0 : 1;
    $user_designation->save();
    return redirect()->route('admin.user_designation')->with('success', 'Designation status updated successfully.');
}

}
