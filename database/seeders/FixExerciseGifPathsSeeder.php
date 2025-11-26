<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class FixExerciseGifPathsSeeder extends Seeder
{
    /**
     * Fix GIF paths for exercises to match actual files
     */
    public function run(): void
    {
        // Map of exercise names to their correct GIF paths
        // Only include exercises where the GIF file actually exists
        $gifMappings = [
            // Exercises with correct GIF files
            'Deadlifts' => '/lottie/exercises/back-deadlifts.gif',
            'Seated Barbell Press' => '/lottie/exercises/seated-barbell-press.gif',
            'Push Press' => '/lottie/exercises/push-press.gif',
            'Romanian Deadlifts' => '/lottie/exercises/romanian-deadlifts.gif',
            
            // Exercises that don't have GIF files - set to null
            'Treadmill' => null,
            'Push-Ups' => null,
            'Chest Dips' => null,
            'Dumbbell Bicep Curls' => null,
            'Reverse Crunches' => null,
            'Sumo Squats' => null,
            'Incline Dumbbell Press' => null,
        ];

        foreach ($gifMappings as $exerciseName => $gifPath) {
            Exercise::where('name', $exerciseName)->update(['gif_path' => $gifPath]);
        }

        $this->command->info('Fixed GIF paths for ' . count($gifMappings) . ' exercises!');
    }
}
