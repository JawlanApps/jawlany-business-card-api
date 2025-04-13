<?php

namespace App\Http\Controllers;

use App\Models\DesignSetting;
use Illuminate\Http\Request;

class DesignSettingController extends Controller
{
    public function index()
    {
        return response()->json(DesignSetting::firstOrCreate([])); // Get or create default design settings
    }

    public function update(Request $request)
    {
        $request->validate([
            'landing_background_image' => 'nullable|string',
            'landing_title' => 'nullable|string',
            'landing_subtitle' => 'nullable|string',
            'menu_logo' => 'nullable|string',
            'menu_background_color' => 'nullable|string',
        ]);

        $designSettings = DesignSetting::firstOrCreate([]);

        $designSettings->update($request->all());

        return response()->json($designSettings);
    }
}
