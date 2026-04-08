<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yasir Ahmed',
            'email' => 'yasir@aust.edu',
            'phone' => '01712345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Nadia Islam',
            'email' => 'nadia@aust.edu',
            'phone' => '01812345678',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'CampusMart Admin',
            'email' => 'admin@campusmart.com',
            'phone' => '01911111111',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
