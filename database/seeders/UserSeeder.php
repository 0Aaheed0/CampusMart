<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Controllers\AdminController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin emails from AdminController
        $adminEmails = AdminController::ADMIN_EMAILS;
        
        // Admin user data (names and phone numbers)
        $adminData = [
            [
                'name' => 'Yousha Shahid',
                'phone' => '01712345678',
            ],
            [
                'name' => 'Aaheed Bin Ashraf',
                'phone' => '01812345678',
            ],
            [
                'name' => 'Golam Rabbani Miraz',
                'phone' => '01911111111',
            ],
            [
                'name' => 'Abdullah Al Noman',
                'phone' => '01011111111',
            ],
        ];

        // Create admin users (4 users with AUST official emails for admin access)
        foreach ($adminEmails as $index => $email) {
            User::create([
                'name' => $adminData[$index]['name'],
                'email' => $email,
                'phone' => $adminData[$index]['phone'],
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    
        // Regular users with Bangladeshi names
        User::create([
            'name' => 'Rajib Hassan',
            'email' => 'rajib.cse@aust.edu',
            'phone' => '01512345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Farida Akhter',
            'email' => 'farida.eee@aust.edu',
            'phone' => '01612345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Karim Islam',
            'email' => 'karim.ipe@aust.edu',
            'phone' => '01312345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Nasrin Begum',
            'email' => 'nasrin.bba@aust.edu',
            'phone' => '01412345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Rashed Mahmud',
            'email' => 'rashed.me@aust.edu',
            'phone' => '01212345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Sadia Khan',
            'email' => 'sadia.te@aust.edu',
            'phone' => '01788776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Tariq Mahmud',
            'email' => 'tariq.eee@aust.edu',
            'phone' => '01888776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Ayesha Siddiqui',
            'email' => 'ayesha.cse@aust.edu',
            'phone' => '01988776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Sumon Ahmed',
            'email' => 'sumon.me@aust.edu',
            'phone' => '01588776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Hana Islam',
            'email' => 'hana.ce@aust.edu',
            'phone' => '01688776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Arif Rahman',
            'email' => 'arif.ce@aust.edu',
            'phone' => '01288776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Tamanna Das',
            'email' => 'tamanna.archi@aust.edu',
            'phone' => '01388776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Rohan Khan',
            'email' => 'rohan.bba@aust.edu',
            'phone' => '01488776655',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Mona Rani',
            'email' => 'mona.ipe@aust.edu',
            'phone' => '01788776656',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Kamal Hossain',
            'email' => 'kamalcse@aust.edu',
            'phone' => '01888776656',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
