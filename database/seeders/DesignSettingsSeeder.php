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
                'landing_background_image' => '/images/default-bg.png',
                'landing_title' => [
                    'ar' => 'بطاقة عمل رقميّة',
                    'he' => 'כרטיס ביקור דיגיטלי',
                ],
                'landing_subtitle' => [
                    'ar' => 'أنشئ بطاقتك الرقميّة بسهولة وشارك معلوماتك المهنية في لحظات، دون الحاجة إلى طباعة أو تصميم معقد',
                    'he' => 'צור את כרטיס הביקור הדיגיטלי שלך בקלות ושתף את המידע המקצועי שלך תוך רגעים, ללא צורך בהדפסה או עיצוב מורכב.',
                ],
                'menu_logo' => '/images/default-logo.png',
                'menu_background_color' => '#cd5c5c',
            ]);
        }
    }
}
