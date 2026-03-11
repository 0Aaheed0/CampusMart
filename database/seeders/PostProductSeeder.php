<?php

namespace Database\Seeders;

use App\Models\PostProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'CampusMart Admin',
                'email' => 'admin@aust.edu',
                'password' => bcrypt('password'),
            ]);
        }

        $products = [
            [
                'product_name' => 'Casio Scientific Calculator fx-991EX',
                'product_type' => 'Electronics',
                'price' => 1200,
                'used_for' => '1 year',
                'condition' => 'Used - Excellent',
                'description' => 'Original Casio calculator, perfect for engineering students. Battery is still strong.',
                'contact_number' => '01712345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Data Structures & Algorithms Book',
                'product_type' => 'Books',
                'price' => 350,
                'used_for' => '1 semester',
                'condition' => 'Used - Good',
                'description' => 'Helpful book by Narasimha Karumanchi. Some pencil marks inside.',
                'contact_number' => '01812345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'AUST CSE 3-1 All Lab Reports',
                'product_type' => 'Books',
                'price' => 150,
                'used_for' => 'N/A',
                'condition' => 'New',
                'description' => 'Handwritten lab reports for reference. Very clear and well-organized.',
                'contact_number' => '01912345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Engineering Drafting Board',
                'product_type' => 'Stationery',
                'price' => 800,
                'used_for' => '2 years',
                'condition' => 'Used - Fair',
                'description' => 'Standard size drafting board for ME/CE students. Minor scratches on surface.',
                'contact_number' => '01512345678',
                'status' => 'available',
            ],
        ];

        foreach ($products as $product) {
            PostProduct::create(array_merge($product, ['user_id' => $user->id]));
        }
    }
}
