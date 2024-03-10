<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Login function
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);
        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/admin/dashboard');
        }
        // Authentication failed
        return back()->withErrors(['email' => 'بيانات خاطئة'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
