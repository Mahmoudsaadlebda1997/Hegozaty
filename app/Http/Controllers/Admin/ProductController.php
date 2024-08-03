<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        $active = 'products';
        return view('admin.products.index', compact('products', 'active'));
    }

    public function create()
    {
        $active = 'products';
        $categories = Category::all();
        return view('admin.products.create', compact('active', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'code' => 'required',
            'status' => 'required|in:available,out_of_stock',
            'category_id' => 'required|exists:categories,id',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,mov,flv,mkv,avi,mp4,svg,bmp|max:10000', // Adjust mime types and max size as needed
            'type.*' => 'nullable|in:image,video',
        ]);

        // Create Product
        $product = Product::create($request->all());

        $product = Product::findOrFail($product->id);

        foreach ($request->file('images') as $index => $file) {
            if ($file) {
                $imagePath = $file->store('product_media', 'public');

                $productMedia = new ProductMedia([
                    'image' => $imagePath,
                    'type' => $request->input('type'),
                ]);

                $product->media()->save($productMedia);
            }
        }

        return redirect()->route('products.index')->with('success', 'تم اضافه المنتج');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $active = 'products';
        return view('admin.products.show', compact('product', 'active'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $active = 'products';
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'active', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'code' => 'required',
            'status' => 'required|in:available,out_of_stock',
            'category_id' => 'required|exists:categories,id',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,mov,flv,mkv,avi,mp4,svg,bmp|max:10000', // Adjust mime types and max size as needed
            'type.*' => 'nullable|in:image,video',
        ]);

        $product = Product::findOrFail($id);

        // Retrieve the current image path
        $oldImagePath = $product->image;

        // Update Product details
        $product->update($request->except('image', 'type'));
        if ($request->has('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file) {
                    // Store the new image
                    $newImagePath = $file->store('product_media', 'public');

                    // Update Product's image path
                    $product->image = $newImagePath;

                    $productMedia = new ProductMedia([
                        'image' => $newImagePath,
                        'type' => $request->input('type'),
                    ]);

                    $product->media()->save($productMedia);

                    // Delete the old image if it exists and is different from the new one
                    if ($oldImagePath && $oldImagePath !== $newImagePath) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Delete associated Product Media if any
        ProductMedia::where('product_id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'تم مسخ المنتج');
    }
}
