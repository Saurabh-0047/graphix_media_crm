<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDesignationModel;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class UserController extends Controller

{
    public function index()
    {
        $designations = UserDesignationModel::all();
        $users = UserModel::all();
        return view('admin.users', ['designations' => $designations, 'user_details' => $users]);
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'designation_id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'user_id' => 'required|string|max:255|unique:tb_users,user_id',
            'user_phone' => 'required|digits:10',
            'user_email' => 'required|email|max:255|unique:tb_users,user_email',
            'password' => [
                'required',
                'string',
                'min:8', // minimum length
                'regex:/[a-zA-Z]/', // at least one letter
                'regex:/[0-9]/', // at least one number
                'regex:/[@$!%*?&]/', // at least one special character
            ],
        ];

        // Custom validation messages
        $messages = [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one letter, one number, and one special character.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Encrypt password
        $hashedPassword = Hash::make($request->input('password'));

        // Save to database
        UserModel::create([
            'designation_id' => $request->input('designation_id'),
            'user_name' => $request->input('user_name'),
            'user_id' => $request->input('user_id'),
            'user_phone' => $request->input('user_phone'),
            'user_email' => $request->input('user_email'),
            'password' => $hashedPassword,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        // Fetch the user and designations
        $user = UserModel::findOrFail($id);
        $designations = UserDesignationModel::all();

        // Pass the user and designations to the view
        return view('admin.users_edit', compact('user', 'designations'));
    }

    public function update(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'designation_id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'user_id' => 'required|string|max:255|unique:tb_users,user_id,' . $id,
            'user_phone' => 'required|digits:10',
            'user_email' => 'required|email|max:255|unique:tb_users,user_email,' . $id,
            'password' => [
                'nullable', // Make password optional during update
                'string',
                'min:8', // minimum length
                'regex:/[a-zA-Z]/', // at least one letter
                'regex:/[0-9]/', // at least one number
                'regex:/[@$!%*?&]/', // at least one special character
            ],
        ];

        // Custom validation messages
        $messages = [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one letter, one number, and one special character.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Find the user to update
        $user = UserModel::findOrFail($id);

        // If a new password is provided, hash it; otherwise, keep the old password
        $hashedPassword = $request->input('password') ? Hash::make($request->input('password')) : $user->password;

        // Update user data
        $user->update([
            'designation_id' => $request->input('designation_id'),
            'user_name' => $request->input('user_name'),
            'user_id' => $request->input('user_id'),
            'user_phone' => $request->input('user_phone'),
            'user_email' => $request->input('user_email'),
            'password' => $hashedPassword,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
{
    // Find the user and delete
    UserModel::destroy($id);

    // Redirect back with a success message
    return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
}

public function toggleStatus($id)
{
    $user = UserModel::findOrFail($id);
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();
    return redirect()->route('admin.users')->with('success', 'User status updated successfully.');
}


}
