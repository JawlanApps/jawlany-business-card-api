<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DesignSetting;

class DesignSettingsSeeder extends Seeder
{
    public function run()
    {
        // Only insert if table is empty
        if (DesignSetting::count() === 0) {
            DesignSetting::create([
                'landing_background_image' => '/images/default-bg.png', // make sure this exists or update
                'landing_title' => 'بطاقة عمل رقميّة',
                'landing_subtitle' => 'أنشئ بطاقتك الرقميّة بسهولة وشارك معلوماتك المهنية في لحظات، دون الحاجة إلى طباعة أو تصميم معقد',
                'menu_logo' => '/images/default-logo.png', // update to your actual logo path
                'menu_background_color' => '#222',
            ]);
        }
    }
}
