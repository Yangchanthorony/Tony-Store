<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $products = product::latest()->paginate(10);
        
        return view('products.index', compact('products'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
         $categories = category::orderBy('order')->get();
        return view('products.create', compact('categories'));
    }

    
   public function store(productRequest $request): \Illuminate\Http\RedirectResponse
{
    $imagePath = $request->file('image')->store('products', 'public');

    product::create([
        'name' => $request->name,
        'price' => $request->price,
        'qty' => $request->qty,
        'description' => $request->description,
        'image' => $imagePath,
        'category_id' => $request->category_id, // Ensure this is included
    ]);
        // Increase the category order by 1
    $category = Category::find($request->category_id);
    if ($category) {
        $category->increment('order'); // Laravel's built-in method
    }

    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}


    public function show(product $product): \Illuminate\Contracts\View\View
    {
        return view('products.show', compact('product'));
    }

    public function edit(product $product): \Illuminate\Contracts\View\View
    {
        $categories = category::orderBy('order')->get();
        return view('products.edit', compact('categories','product'));
    }

 public function update(productRequest $request, product $product): \Illuminate\Http\RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'qty' => 'required|integer',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id',
    ]);
    

    $imagePath = $product->image;

    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Save new image
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'qty' => $request->qty,
        'description' => $request->description,
        'image' => $imagePath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}


    public function destroy(product $product): \Illuminate\Http\RedirectResponse
{
    // Get the category before deleting the product
    $category = $product->category;

    // Delete image file if it exists
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    // Delete the product
    $product->delete();

    // Decrease the category order by 1
    if ($category && $category->order > 0) {
        $category->decrement('order');
    }

    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
}

}
