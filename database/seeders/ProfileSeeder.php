<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Profile data for each regular user (excluding admins)
        $profilesData = [
            [
                'email' => 'rajib.cse@aust.edu',
                'department' => 'CSE',
                'year' => 3,
                'semester' => 1,
                'student_id' => '20230104001',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'farida.eee@aust.edu',
                'department' => 'EEE',
                'year' => 2,
                'semester' => 2,
                'student_id' => '20230104002',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'karim.ipe@aust.edu',
                'department' => 'IPE',
                'year' => 4,
                'semester' => 1,
                'student_id' => '20230104003',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'nasrin.bba@aust.edu',
                'department' => 'BBA',
                'year' => 3,
                'semester' => 2,
                'student_id' => '20230104004',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'rashed.me@aust.edu',
                'department' => 'ME',
                'year' => 2,
                'semester' => 1,
                'student_id' => '20230104005',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'sadia.te@aust.edu',
                'department' => 'TE',
                'year' => 4,
                'semester' => 2,
                'student_id' => '20230104006',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'tariq.eee@aust.edu',
                'department' => 'EEE',
                'year' => 3,
                'semester' => 1,
                'student_id' => '20230104007',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'ayesha.cse@aust.edu',
                'department' => 'CSE',
                'year' => 2,
                'semester' => 2,
                'student_id' => '20230104008',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'sumon.me@aust.edu',
                'department' => 'ME',
                'year' => 4,
                'semester' => 1,
                'student_id' => '20230104009',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'hana.ce@aust.edu',
                'department' => 'CE',
                'year' => 3,
                'semester' => 2,
                'student_id' => '20230104010',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'arif.ce@aust.edu',
                'department' => 'CE',
                'year' => 2,
                'semester' => 1,
                'student_id' => '20230104011',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'tamanna.archi@aust.edu',
                'department' => 'Arch',
                'year' => 4,
                'semester' => 2,
                'student_id' => '20230104012',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'rohan.bba@aust.edu',
                'department' => 'BBA',
                'year' => 3,
                'semester' => 1,
                'student_id' => '20230104013',
                'batch' => 2023,
                'gender' => 'Male',
            ],
            [
                'email' => 'mona.ipe@aust.edu',
                'department' => 'IPE',
                'year' => 2,
                'semester' => 2,
                'student_id' => '20230104014',
                'batch' => 2023,
                'gender' => 'Female',
            ],
            [
                'email' => 'kamalcse@aust.edu',
                'department' => 'CSE',
                'year' => 4,
                'semester' => 1,
                'student_id' => '20230104015',
                'batch' => 2023,
                'gender' => 'Male',
            ],
        ];

        // Create profile for each user
        foreach ($profilesData as $profileData) {
            $user = User::where('email', $profileData['email'])->first();
            
            if ($user) {
                Profile::create([
                    'user_id' => $user->id,
                    'department' => $profileData['department'],
                    'year' => $profileData['year'],
                    'semester' => $profileData['semester'],
                    'student_id' => $profileData['student_id'],
                    'batch' => $profileData['batch'],
                    'gender' => $profileData['gender'],
                ]);
            }
        }
    }
}
