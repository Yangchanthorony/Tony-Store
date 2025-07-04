<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\customerRequest;
use App\Models\category;
use App\Models\customer;
use Illuminate\Support\Facades\Storage;

class customerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $customers = customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
           $categories = category::all();
        return view('customers.create', compact('categories'));
    }

    public function store(customerRequest $request): \Illuminate\Http\RedirectResponse
    {
         $validated = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'country' => 'nullable|string',
        'city' => 'required',
        'phone' => 'nullable|string',
        'date' => 'nullable|date',
        'limitation_year' => 'nullable|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('customers', 'public');
        $validated['image'] = $imagePath;
    }

    Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Created successfully');
    }

    public function show(customer $customer): \Illuminate\Contracts\View\View
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(customer $customer): \Illuminate\Contracts\View\View
    {
        $categories = category::all();
        return view('customers.edit', compact('customer', 'categories'));
    }

    public function update(customerRequest $request, customer $customer): \Illuminate\Http\RedirectResponse
    {
         $data = $request->validated([
        'name' => 'required',
        'type' => 'required',
        'country' => 'nullable|string',
        'city' => 'required',
        'phone' => 'nullable|string',
        'date' => 'nullable|date',
        'limitation_year' => 'nullable|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
         ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image
        if ($customer->image && Storage::disk('public')->exists($customer->image)) {
            Storage::disk('public')->delete($customer->image);
        }

        // Store new image
        $data['image'] = $request->file('image')->store('customers', 'public');
    }

    $customer->update($data);
        return redirect()->route('customers.index')->with('success', 'Updated successfully');
    }

    public function destroy(customer $customer): \Illuminate\Http\RedirectResponse
    {
          // Get the category before deleting the customer
    $category = $customer->category;

    // Delete the image file if it exists
    if ($customer->image && Storage::disk('public')->exists($customer->image)) {
        Storage::disk('public')->delete($customer->image);
    }

    // Delete the customer record
    $customer->delete();

    // Decrease category order if needed
    if ($category && $category->order > 0) {
        $category->decrement('order');
    }
        return redirect()->route('customers.index')->with('success', 'Deleted successfully');
    }
}
