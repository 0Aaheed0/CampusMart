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
            [
                'product_name' => 'HP 15s Laptop (Ryzen 5, 8GB RAM)',
                'product_type' => 'Electronics',
                'price' => 45000,
                'used_for' => '1.5 years',
                'condition' => 'Used - Good',
                'description' => 'Reliable laptop for coding and assignments. Comes with original charger and bag.',
                'contact_number' => '01612345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Logitech G304 Wireless Mouse',
                'product_type' => 'Electronics',
                'price' => 2500,
                'used_for' => '6 months',
                'condition' => 'Used - Excellent',
                'description' => 'Lightspeed wireless gaming mouse. Very responsive and clean.',
                'contact_number' => '01312345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Linear Algebra Textbook',
                'product_type' => 'Books',
                'price' => 200,
                'used_for' => '1 year',
                'condition' => 'Used - Good',
                'description' => 'Gilbert Strang textbook. Essential for 1st-year math courses.',
                'contact_number' => '01412345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Professional Drawing Compass Set',
                'product_type' => 'Stationery',
                'price' => 500,
                'used_for' => '1 semester',
                'condition' => 'Used - Excellent',
                'description' => 'High-quality German compass set for engineering drawing.',
                'contact_number' => '01212345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'LED Study Lamp with Wireless Charger',
                'product_type' => 'Household',
                'price' => 1500,
                'used_for' => '3 months',
                'condition' => 'New',
                'description' => 'Modern study lamp with 3 color modes and built-in phone charger.',
                'contact_number' => '01112345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Ergonomic Mesh Office Chair',
                'product_type' => 'Furniture',
                'price' => 3500,
                'used_for' => '1 year',
                'condition' => 'Used - Good',
                'description' => 'Comfortable chair for long study sessions. Adjustable height.',
                'contact_number' => '01012345678',
                'status' => 'available',
            ],
            [
                'product_name' => 'Miyako Electric Kettle (1.8L)',
                'product_type' => 'Household',
                'price' => 800,
                'used_for' => '4 months',
                'condition' => 'Used - Excellent',
                'description' => 'Fast boiling electric kettle. Perfect for tea or noodles in hostel.',
                'contact_number' => '01788776655',
                'status' => 'available',
            ],
            [
                'product_name' => 'Acoustic Guitar - Signature Series',
                'product_type' => 'Musical Instruments',
                'price' => 5500,
                'used_for' => '2 years',
                'condition' => 'Used - Good',
                'description' => 'Good sound quality, perfect for beginners. Includes a gig bag.',
                'contact_number' => '01888776655',
                'status' => 'available',
            ],
            [
                'product_name' => 'AUST Official Navy Blue Hoodie',
                'product_type' => 'Fashion',
                'price' => 600,
                'used_for' => 'N/A',
                'condition' => 'New',
                'description' => 'Brand new AUST hoodie, size L. Very comfortable fabric.',
                'contact_number' => '01988776655',
                'status' => 'available',
            ],
            [
                'product_name' => 'Cricket Bat (English Willow)',
                'product_type' => 'Sports',
                'price' => 2200,
                'used_for' => '1 year',
                'condition' => 'Used - Fair',
                'description' => 'Well-knocked bat, ready for play. Good stroke.',
                'contact_number' => '01588776655',
                'status' => 'available',
            ],
        ];

        foreach ($products as $product) {
            PostProduct::create(array_merge($product, ['user_id' => $user->id]));
        }
    }
}
