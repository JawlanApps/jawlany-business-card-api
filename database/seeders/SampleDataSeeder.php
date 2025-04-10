<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Categories Table
        DB::table('categories')->insert([
            [
                'name' => 'Technology',
                'slug' => Str::slug('Technology'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Business',
                'slug' => Str::slug('Business'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Health',
                'slug' => Str::slug('Health'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Seed Cards Table
        DB::table('cards')->insert([
            [
                'name' => 'John Doe',
                'sub_name' => 'Software Engineer',
                'whatsapp' => '+1234567890',
                'email' => 'john.doe@example.com',
                'phone' => '+9876543210',
                'website' => 'https://johndoe.com',
                'address' => '123 Tech Street, Silicon Valley',
                'social_media' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/johndoe',
                    'twitter' => 'https://twitter.com/johndoe'
                ]),
                'profile_picture' => 'profile1.jpg',
                'cover_picture' => 'cover1.jpg',
                'theme_color' => '#3498db',
                'background_color' => '#f5f5f5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'sub_name' => 'Marketing Specialist',
                'whatsapp' => '+1122334455',
                'email' => 'jane.smith@example.com',
                'phone' => '+5566778899',
                'website' => 'https://janesmith.com',
                'address' => '456 Market Ave, New York',
                'social_media' => json_encode([
                    'facebook' => 'https://facebook.com/janesmith',
                    'instagram' => 'https://instagram.com/janesmith'
                ]),
                'profile_picture' => 'profile2.jpg',
                'cover_picture' => 'cover2.jpg',
                'theme_color' => '#e74c3c',
                'background_color' => '#ffffff',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('card_categories')->insert([
            [
                'card_id' => '1',
                'category_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'card_id' => '1',
                'category_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'card_id' => '2',
                'category_id' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
