<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AddMembersAndTrainersSeeder extends Seeder
{
    public function run(): void
    {
        // Add 45 Trainers
        $trainerNames = [
            'Alex Rodriguez', 'Maria Santos', 'James Wilson', 'Sofia Martinez', 'Ryan Thompson',
            'Isabella Garcia', 'Kevin Lee', 'Emma Brown', 'Daniel Kim', 'Olivia Taylor',
            'Marcus Johnson', 'Ava Anderson', 'Tyler Davis', 'Mia White', 'Brandon Miller',
            'Charlotte Moore', 'Justin Clark', 'Amelia Lewis', 'Eric Walker', 'Harper Hall',
            'Nathan Young', 'Evelyn Allen', 'Aaron King', 'Abigail Wright', 'Jordan Scott',
            'Emily Green', 'Lucas Adams', 'Madison Baker', 'Dylan Nelson', 'Chloe Carter',
            'Connor Mitchell', 'Lily Roberts', 'Austin Turner', 'Zoe Phillips', 'Caleb Campbell',
            'Grace Parker', 'Ethan Evans', 'Aria Edwards', 'Mason Collins', 'Scarlett Stewart',
            'Logan Morris', 'Victoria Rogers', 'Noah Reed', 'Penelope Cook', 'Liam Morgan'
        ];

        $specializations = [
            'Personal Training', 'Yoga & Pilates', 'Strength & Conditioning', 'CrossFit',
            'Cardio Training', 'Weight Loss Specialist', 'Bodybuilding', 'Functional Training',
            'Sports Performance', 'Rehabilitation', 'Nutrition Coaching', 'HIIT Training',
            'Boxing & Kickboxing', 'Spinning', 'TRX Training', 'Mobility & Flexibility',
            'Senior Fitness', 'Pre/Post Natal', 'Athletic Training', 'Powerlifting'
        ];

        $certifications = [
            'ACE Certified Personal Trainer, CPR/AED Certified',
            'NASM Certified Personal Trainer, Nutrition Specialist',
            'RYT 200 Yoga Instructor, Pilates Certified',
            'NSCA Certified Strength Coach, CSCS',
            'CrossFit Level 2 Trainer, Olympic Lifting Certified',
            'ISSA Certified Fitness Trainer, Sports Nutrition',
            'ACSM Certified Exercise Physiologist',
            'Precision Nutrition Level 1, Functional Movement Screen',
            'USA Boxing Coach Certified, First Aid Certified',
            'Spinning Instructor Certified, Group Fitness Instructor'
        ];

        foreach ($trainerNames as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@gym.com',
                'password' => Hash::make('password'),
                'role' => 'trainer',
                'phone' => '+1234' . sprintf('%06d', 500 + $index),
                'specialization' => $specializations[array_rand($specializations)],
                'certifications' => $certifications[array_rand($certifications)],
                'experience_years' => rand(1, 15),
                'hourly_rate' => rand(40, 100) + rand(0, 99) / 100,
                'is_active' => rand(0, 10) > 0, // 90% active
                'approval_status' => 'approved',
                'approved_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }

        // Add 27 Members
        $memberNames = [
            'Andrew Peterson', 'Sophia Hughes', 'Christopher Price', 'Hannah Bennett',
            'Matthew Wood', 'Natalie Barnes', 'Joshua Ross', 'Samantha Coleman',
            'Nicholas Jenkins', 'Rachel Perry', 'Anthony Powell', 'Lauren Long',
            'Jacob Patterson', 'Ashley Hughes', 'William Foster', 'Alexis Sanders',
            'Samuel Griffin', 'Jessica Hayes', 'Benjamin Myers', 'Nicole Ford',
            'Alexander Hamilton', 'Stephanie Wells', 'Joseph Bradley', 'Melissa Cox',
            'Henry Richardson', 'Amanda Howard', 'Sebastian Ward'
        ];

        $addresses = [
            '123 Oak Street, Downtown, CA 90001',
            '456 Maple Avenue, Westside, CA 90002',
            '789 Pine Road, Eastside, CA 90003',
            '321 Elm Boulevard, Northside, CA 90004',
            '654 Cedar Lane, Southside, CA 90005',
            '987 Birch Drive, Midtown, CA 90006',
            '147 Willow Court, Uptown, CA 90007',
            '258 Spruce Way, Riverside, CA 90008',
            '369 Ash Place, Lakeside, CA 90009',
            '741 Cherry Street, Hillside, CA 90010'
        ];

        $healthNotes = [
            'No known health issues',
            'Mild asthma - inhaler available',
            'Previous knee injury - avoid high impact',
            'Lower back sensitivity',
            'Allergic to nuts',
            'Consult doctor before intense exercise',
            'Heart condition - moderate exercise only',
            'Recovering from shoulder injury',
            'Diabetes - monitor blood sugar',
            'High blood pressure - controlled with medication'
        ];

        foreach ($memberNames as $index => $name) {
            $membershipType = ['basic', 'premium', 'vip'][array_rand(['basic', 'premium', 'vip'])];
            
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@gym.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone' => '+1234' . sprintf('%06d', 1000 + $index),
                'date_of_birth' => Carbon::now()->subYears(rand(18, 65))->subMonths(rand(0, 11))->subDays(rand(0, 30)),
                'address' => $addresses[array_rand($addresses)],
                'membership_type' => $membershipType,
                'membership_expiry' => Carbon::now()->addMonths(rand(1, 12)),
                'height' => rand(150, 195) + rand(0, 99) / 100,
                'weight' => rand(50, 110) + rand(0, 99) / 100,
                'emergency_contact' => '+1234' . sprintf('%06d', 2000 + $index),
                'health_notes' => $healthNotes[array_rand($healthNotes)],
                'is_active' => rand(0, 10) > 1, // 90% active
            ]);
        }

        $this->command->info('Successfully added 45 trainers and 27 members!');
        $this->command->info('All accounts use password: password');
    }
}
