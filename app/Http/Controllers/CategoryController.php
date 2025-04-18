<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('lang', app()->getLocale());

        $categories = Category::with('cards')->get()->map(function ($category) use ($locale) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'name_translated' => $category->name[$locale] ?? $category->name['ar'] ?? '',
                'slug' => $category->slug,
                'cover_picture' => $category->cover_picture,
                'icon' => $category->icon,
                'cards' => $category->cards,
            ];
        });

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.ar' => 'required|string|max:255',
            'name.he' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'cover_picture' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:2048',
            'background_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('background_picture')) {
            $path = $request->file('background_picture')->store('categories', 'public');
            $validated['background_picture'] = 'categories/' . basename($path);
        }

        // Handle file uploads
        if ($request->hasFile('cover_picture')) {
            $path = $request->file('cover_picture')->store('categories', 'public');
            $validated['cover_picture'] = 'categories/' . basename($path); // optional: just store relative path
        }

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('categories', 'public');
            $validated['icon'] = 'categories/' . basename($path);
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']['ar']);

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'cover_picture' => $validated['cover_picture'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'background_picture' => $validated['background_picture'] ?? null,
        ]);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'cover_picture' => $category->cover_picture,
            'icon' => $category->icon,
            'cards' => $category->cards,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.ar' => 'required|string|max:255',
            'name.he' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'cover_picture' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:2048',
            'background_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('background_picture')) {
            if ($category->background_picture && str_starts_with($category->background_picture, 'categories/')) {
                Storage::disk('public')->delete($category->background_picture);
            }

            $path = $request->file('background_picture')->store('categories', 'public');
            $validated['background_picture'] = 'categories/' . basename($path);
        }

        // Replace cover_picture if a new file was uploaded
        if ($request->hasFile('cover_picture')) {

            // Delete old file if it exists and is a local file
            if ($category->cover_picture && str_starts_with($category->cover_picture, 'categories/')) {
                Storage::disk('public')->delete($category->cover_picture);
            }

            $path = $request->file('cover_picture')->store('categories', 'public');
            $validated['cover_picture'] = 'categories/' . basename($path);
        }

        // Replace icon if a new file was uploaded
        if ($request->hasFile('icon')) {
            if ($category->icon && str_starts_with($category->icon, 'categories/')) {
                Storage::disk('public')->delete($category->icon);
            }

            $path = $request->file('icon')->store('categories', 'public');
            $validated['icon'] = 'categories/' . basename($path);
        }

        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']['ar']),
            'cover_picture' => $validated['cover_picture'] ?? $category->cover_picture,
            'icon' => $validated['icon'] ?? $category->icon,
            'background_picture' => $validated['background_picture'] ?? $category->background_picture,
        ]);

        return response()->json($category);
    }


    public function destroy(Category $category)
    {
        if ($category->background_picture && str_starts_with($category->background_picture, 'categories/')) {
            Storage::disk('public')->delete($category->background_picture);
        }

        if ($category->cover_picture && str_starts_with($category->cover_picture, 'categories/')) {
            Storage::disk('public')->delete($category->cover_picture);
        }

        if ($category->icon && str_starts_with($category->icon, 'categories/')) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
