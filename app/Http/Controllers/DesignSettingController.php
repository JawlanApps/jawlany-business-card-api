<?php

namespace App\Http\Controllers;

use App\Models\DesignSetting;
use Illuminate\Http\Request;

class DesignSettingController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('lang', app()->getLocale());
        $settings = DesignSetting::firstOrCreate([]);

        return response()->json([
            'landing_background_image' => $settings->landing_background_image,
            'landing_title' => $settings->landing_title[$locale] ?? '',
            'landing_subtitle' => $settings->landing_subtitle[$locale] ?? '',
            'menu_logo' => $settings->menu_logo,
            'menu_background_color' => $settings->menu_background_color,
        ]);
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
