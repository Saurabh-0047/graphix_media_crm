<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in as Admin
        if (Auth::guard('admin')->attempt(['user_id' => $request->user_id, 'password' => $request->password])) {
            return redirect()->intended('admin/dashboard');
        }

        // Attempt to log in as User
        if (Auth::guard('user')->attempt(['user_id' => $request->user_id, 'password' => $request->password])) {
            return redirect()->intended('user/dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'user_id' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
