<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='categories';
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories','active'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $active ='categories';
        return view('admin.categories.create',compact('active'));
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        // Handle image upload
        $imagePath = $request->file('image')->store('category_images', 'public');

        Category::create(array_merge($request->except('image'), ['image' => $imagePath]));
        return redirect()->route('categories.index')->with('success', 'تم عمل القسم بنجاح');
    }

    // Display the specified user
    public function show(Category $category)
    {
        $active ='categories';
        return view('admin.categories.show', compact('category','active'));
    }

    // Show the form for editing the specified user
    public function edit(Category $category)
    {
        $active = 'categories';
        return view('admin.categories.edit', compact('category','active'));
    }

    // Update the specified user in the database
    public function update(Request $request, Category $category)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $category->image = $imagePath;
        }
        // Update user fields
        $category->name = $request->name;

        $category->save();
        return redirect()->route('categories.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    // Remove the specified user from the database
    public function destroy(Category $category)
    {
        // Delete the image if exists
        if ($category->image) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تم مسح القسم بنجاح');
    }
}
