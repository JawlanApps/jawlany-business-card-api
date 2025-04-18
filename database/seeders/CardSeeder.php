<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CardSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Categories
        $categories = \App\Models\Category::all(); // Get all categories from the database

        // Array to store card data
        $cards = [];

        for ($i = 1; $i <= 50; $i++) {  // Increased to create 50 cards
            // Randomly assign 1-3 categories to each card
            $assignedCategories = $categories->random(rand(1, 3))->pluck('id')->toArray();

            // Prepare card data
            $cards[] = [
                'id' => $i,
                'name' => "بطاقة عمل رقمية $i",
                'sub_name' => $this->getSubTitle($i),
                'whatsapp' => str_repeat((string)$i, 10),
                'email' => "card$i@example.com",
                'phone' => "$i$i$i-$i$i$i-$i$i$i$i",
                'website' => 'https://example.com',
                'address' => $this->getAddress($i),
                'social_media' => json_encode([
                    'instagram' => "insta$i",
                    'twitter' => "tw$i",
                ]),
                'profile_picture' => "cards/profile.png",
                'cover_picture' => "cards/cover.jpg",
                'theme_color' => $this->getThemeColor($i),
                'background_color' => '#ffffff',
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Create the card in the database
            $cardId = DB::table('cards')->insertGetId($cards[$i - 1]);

            // Associate the card with categories (many-to-many)
            DB::table('card_categories')->insert(
                array_map(function ($categoryId) use ($cardId) {
                    return ['card_id' => $cardId, 'category_id' => $categoryId];
                }, $assignedCategories)
            );
        }
    }

    private function getSubTitle($i)
    {
        $titles = [
            1 => 'CEO', 2 => 'Marketing Manager', 3 => 'Designer', 4 => 'Product Manager',
            5 => 'Software Engineer', 6 => 'Graphic Designer', 7 => 'Entrepreneur',
            8 => 'Consultant', 9 => 'Content Creator', 10 => 'Web Developer'
        ];
        return $titles[$i] ?? 'Unknown';
    }

    private function getAddress($i)
    {
        $streets = ['Main', 'Elm', 'Oak', 'Pine', 'Birch', 'Cedar', 'Willow', 'Redwood', 'Maple', 'Birchwood'];

        // Wrap around if $i exceeds the available number of streets
        $street = $streets[($i - 1) % count($streets)];

        return $i . ' ' . $street . ' St';
    }


    private function getThemeColor($i)
    {
        $colors = ['#ff5733', '#34b7f1', '#f1c40f', '#9b59b6', '#e74c3c', '#1abc9c', '#2ecc71', '#f39c12', '#34495e', '#8e44ad'];
        return $colors[$i - 1] ?? '#000000';
    }
}


