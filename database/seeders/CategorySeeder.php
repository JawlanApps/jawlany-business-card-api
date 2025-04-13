<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'تكنولوجيا', 'slug' => 'tech', 'cover_picture' => 'https://picsum.photos/300/200?random=1', 'icon' => '💡', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'تصميم', 'slug' => 'design', 'cover_picture' => 'https://picsum.photos/300/200?random=2', 'icon' => '🎨', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'تسويق', 'slug' => 'marketing', 'cover_picture' => 'https://picsum.photos/300/200?random=3', 'icon' => '📈', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'تطوير الأعمال', 'slug' => 'business-development', 'cover_picture' => 'https://picsum.photos/300/200?random=4', 'icon' => '🚀', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'تصوير', 'slug' => 'photography', 'cover_picture' => 'https://picsum.photos/300/200?random=5', 'icon' => '📷', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'برمجة', 'slug' => 'programming', 'cover_picture' => 'https://picsum.photos/300/200?random=6', 'icon' => '🧑‍💻', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'إدارة مشاريع', 'slug' => 'project-management', 'cover_picture' => 'https://picsum.photos/300/200?random=7', 'icon' => '📋', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'تعليم', 'slug' => 'education', 'cover_picture' => 'https://picsum.photos/300/200?random=8', 'icon' => '📚', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'صحة ولياقة', 'slug' => 'health-fitness', 'cover_picture' => 'https://picsum.photos/300/200?random=9', 'icon' => '💪', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'كتابة المحتوى', 'slug' => 'content-writing', 'cover_picture' => 'https://picsum.photos/300/200?random=10', 'icon' => '✍️', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

