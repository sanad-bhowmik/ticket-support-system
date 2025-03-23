<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('components.login');
    }

    public function showSignupForm()
    {
        return view('components.signup');
    }

    public function signup(Request $request)
    {
        // Validate the form input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users', // Unique check for user_name
            'password' => 'required|string|min:6',
        ]);

        // Create the user with role_id set to 2
        User::create([
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'role_id' => 2, // Assign role_id 2 by default
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Redirect to login page with success message
        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['user_name' => $request->username, 'password' => $request->password])) {
            // Authentication passed, redirect to the dashboard
            return redirect()->route('dashboard')->with('success', 'Welcome to your dashboard!');
        }

        // Authentication failed, redirect back to login with error message
        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
