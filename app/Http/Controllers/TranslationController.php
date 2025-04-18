<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    public function getTranslations($locale)
    {
        if (!in_array($locale, ['ar', 'he'])) {
            return response()->json(['error' => 'Locale not found'], 404);
        }

        $path = resource_path("lang/{$locale}.json");

        if (!file_exists($path)) {
            return response()->json(['error' => 'Locale file not found'], 404);
        }

        return response()->json(json_decode(file_get_contents($path), true));
    }
}
