<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
//
        // Redirect to the user dashboard or any desired page after registration
        return redirect()->back()->with('messages', 'Registration successful. Welcome!');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin2')->attempt($credentials)) {
            // Authentication passed for admin, redirect to admin dashboard
            return redirect()->route('userDashboardGET');
        }

        // Authentication failed, redirect back with errors
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin2')->logout();

        return redirect('/')->with('messages', 'Successfully logged out'); // Redirect to the desired page after logout
    }
}
