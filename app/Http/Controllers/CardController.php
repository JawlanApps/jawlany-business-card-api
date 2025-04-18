<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Card::with('categories')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            // Validate incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sub_name' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|string',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'website' => 'nullable|url',
                'address' => 'nullable|string',
                'social_media' => 'nullable|json',
                'profile_picture' => 'nullable|image|max:2048', // Handle image file for profile picture
                'cover_picture' => 'nullable|image|max:2048',   // Handle image file for cover picture
                'theme_color' => 'nullable|string|max:7',
                'background_color' => 'nullable|string|max:7',
                'category_ids' => 'nullable|array',
            ]);

            if ($request->hasFile('profile_picture')) {
                $validated['profile_picture'] = $request->file('profile_picture')->store('cards', 'public');
            }

            if ($request->hasFile('cover_picture')) {
                $validated['cover_picture'] = $request->file('cover_picture')->store('cards', 'public');
            }

            // Create the card
            $card = Card::create($validated);

            // Sync categories
            if (isset($validated['category_ids'])) {
                $card->categories()->sync($validated['category_ids']);
            }

            \DB::commit();

            \Log::debug('Created card:', $card->toArray());

            return response()->json($card, 201);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'errors' => $e->errors() ?? null
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Card::with('categories')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $rules = [
            'name' => 'sometimes|string|max:255',
            'sub_name' => 'sometimes|string|max:255',
            'whatsapp' => 'nullable|string',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'website' => 'sometimes|url',
            'address' => 'sometimes|string',
            'social_media' => 'sometimes|json',
            'theme_color' => 'sometimes|string|max:7',
            'background_color' => 'sometimes|string|max:7',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ];

        if ($request->hasFile('profile_picture')) {
            $rules['profile_picture'] = 'image|max:2048';
        }

        if ($request->hasFile('cover_picture')) {
            $rules['cover_picture'] = 'image|max:2048';
        }

        $validated = $request->validate($rules);

        // Replace and delete old profile picture if a new one is uploaded
        if ($request->hasFile('profile_picture')) {
            if ($card->profile_picture && \Str::startsWith($card->profile_picture, 'cards/')) {
                Storage::disk('public')->delete($card->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('cards', 'public');
        }

        // Replace and delete old cover picture if a new one is uploaded
        if ($request->hasFile('cover_picture')) {
            if ($card->cover_picture && \Str::startsWith($card->cover_picture, 'cards/')) {
                Storage::disk('public')->delete($card->cover_picture);
            }
            $validated['cover_picture'] = $request->file('cover_picture')->store('cards', 'public');
        }

        $card->update($validated);

        if (isset($validated['category_ids'])) {
            $card->categories()->sync($validated['category_ids']);
        }

        return response()->json($card->load('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $card = Card::findOrFail($id);

        // Delete local profile picture if it's a stored file
        if ($card->profile_picture && Str::startsWith($card->profile_picture, 'cards/')) {
            Storage::disk('public')->delete($card->profile_picture);
        }

        // Delete local cover picture if it's a stored file
        if ($card->cover_picture && Str::startsWith($card->cover_picture, 'cards/')) {
            Storage::disk('public')->delete($card->cover_picture);
        }

        $card->delete();

        return response()->json(['message' => "Card $id deleted successfully"]);
    }

    public function assignCategories(Request $request, Card $card)
    {
        $validated = $request->validate([
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $card->categories()->sync($validated['category_ids']);

        return response()->json($card->load('categories'));
    }
    public function getCardsByCategory($categoryId)
    {
        try {
            // Use Category model to find the category by ID
            $category = Category::findOrFail($categoryId);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            // Fetch the cards associated with the category
            $cards = $category->cards;

            // Return the cards as a JSON response
            return response()->json($cards);
        } catch (\Exception $e) {
            // If category is not found or any other error occurs, catch it and return a 500 error with the message
            return response()->json([
                'message' => 'An error occurred while fetching cards for the category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
