<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='services';
        $services = Service::paginate(5);
        return view('admin.services.index', compact('services','active'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $active ='services';
        return view('admin.services.create',compact('active'));
    }

    // Store a newly created service in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'service_type' => 'required|in:phone_banking,branch', // Ensures only 'phone_banking ' or 'branch' is allowed
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'description' => 'required|string',
        ]);

        // Handle image upload (if provided)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('service_images', 'public');
        }

        // Create the service with or without an image
        Service::create([
            'name' => $request->name,
            'service_type' => $request->service_type, // Store service type
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('services.index')->with('success', 'تم إضافة الخدمة بنجاح');
    }


    // Display the specified user
    public function show(Service $service)
    {
        $active ='services';
        return view('admin.services.show', compact('service','active'));
    }

    // Show the form for editing the specified user
    public function edit(Service $service)
    {
        $active = 'services';
        return view('admin.services.edit', compact('service','active'));
    }

    // Update the specified service in the database
    public function update(Request $request, Service $service)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'service_type' => 'required|in:phone_banking,branch', // Ensure valid service type
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'description' => 'nullable|string',
        ]);

        // Handle image upload (if a new image is provided)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('service_images', 'public');
            $service->image = $imagePath; // Update service image
        }

        // Update service fields
        $service->name = $request->name;
        $service->service_type = $request->service_type;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('services.index')->with('success', 'تم تعديل الخدمة بنجاح');
    }


    // Remove the specified user from the database
    public function destroy(Service $service)
    {
        // Delete the image if exists
        if ($service->image) {
            Storage::disk('public')->delete('service_images/' . $service->image);
        }
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم مسح الخدمه بنجاح');
    }
}
