<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::with('cards')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255',
            'cover_picture' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'custom_icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_picture_file')) {
            $path = $request->file('cover_picture_file')->store('categories', 'public');
            $validated['cover_picture'] = asset('storage/' . $path);
        }

        if ($request->hasFile('custom_icon')) {
            $path = $request->file('custom_icon')->store('categories', 'public');
            $validated['icon'] = asset('storage/' . $path);
        }

        $validated['slug'] = Str::slug($validated['name']);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json($category->load('cards'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255',
            'cover_picture' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'custom_icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_picture_file')) {
            $path = $request->file('cover_picture_file')->store('categories', 'public');
            $validated['cover_picture'] = asset('storage/' . $path);
        }

        if ($request->hasFile('custom_icon')) {
            $path = $request->file('custom_icon')->store('categories', 'public');
            $validated['icon'] = asset('storage/' . $path);
        }

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
