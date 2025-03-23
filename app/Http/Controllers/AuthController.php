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
        $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'user_name' => $request->user_name,
            'role_id' => 2, 
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['user_name' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Welcome to your dashboard!');
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
