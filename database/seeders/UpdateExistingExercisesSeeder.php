<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class UpdateExistingExercisesSeeder extends Seeder
{
    /**
     * Update existing exercises with complete data
     */
    public function run(): void
    {
        // Update Barbell Bench Press
        Exercise::where('slug', 'barbell-bench-press')->update([
            'steps' => [
                'Lie flat on a bench with your feet firmly planted on the ground',
                'Grip the barbell slightly wider than shoulder-width apart',
                'Unrack the bar and position it directly above your chest',
                'Lower the bar slowly to your mid-chest while keeping your elbows at a 45-degree angle',
                'Press the bar back up explosively to the starting position',
                'Repeat for desired reps, maintaining control throughout the movement'
            ],
            'equipment' => ['Barbell', 'Flat Bench', 'Weight Plates', 'Safety Rack'],
            'muscle_groups' => [
                'primary' => ['Pectoralis Major', 'Pectoralis Minor'],
                'secondary' => ['Triceps Brachii', 'Anterior Deltoids']
            ],
            'tips' => [
                'Keep your shoulder blades retracted throughout the movement',
                'Maintain a slight arch in your lower back',
                'Don\'t bounce the bar off your chest',
                'Always use a spotter when lifting heavy weights'
            ]
        ]);

        $this->command->info('Updated Barbell Bench Press');

        // Update all other exercises from ExerciseSeeder
        $exercisesData = [
            'incline-barbell-bench-press' => [
                'steps' => [
                    'Set the bench to a 30-45 degree incline',
                    'Lie back with feet flat on the floor',
                    'Grip the barbell slightly wider than shoulder-width',
                    'Unrack and lower the bar to your upper chest',
                    'Press the bar back up to full extension',
                    'Control the descent on each rep'
                ],
                'equipment' => ['Barbell', 'Incline Bench', 'Weight Plates'],
                'muscle_groups' => [
                    'primary' => ['Upper Pectoralis Major', 'Clavicular Head'],
                    'secondary' => ['Anterior Deltoids', 'Triceps']
                ],
                'tips' => [
                    'Avoid setting the incline too steep (over 45 degrees)',
                    'Keep your core engaged throughout',
                    'Focus on squeezing the upper chest at the top'
                ]
            ],
            'dumbbell-bench-press' => [
                'steps' => [
                    'Sit on the edge of a flat bench with dumbbells on your thighs',
                    'Lie back while bringing the dumbbells to shoulder level',
                    'Position dumbbells at chest level with palms facing forward',
                    'Press the dumbbells up until arms are fully extended',
                    'Lower the dumbbells slowly back to chest level',
                    'Maintain control and avoid clanging the weights together'
                ],
                'equipment' => ['Dumbbells', 'Flat Bench'],
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major'],
                    'secondary' => ['Triceps', 'Anterior Deltoids', 'Stabilizers']
                ],
                'tips' => [
                    'Don\'t let dumbbells drift too far apart at the top',
                    'Keep wrists straight and aligned with forearms',
                    'Use a full range of motion for maximum muscle activation'
                ]
            ],
            'push-ups' => [
                'steps' => [
                    'Start in a plank position with hands slightly wider than shoulders',
                    'Keep your body in a straight line from head to heels',
                    'Lower your body until chest nearly touches the ground',
                    'Keep elbows at a 45-degree angle to your body',
                    'Push back up to starting position',
                    'Repeat while maintaining proper form'
                ],
                'equipment' => ['None (Bodyweight)'],
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major', 'Pectoralis Minor'],
                    'secondary' => ['Triceps', 'Anterior Deltoids', 'Core']
                ],
                'tips' => [
                    'Don\'t let your hips sag or pike up',
                    'Breathe in on the way down, out on the way up',
                    'Modify on knees if needed for beginners'
                ]
            ],
        ];

        foreach ($exercisesData as $slug => $data) {
            Exercise::where('slug', $slug)->update($data);
            $this->command->info("Updated exercise: $slug");
        }

        $this->command->info('Exercise data update complete!');
    }
}
