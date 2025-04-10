<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Card::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        Try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sub_name' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|url',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'website' => 'nullable|url',
                'address' => 'nullable|string',
                'social_media' => 'nullable|json', // Validate as JSON string
                'profile_picture' => 'nullable|string',
                'cover_picture' => 'nullable|string',
                'theme_color' => 'nullable|string|max:7',
                'background_color' => 'nullable|string|max:7',
            ]);

            // Convert social_media to JSON if present
            if ($request->has('social_media')) {
                $validated['social_media'] = json_encode($request->social_media);
            }

            $card = Card::create($validated);

            if ($request->has('categories')) {
                $card->categories()->sync($request->categories);
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
        return response()->json(Card::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'sub_name' => 'sometimes|string|max:255',
            'whatsapp' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'website' => 'sometimes|url',
            'address' => 'sometimes|string',
            'social_media' => 'sometimes|json',
            'profile_picture' => 'nullable|image|max:2048',
            'cover_picture' => 'nullable|image|max:2048',
            'theme_color' => 'sometimes|string|max:20',
            'background_color' => 'sometimes|string|max:20',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:categories,id',
        ]);

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
        Card::destroy($id);
        return response()->json(['message' => 'Card'.$id.'deleted successfully']);
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
}
