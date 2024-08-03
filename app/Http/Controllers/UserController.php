<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UserTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='users';
        $users = User::where('id', '!=', 1)->paginate(5);
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
            'address' => 'nullable',
            'role' => ['required', Rule::in(['admin', 'customer'])], // Role should be either admin or customer
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        // Handle image upload
        $imagePath = $request->file('image')->store('user_images', 'public');

        User::create(array_merge($request->except('image'), ['image' => $imagePath]));
        return redirect()->route('users.index')->with('success', 'تم تسجيل العضوية بنجاح');
    }

    // Display the specified user
    public function show(User $user)
    {
        $active ='users';
        return view('admin.users.show', compact('user','active'));
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $active = 'users';
        return view('admin.users.edit', compact('user','active'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'address' => 'nullable',
            'role' => ['required', Rule::in(['admin', 'customer'])], // Role should be either admin or customer
        ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            $user->image = $imagePath;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        // Update user fields
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->role = $request->role;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        // Delete the image if exists
        if ($user->image) {
            Storage::disk('public')->delete('users/' . $user->image);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
