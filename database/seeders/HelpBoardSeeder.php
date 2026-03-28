<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HelpBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'title' => 'How do I buy an item?',
                'answer' => 'Browse available products on CampusMart and find what you need. Contact the seller and arrange to meet inside AUST campus at a convenient spot. No delivery, no middleman.',
            ],
            [
                'title' => 'How do I sell an item?',
                'answer' => 'Go to the Post Product section, fill in your item details, upload a photo, set your price and submit. Your listing will appear for other students to see.',
            ],
            [
                'title' => 'Is it safe to trade on CampusMart?',
                'answer' => 'Yes. All users are verified AUST students using their university email. Every trade happens inside campus so you always meet someone from your own university.',
            ],
            [
                'title' => 'What items can I sell?',
                'answer' => 'You can sell books, lecture notes, calculators, stationery, drafting tools, lab equipment and any other study related items useful for AUST students.',
            ],
            [
                'title' => 'What if I have a problem with a trade?',
                'answer' => 'Use the Report Issues section on the platform to flag any problem. You can also speak to your department representative for assistance.',
            ],
            [
                'title' => 'Is there any delivery available?',
                'answer' => 'No. CampusMart is designed for face to face trades inside AUST campus only. This keeps transactions safe and free of delivery fees.',
            ],
            [
                'title' => 'How do I contact a seller?',
                'answer' => 'Open any product listing and you will find the seller contact details. Reach out to them directly and agree on a meeting spot on campus.',
            ],
            [
                'title' => 'Is CampusMart free to use?',
                'answer' => 'Yes, completely free for all verified AUST students. No subscription, no commission, no hidden charges.',
            ],
            [
                'title' => 'Can I negotiate the price?',
                'answer' => 'Absolutely. Prices listed are set by the seller but you are free to discuss and negotiate a fair price when you meet them on campus.',
            ],
            [
                'title' => 'What if the item is not as described?',
                'answer' => 'Always inspect the item carefully before completing the trade. If there is a problem report it through the Report Issues section.',
            ],
            [
                'title' => 'How do I verify a seller is a real AUST student?',
                'answer' => 'Every account on CampusMart is registered with an official AUST university email address so you can trust that all sellers are genuine students.',
            ],
            [
                'title' => 'Can I post a wanted listing?',
                'answer' => 'Yes. Use the Help Board to post what you are looking for and other students can respond if they have what you need.',
            ],
            [
                'title' => 'How long does a listing stay active?',
                'answer' => 'Listings remain active until the seller manually removes or marks them as sold. Always check with the seller if an item is still available.',
            ],
            [
                'title' => 'Can I sell used items?',
                'answer' => 'Yes. Used items in good condition are welcome. Just be honest in your description so the buyer knows exactly what they are getting.',
            ],
            [
                'title' => 'What categories are available?',
                'answer' => 'Current categories are Books, Notes, Calculators, Stationery, Drafting and Lab Equipment. More categories may be added in the future.',
            ],
            [
                'title' => 'Do I need to create an account to browse?',
                'answer' => 'You need a verified AUST student account to buy or sell. Browsing may be available but all transactions require login.',
            ],
            [
                'title' => 'How do I delete my listing?',
                'answer' => 'Go to your profile and find your active listings. You can remove any listing directly from your profile page.',
            ],
            [
                'title' => 'What is the trust score?',
                'answer' => 'The trust score reflects how reliable a student is based on their completed trades and feedback from other students on the platform.',
            ],
            [
                'title' => 'Can I save items I am interested in?',
                'answer' => 'Yes. You can wishlist or save items you like so you can come back to them later from your profile.',
            ],
            [
                'title' => 'Who do I contact for technical issues?',
                'answer' => 'For any technical problems with the platform contact the CampusMart support team through the contact section or email the admin directly.',
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('help_boards')->insert($faq);
        }
    }
}
