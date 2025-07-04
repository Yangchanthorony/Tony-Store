<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\category;

class categoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
       $categories = Category::orderBy('order')->get();
       $categories = category::latest()->paginate(10);


    // Define list of category options (could come from a model, config, etc.)
    $availableCategories = [ ];

    return view('categories.index', compact('categories', 'availableCategories'));
    
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('categories.create');
    }

    public function store(categoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Created successfully');
    }

    public function show(category $category): \Illuminate\Contracts\View\View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(category $category): \Illuminate\Contracts\View\View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(categoryRequest $request, category $category): \Illuminate\Http\RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Updated successfully');
    }

    public function destroy(category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Deleted successfully');
    }
}
