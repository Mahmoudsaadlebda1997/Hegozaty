<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UserTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='users';
        $users = User::all();
        return view('admin.users.index', compact('users','active'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $active ='users';
        return view('admin.users.create',compact('active'));
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Display the specified user
    public function show(User $user)
    {
        $active ='users';
        return view('users.show', compact('user','active'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $active = 'users';
        return view('users.edit', compact('user','active'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        // Update the user
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
