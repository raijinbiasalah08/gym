<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\Progress;
use App\Models\WorkoutPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1234567890',
            'is_active' => true,
        ]);

        // Create Trainers
        $trainers = [];
        $trainers[] = User::create([
            'name' => 'John Trainer',
            'email' => 'trainer@gym.com',
            'password' => Hash::make('password'),
            'role' => 'trainer',
            'phone' => '+1234567891',
            'specialization' => 'Personal Training',
            'experience_years' => 5,
            'hourly_rate' => 60.00,
            'is_active' => true,
        ]);

        $trainers[] = User::create([
            'name' => 'Sarah Coach',
            'email' => 'sarah@gym.com',
            'password' => Hash::make('password'),
            'role' => 'trainer',
            'phone' => '+1234567892',
            'specialization' => 'Yoga & Pilates',
            'experience_years' => 3,
            'hourly_rate' => 50.00,
            'is_active' => true,
        ]);

        // Create Members
        $members = [];
        $members[] = User::create([
            'name' => 'Mike Member',
            'email' => 'member@gym.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone' => '+1234567893',
            'membership_type' => 'premium',
            'membership_expiry' => Carbon::now()->addMonths(6),
            'is_active' => true,
        ]);

        $members[] = User::create([
            'name' => 'Lisa Johnson',
            'email' => 'lisa@gym.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'phone' => '+1234567894',
            'membership_type' => 'vip',
            'membership_expiry' => Carbon::now()->addYear(),
            'is_active' => true,
        ]);

        // Create additional members
        for ($i = 3; $i <= 10; $i++) {
            $members[] = User::create([
                'name' => 'Member ' . $i,
                'email' => 'member' . $i . '@gym.com',
                'password' => Hash::make('password'),
                'role' => 'member',
                'phone' => '+12345678' . (90 + $i),
                'membership_type' => ['basic', 'premium', 'vip'][array_rand(['basic', 'premium', 'vip'])],
                'membership_expiry' => Carbon::now()->addMonths(rand(1, 12)),
                'is_active' => true,
            ]);
        }

        // Create bookings
        foreach ($members as $member) {
            foreach (range(1, rand(2, 5)) as $index) {
                $trainer = $trainers[array_rand($trainers)];
                $bookingDate = Carbon::now()->addDays(rand(1, 30));
                
                Booking::create([
                    'member_id' => $member->id,
                    'trainer_id' => $trainer->id,
                    'booking_date' => $bookingDate,
                    'start_time' => '09:00',
                    'end_time' => '10:00',
                    'session_type' => ['personal_training', 'group_session', 'consultation'][rand(0, 2)],
                    'status' => ['pending', 'confirmed', 'completed'][rand(0, 2)],
                    'price' => $trainer->hourly_rate * (rand(8, 12) / 10),
                    'notes' => 'Regular training session',
                ]);
            }
        }

        // Create payments
        foreach ($members as $member) {
            foreach (range(1, rand(1, 3)) as $index) {
                Payment::create([
                    'member_id' => $member->id,
                    'amount' => rand(50, 200),
                    'payment_date' => Carbon::now()->subMonths(rand(0, 3)),
                    'due_date' => Carbon::now()->addMonths(rand(1, 3)),
                    'payment_method' => ['cash', 'card', 'bank_transfer', 'online'][rand(0, 3)],
                    'status' => ['pending', 'paid'][rand(0, 1)],
                    'description' => 'Monthly membership fee',
                    'membership_type' => $member->membership_type,
                    'period_start' => Carbon::now()->subMonths(rand(1, 3)),
                    'period_end' => Carbon::now()->addMonths(rand(1, 3)),
                ]);
            }
        }

        // Create attendance records - FIXED: Ensure unique member-date combinations
        foreach ($members as $member) {
            $usedDates = []; // Track dates used for this member
            
            foreach (range(1, rand(5, 15)) as $index) {
                // Generate unique date for this member
                do {
                    $date = Carbon::now()->subDays(rand(0, 30));
                    $dateString = $date->toDateString();
                } while (in_array($dateString, $usedDates));
                
                $usedDates[] = $dateString;
                
                // Ensure check_in is before check_out
                $checkIn = $date->copy()->setTime(rand(6, 18), rand(0, 59));
                $checkOut = $checkIn->copy()->addMinutes(rand(30, 120));
                
                Attendance::create([
                    'member_id' => $member->id,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'date' => $date,
                    'workout_duration' => $checkOut->diffInMinutes($checkIn),
                    'calories_burned' => rand(200, 800),
                    'notes' => 'Regular workout session',
                ]);
            }
        }

        // Create progress records - FIXED: Ensure unique member-date combinations
        foreach ($members as $member) {
            $currentWeight = 70 + rand(-20, 20);
            $usedProgressDates = []; // Track dates used for progress records
            
            foreach (range(1, rand(3, 6)) as $index) {
                // Generate unique date for this member's progress
                do {
                    $recordDate = Carbon::now()->subDays(rand(0, 90));
                    $dateString = $recordDate->toDateString();
                } while (in_array($dateString, $usedProgressDates));
                
                $usedProgressDates[] = $dateString;
                
                $weightChange = rand(-10, 10) * 0.1;
                $currentWeight += $weightChange;
                
                Progress::create([
                    'member_id' => $member->id,
                    'record_date' => $recordDate,
                    'weight' => max(50, $currentWeight),
                    'height' => 170 + rand(-10, 10),
                    'body_fat_percentage' => 20 + rand(-8, 8),
                    'muscle_mass' => 30 + rand(-5, 5),
                    'chest_measurement' => 95 + rand(-10, 10),
                    'waist_measurement' => 80 + rand(-15, 15),
                    'hip_measurement' => 95 + rand(-10, 10),
                    'arm_measurement' => 32 + rand(-5, 5),
                    'thigh_measurement' => 55 + rand(-8, 8),
                    'notes' => 'Monthly progress check',
                ]);
            }
        }

        // Create workout plans
        foreach ($members as $member) {
            if (rand(0, 1)) {
                $trainer = $trainers[array_rand($trainers)];
                WorkoutPlan::create([
                    'trainer_id' => $trainer->id,
                    'member_id' => $member->id,
                    'title' => 'Personalized Workout Plan for ' . $member->name,
                    'description' => 'Custom workout plan designed specifically for ' . $member->name,
                    'goal' => ['Weight Loss', 'Muscle Gain', 'General Fitness'][rand(0, 2)],
                    'duration_weeks' => rand(4, 12),
                    'difficulty_level' => ['beginner', 'intermediate', 'advanced'][rand(0, 2)],
                    'exercises' => [
                        [
                            'name' => 'Bench Press',
                            'sets' => 3,
                            'reps' => '8-12',
                            'rest' => '60s'
                        ],
                        [
                            'name' => 'Squats',
                            'sets' => 3,
                            'reps' => '10-15',
                            'rest' => '60s'
                        ],
                        [
                            'name' => 'Pull-ups',
                            'sets' => 3,
                            'reps' => '8-10',
                            'rest' => '60s'
                        ]
                    ],
                    'schedule' => [
                        'monday' => ['Chest', 'Triceps'],
                        'wednesday' => ['Back', 'Biceps'],
                        'friday' => ['Legs', 'Shoulders']
                    ],
                    'status' => 'active',
                ]);
            }
        }

        // Create specific bookings for test member
        $testMember = User::where('email', 'member@gym.com')->first();
        if ($testMember) {
            foreach (range(1, 5) as $index) {
                $trainer = $trainers[array_rand($trainers)];
                $bookingDate = Carbon::now()->addDays(rand(1, 30));
                
                Booking::create([
                    'member_id' => $testMember->id,
                    'trainer_id' => $trainer->id,
                    'booking_date' => $bookingDate,
                    'start_time' => '09:00',
                    'end_time' => '10:00',
                    'session_type' => ['personal_training', 'group_session', 'consultation'][rand(0, 2)],
                    'status' => ['pending', 'confirmed', 'completed'][rand(0, 2)],
                    'price' => $trainer->hourly_rate * (rand(8, 12) / 10),
                    'notes' => 'Regular training session',
                ]);
            }
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: admin@gym.com / password');
        $this->command->info('Trainer Login: trainer@gym.com / password');
        $this->command->info('Member Login: member@gym.com / password');
    }
}