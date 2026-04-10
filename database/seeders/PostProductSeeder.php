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
        $users = User::where('role', 'user')->get();

        if ($users->isEmpty()) {
            $user = User::factory()->create([
                'name' => 'Demo User',
                'email' => 'demo@aust.edu',
                'password' => bcrypt('password'),
            ]);
            $users = collect([$user]);
        }

        $productData = [
            // Electronics
            [
                'product_name' => 'Casio Scientific Calculator fx-991EX',
                'product_type' => 'Electronics',
                'price' => 1200,
                'used_for' => '1 year',
                'condition' => 'Used - Excellent',
                'description' => 'Original Casio calculator, perfect for engineering students. Battery is still strong.',
                'contact_number' => '01712345678',
                'product_image' => 'https://images.unsplash.com/photo-1516589335033-c365464a6549?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-1527814050087-3793815479db?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Sony WH-CH720 Wireless Headphones',
                'product_type' => 'Electronics',
                'price' => 3800,
                'used_for' => '3 months',
                'condition' => 'New',
                'description' => 'Great sound quality, noise cancellation, long battery life. Perfect for study.',
                'contact_number' => '01512345678',
                'product_image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Mechanical Keyboard RGB Backlit',
                'product_type' => 'Electronics',
                'price' => 4500,
                'used_for' => '8 months',
                'condition' => 'Used - Excellent',
                'description' => 'Mechanical keyboard with RGB lighting. Cherry MX switches. Great for gaming and typing.',
                'contact_number' => '01412345678',
                'product_image' => 'https://images.unsplash.com/photo-1587829191301-4b5e10cb5a5d?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Power Bank 20000mAh Fast Charging',
                'product_type' => 'Electronics',
                'price' => 1500,
                'used_for' => '4 months',
                'condition' => 'Used - Excellent',
                'description' => 'Fast charging power bank, multiple USB ports. Essential for campus life.',
                'contact_number' => '01788776655',
                'product_image' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Books
            [
                'product_name' => 'Data Structures & Algorithms Book',
                'product_type' => 'Books',
                'price' => 350,
                'used_for' => '1 semester',
                'condition' => 'Used - Good',
                'description' => 'Helpful book by Narasimha Karumanchi. Some pencil marks inside.',
                'contact_number' => '01812345678',
                'product_image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-150784272343-583f20270319?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-1543002588-d83cea6bafff?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Introduction to Algorithms (CLRS)',
                'product_type' => 'Books',
                'price' => 500,
                'used_for' => '2 years',
                'condition' => 'Used - Fair',
                'description' => 'Classic algorithms book. Some highlighting and notes.',
                'contact_number' => '01688776655',
                'product_image' => 'https://images.unsplash.com/photo-1541521227883-769d10dea65f?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Chemistry Practical Notes',
                'product_type' => 'Books',
                'price' => 100,
                'used_for' => '1 semester',
                'condition' => 'Used - Good',
                'description' => 'Detailed practical notes for chemistry lab. Very helpful for exams.',
                'contact_number' => '01288776655',
                'product_image' => 'https://images.unsplash.com/photo-1578462996442-48f60103fc96?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Stationery
            [
                'product_name' => 'Engineering Drafting Board',
                'product_type' => 'Stationery',
                'price' => 800,
                'used_for' => '2 years',
                'condition' => 'Used - Fair',
                'description' => 'Standard size drafting board for ME/CE students. Minor scratches on surface.',
                'contact_number' => '01512345678',
                'product_image' => 'https://images.unsplash.com/photo-1549887534-f3b018ca5481?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-1608889335941-32ac5f2041b9?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Complete Stationery Bundle Pack',
                'product_type' => 'Stationery',
                'price' => 400,
                'used_for' => '3 months',
                'condition' => 'Used - Good',
                'description' => 'Pens, pencils, highlighters, erasers and more. Complete set for students.',
                'contact_number' => '01388776655',
                'product_image' => 'https://images.unsplash.com/photo-1595521624318-8d0f0b6e2f5a?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Household
            [
                'product_name' => 'LED Study Lamp with Wireless Charger',
                'product_type' => 'Household',
                'price' => 1500,
                'used_for' => '3 months',
                'condition' => 'New',
                'description' => 'Modern study lamp with 3 color modes and built-in phone charger.',
                'contact_number' => '01112345678',
                'product_image' => 'https://images.unsplash.com/photo-1565636192335-14ab5c3e7bef?w=500&h=500&fit=crop&q=80',
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
                'product_image' => 'https://images.unsplash.com/photo-1578500494198-246f612d03b3?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Mini Refrigerator (50L)',
                'product_type' => 'Household',
                'price' => 3200,
                'used_for' => '1 year',
                'condition' => 'Used - Good',
                'description' => 'Compact refrigerator perfect for hostel room. Energy efficient.',
                'contact_number' => '01888776656',
                'product_image' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Portable Fan (Rechargeable)',
                'product_type' => 'Household',
                'price' => 600,
                'used_for' => '2 months',
                'condition' => 'New',
                'description' => 'USB rechargeable portable fan. Great for summer comfort.',
                'contact_number' => '01788776656',
                'product_image' => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Furniture
            [
                'product_name' => 'Ergonomic Mesh Office Chair',
                'product_type' => 'Furniture',
                'price' => 3500,
                'used_for' => '1 year',
                'condition' => 'Used - Good',
                'description' => 'Comfortable chair for long study sessions. Adjustable height.',
                'contact_number' => '01012345678',
                'product_image' => 'https://images.unsplash.com/photo-1586023566566-a1a81dd5be74?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Wooden Study Desk (120x60)',
                'product_type' => 'Furniture',
                'price' => 4500,
                'used_for' => '1.5 years',
                'condition' => 'Used - Good',
                'description' => 'Spacious wooden desk perfect for studies. Has drawer storage.',
                'contact_number' => '01488776655',
                'product_image' => 'https://images.unsplash.com/photo-1593062096033-9a26b09da705?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Metal Bunk Bed Frame',
                'product_type' => 'Furniture',
                'price' => 5500,
                'used_for' => '2 years',
                'condition' => 'Used - Fair',
                'description' => 'Strong metal bunk bed. Great for hostel rooms to save space.',
                'contact_number' => '01388776655',
                'product_image' => 'https://images.unsplash.com/photo-1540932239986-310128078e9f?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Fashion
            [
                'product_name' => 'AUST Official Navy Blue Hoodie',
                'product_type' => 'Fashion',
                'price' => 600,
                'used_for' => 'N/A',
                'condition' => 'New',
                'description' => 'Brand new AUST hoodie, size L. Very comfortable fabric.',
                'contact_number' => '01988776655',
                'product_image' => 'https://images.unsplash.com/photo-1556821552-107a0c2eac18?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Winter Jacket (Navy Blue)',
                'product_type' => 'Fashion',
                'price' => 1200,
                'used_for' => '1 winter',
                'condition' => 'Used - Excellent',
                'description' => 'Warm and comfortable winter jacket. Size M.',
                'contact_number' => '01788776656',
                'product_image' => 'https://images.unsplash.com/photo-1551028719-00167b16ebc5?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Sports T-Shirt Bundle (5 pieces)',
                'product_type' => 'Fashion',
                'price' => 800,
                'used_for' => '3 months',
                'condition' => 'Used - Good',
                'description' => 'Bundle of 5 quality cotton sports t-shirts. Multiple colors.',
                'contact_number' => '01388776656',
                'product_image' => 'https://images.unsplash.com/photo-1555062645-c07966885260?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Musical
            [
                'product_name' => 'Acoustic Guitar - Signature Series',
                'product_type' => 'Musical',
                'price' => 5500,
                'used_for' => '2 years',
                'condition' => 'Used - Good',
                'description' => 'Good sound quality, perfect for beginners. Includes a gig bag.',
                'contact_number' => '01888776655',
                'product_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Ukulele (Beginner Friendly)',
                'product_type' => 'Musical',
                'price' => 2200,
                'used_for' => '6 months',
                'condition' => 'Used - Excellent',
                'description' => 'Easy to learn, great for beginners. Comes with carrying case.',
                'contact_number' => '01688776656',
                'product_image' => 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],

            // Sports
            [
                'product_name' => 'Cricket Bat (English Willow)',
                'product_type' => 'Sports',
                'price' => 2200,
                'used_for' => '1 year',
                'condition' => 'Used - Fair',
                'description' => 'Well-knocked bat, ready for play. Good stroke.',
                'contact_number' => '01588776655',
                'product_image' => 'https://images.unsplash.com/photo-1624526267942-ab67cb7db225?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Badminton Racket Set (2 Rackets)',
                'product_type' => 'Sports',
                'price' => 800,
                'used_for' => '3 months',
                'condition' => 'Used - Excellent',
                'description' => 'Professional badminton rackets with carrying bag.',
                'contact_number' => '01388776656',
                'product_image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
            [
                'product_name' => 'Football Adidas Original',
                'product_type' => 'Sports',
                'price' => 1500,
                'used_for' => '1 month',
                'condition' => 'New',
                'description' => 'Official Adidas football, perfect match ball. Brand new.',
                'contact_number' => '01488776656',
                'product_image' => 'https://images.unsplash.com/photo-1517836357463-d25ddfcbf042?w=500&h=500&fit=crop&q=80',
                'status' => 'available',
            ],
        ];

        foreach ($productData as $index => $product) {
            // Cycle through users
            $user = $users[$index % $users->count()];
            PostProduct::create(array_merge($product, ['user_id' => $user->id]));
        }
    }
}
