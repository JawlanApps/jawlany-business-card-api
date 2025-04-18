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
            [
                'id' => 1,
                'name' => json_encode(['ar' => 'تكنولوجيا', 'he' => 'טכנולוגיה']),
                'slug' => 'tech',
                'background_picture' => 'categories/tech.jpg',
                'cover_picture' => 'categories/tech.jpg',
                'icon' => 'categories/tech-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'name' => json_encode(['ar' => 'تصميم', 'he' => 'עיצוב']),
                'slug' => 'design',
                'background_picture' => 'categories/design.jpg',
                'cover_picture' => 'categories/design.jpg',
                'icon' => 'categories/design-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 3,
                'name' => json_encode(['ar' => 'تسويق', 'he' => 'שיווק']),
                'slug' => 'marketing',
                'background_picture' => 'categories/marketing.jpg',
                'cover_picture' => 'categories/marketing.jpg',
                'icon' => 'categories/marketing-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 4,
                'name' => json_encode(['ar' => 'تطوير الأعمال', 'he' => 'פיתוח עסקי']),
                'slug' => 'business-development',
                'background_picture' => 'categories/business-development.jpg',
                'cover_picture' => 'categories/business-development.jpg',
                'icon' => 'categories/business-development-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 5,
                'name' => json_encode(['ar' => 'تصوير', 'he' => 'צילום']),
                'slug' => 'photography',
                'background_picture' => 'categories/photography.jpg',
                'cover_picture' => 'categories/photography.jpg',
                'icon' => 'categories/photography-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 6,
                'name' => json_encode(['ar' => 'برمجة', 'he' => 'תכנות']),
                'slug' => 'programming',
                'background_picture' => 'categories/programming.jpg',
                'cover_picture' => 'categories/programming.jpg',
                'icon' => 'categories/programming-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 7,
                'name' => json_encode(['ar' => 'إدارة مشاريع', 'he' => 'ניהול פרויקטים']),
                'slug' => 'project-management',
                'background_picture' => 'categories/project-management.jpg',
                'cover_picture' => 'categories/project-management.jpg',
                'icon' => 'categories/project-management-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 8,
                'name' => json_encode(['ar' => 'تعليم', 'he' => 'חינוך']),
                'slug' => 'education',
                'background_picture' => 'categories/education.jpg',
                'cover_picture' => 'categories/education.jpg',
                'icon' => 'categories/education-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 9,
                'name' => json_encode(['ar' => 'صحة ولياقة', 'he' => 'בריאות וכושר']),
                'slug' => 'health-fitness',
                'background_picture' => 'categories/health-fitness.jpg',
                'cover_picture' => 'categories/health-fitness.jpg',
                'icon' => 'categories/health-fitness-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 10,
                'name' => json_encode(['ar' => 'كتابة المحتوى', 'he' => 'כתיבת תוכן']),
                'slug' => 'content-writing',
                'background_picture' => 'categories/content-writing.jpg',
                'cover_picture' => 'categories/content-writing.jpg',
                'icon' => 'categories/content-writing-icon.png',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}

