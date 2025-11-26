<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // CHEST EXERCISES
            [
                'name' => 'Barbell Bench Press',
                'category' => 'chest',
                'description' => 'The barbell bench press is a compound exercise that primarily targets the pectoral muscles, with secondary emphasis on the triceps and anterior deltoids. It\'s one of the most effective exercises for building upper body strength and mass.',
                'steps' => [
                    'Lie flat on a bench with your feet firmly planted on the ground',
                    'Grip the barbell slightly wider than shoulder-width apart',
                    'Unrack the bar and position it directly above your chest',
                    'Lower the bar slowly to your mid-chest while keeping your elbows at a 45-degree angle',
                    'Press the bar back up explosively to the starting position',
                    'Repeat for desired reps, maintaining control throughout the movement'
                ],
                'equipment' => ['Barbell', 'Flat Bench', 'Weight Plates', 'Safety Rack'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/bench-press.gif',
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
            ],
            [
                'name' => 'Incline Barbell Bench Press',
                'category' => 'chest',
                'description' => 'The incline barbell bench press targets the upper portion of the pectoral muscles. By adjusting the bench angle, you can emphasize different areas of the chest for complete development.',
                'steps' => [
                    'Set the bench to a 30-45 degree incline',
                    'Lie back with feet flat on the floor',
                    'Grip the barbell slightly wider than shoulder-width',
                    'Unrack and lower the bar to your upper chest',
                    'Press the bar back up to full extension',
                    'Control the descent on each rep'
                ],
                'equipment' => ['Barbell', 'Incline Bench', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/incline-barbell-bench-press.gif',
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
            [
                'name' => 'Dumbbell Bench Press',
                'category' => 'chest',
                'description' => 'The dumbbell bench press allows for a greater range of motion compared to the barbell version and helps correct muscle imbalances by working each side independently.',
                'steps' => [
                    'Sit on the edge of a flat bench with dumbbells on your thighs',
                    'Lie back while bringing the dumbbells to shoulder level',
                    'Position dumbbells at chest level with palms facing forward',
                    'Press the dumbbells up until arms are fully extended',
                    'Lower the dumbbells slowly back to chest level',
                    'Maintain control and avoid clanging the weights together'
                ],
                'equipment' => ['Dumbbells', 'Flat Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/dumbbell-bench-press.gif',
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
            [
                'name' => 'Push-Ups',
                'category' => 'chest',
                'description' => 'A classic bodyweight exercise that builds chest, shoulder, and tricep strength. Push-ups can be performed anywhere and are excellent for muscular endurance.',
                'steps' => [
                    'Start in a plank position with hands slightly wider than shoulders',
                    'Keep your body in a straight line from head to heels',
                    'Lower your body until chest nearly touches the ground',
                    'Keep elbows at a 45-degree angle to your body',
                    'Push back up to starting position',
                    'Repeat while maintaining proper form'
                ],
                'equipment' => ['None (Bodyweight)'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
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

            // SHOULDERS EXERCISES
            [
                'name' => 'Barbell Overhead Press',
                'category' => 'shoulders',
                'description' => 'The overhead press is a fundamental compound movement for building shoulder strength and mass. It engages the entire shoulder complex and requires core stability.',
                'steps' => [
                    'Stand with feet shoulder-width apart',
                    'Grip the barbell at shoulder width',
                    'Start with bar at shoulder level, elbows slightly forward',
                    'Press the bar straight overhead until arms are fully extended',
                    'Lower the bar back to shoulder level with control',
                    'Keep core tight throughout the movement'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/barbell-overhead-press.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids', 'Medial Deltoids'],
                    'secondary' => ['Triceps', 'Upper Chest', 'Core']
                ],
                'tips' => [
                    'Avoid excessive back arching',
                    'Keep the bar path vertical',
                    'Engage your glutes to stabilize your lower body'
                ]
            ],
            [
                'name' => 'Lateral Raises',
                'category' => 'shoulders',
                'description' => 'An isolation exercise that specifically targets the medial deltoids, creating width and definition in the shoulders.',
                'steps' => [
                    'Stand with feet hip-width apart, dumbbells at sides',
                    'Keep a slight bend in your elbows',
                    'Raise dumbbells out to the sides until arms are parallel to floor',
                    'Lead with your elbows, not your hands',
                    'Pause briefly at the top',
                    'Lower dumbbells slowly back to starting position'
                ],
                'equipment' => ['Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/lateral-raises.gif',
                'muscle_groups' => [
                    'primary' => ['Medial Deltoids'],
                    'secondary' => ['Anterior Deltoids', 'Trapezius']
                ],
                'tips' => [
                    'Don\'t use momentum or swing the weights',
                    'Keep shoulders down, don\'t shrug',
                    'Focus on controlled movement, not heavy weight'
                ]
            ],

            // BACK EXERCISES
            [
                'name' => 'Pull-Ups',
                'category' => 'back',
                'description' => 'Pull-ups are one of the best bodyweight exercises for building back width and strength. They engage multiple muscle groups and improve grip strength.',
                'steps' => [
                    'Hang from a pull-up bar with hands slightly wider than shoulders',
                    'Use an overhand grip (palms facing away)',
                    'Start from a dead hang with arms fully extended',
                    'Pull yourself up until chin is above the bar',
                    'Keep core engaged and avoid swinging',
                    'Lower yourself back down with control'
                ],
                'equipment' => ['Pull-up Bar'],
                'difficulty_level' => 'intermediate',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Latissimus Dorsi', 'Teres Major'],
                    'secondary' => ['Biceps', 'Rear Deltoids', 'Trapezius']
                ],
                'tips' => [
                    'Retract shoulder blades at the top',
                    'Use assistance bands if needed',
                    'Avoid kipping unless training for CrossFit'
                ]
            ],
            [
                'name' => 'Barbell Rows',
                'category' => 'back',
                'description' => 'A compound pulling exercise that builds thickness in the back muscles and improves overall back strength.',
                'steps' => [
                    'Stand with feet shoulder-width apart',
                    'Bend at hips and knees, keeping back straight',
                    'Grip barbell slightly wider than shoulder-width',
                    'Pull the bar to your lower chest/upper abdomen',
                    'Squeeze shoulder blades together at the top',
                    'Lower the bar back down with control'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/barbell rows.gif',
                'muscle_groups' => [
                    'primary' => ['Latissimus Dorsi', 'Rhomboids', 'Middle Trapezius'],
                    'secondary' => ['Biceps', 'Rear Deltoids', 'Erector Spinae']
                ],
                'tips' => [
                    'Keep your torso at about 45 degrees',
                    'Don\'t round your lower back',
                    'Pull with your elbows, not your hands'
                ]
            ],

            // ARMS EXERCISES
            [
                'name' => 'Barbell Bicep Curls',
                'category' => 'arms',
                'description' => 'The classic bicep builder. This exercise isolates the biceps and is essential for arm development.',
                'steps' => [
                    'Stand with feet shoulder-width apart',
                    'Grip barbell with underhand grip at shoulder width',
                    'Keep elbows close to your sides',
                    'Curl the bar up toward your shoulders',
                    'Squeeze biceps at the top',
                    'Lower the bar slowly back to starting position'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii'],
                    'secondary' => ['Brachialis', 'Forearms']
                ],
                'tips' => [
                    'Don\'t swing or use momentum',
                    'Keep your back straight',
                    'Control the negative portion of the rep'
                ]
            ],
            [
                'name' => 'Tricep Pushdowns',
                'category' => 'arms',
                'description' => 'An isolation exercise for the triceps using a cable machine. Excellent for building tricep definition and strength.',
                'steps' => [
                    'Stand facing a cable machine with rope or bar attachment',
                    'Grip the attachment with hands close together',
                    'Keep elbows tucked at your sides',
                    'Push the attachment down until arms are fully extended',
                    'Squeeze triceps at the bottom',
                    'Return to starting position with control'
                ],
                'equipment' => ['Cable Machine', 'Rope or Bar Attachment'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/tríceps-pushdown.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii (all three heads)'],
                    'secondary' => ['Anconeus']
                ],
                'tips' => [
                    'Keep elbows stationary throughout',
                    'Don\'t lean forward excessively',
                    'Focus on the squeeze at full extension'
                ]
            ],

            // LEGS EXERCISES
            [
                'name' => 'Barbell Back Squats',
                'category' => 'legs',
                'description' => 'The king of leg exercises. Squats build overall leg mass and strength while engaging the entire body.',
                'steps' => [
                    'Position barbell on upper back/traps',
                    'Stand with feet shoulder-width apart, toes slightly out',
                    'Keep chest up and core braced',
                    'Lower by bending knees and hips simultaneously',
                    'Descend until thighs are at least parallel to ground',
                    'Drive through heels to return to starting position'
                ],
                'equipment' => ['Barbell', 'Squat Rack', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/barbell-back-squats.gif',
                'muscle_groups' => [
                    'primary' => ['Quadriceps', 'Glutes'],
                    'secondary' => ['Hamstrings', 'Core', 'Erector Spinae']
                ],
                'tips' => [
                    'Keep knees tracking over toes',
                    'Don\'t let knees cave inward',
                    'Maintain neutral spine throughout'
                ]
            ],
            [
                'name' => 'Leg Extensions',
                'category' => 'legs',
                'description' => 'An isolation exercise that specifically targets the quadriceps muscles.',
                'steps' => [
                    'Sit on the leg extension machine',
                    'Adjust the pad to rest on your lower shins',
                    'Grip the handles for stability',
                    'Extend your legs until fully straight',
                    'Squeeze quads at the top',
                    'Lower the weight back down with control'
                ],
                'equipment' => ['Leg Extension Machine'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/LEG-EXTENSION.gif',
                'muscle_groups' => [
                    'primary' => ['Quadriceps (all four heads)'],
                    'secondary' => []
                ],
                'tips' => [
                    'Don\'t lock out knees aggressively',
                    'Control the eccentric portion',
                    'Avoid using momentum'
                ]
            ],

            // CORE EXERCISES
            [
                'name' => 'Crunches',
                'category' => 'core',
                'description' => 'A fundamental abdominal exercise that targets the rectus abdominis.',
                'steps' => [
                    'Lie on your back with knees bent, feet flat',
                    'Place hands behind head or across chest',
                    'Engage core and lift shoulder blades off the ground',
                    'Curl up toward your knees',
                    'Pause at the top',
                    'Lower back down with control'
                ],
                'equipment' => ['None (Bodyweight)', 'Exercise Mat (optional)'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Rectus Abdominis'],
                    'secondary' => ['Obliques']
                ],
                'tips' => [
                    'Don\'t pull on your neck',
                    'Focus on using abs, not hip flexors',
                    'Exhale as you crunch up'
                ]
            ],
            [
                'name' => 'Russian Twists',
                'category' => 'core',
                'description' => 'A rotational core exercise that targets the obliques and improves rotational strength.',
                'steps' => [
                    'Sit on the floor with knees bent, feet elevated',
                    'Lean back slightly to engage core',
                    'Hold a weight or medicine ball at chest level',
                    'Rotate torso to one side, touching weight to ground',
                    'Rotate to the other side',
                    'Continue alternating in a controlled manner'
                ],
                'equipment' => ['Medicine Ball or Dumbbell', 'Exercise Mat'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/Russian-Twist.gif',
                'muscle_groups' => [
                    'primary' => ['Obliques', 'Transverse Abdominis'],
                    'secondary' => ['Rectus Abdominis', 'Hip Flexors']
                ],
                'tips' => [
                    'Keep chest up throughout the movement',
                    'Move with control, not momentum',
                    'Keep feet elevated for added difficulty'
                ]
            ],

            // GLUTES EXERCISES
            [
                'name' => 'Barbell Hip Thrusts',
                'category' => 'glutes',
                'description' => 'One of the most effective exercises for building glute strength and size. The hip thrust isolates the glutes better than most exercises.',
                'steps' => [
                    'Sit on the ground with upper back against a bench',
                    'Roll a barbell over your hips (use a pad for comfort)',
                    'Plant feet flat on the ground, shoulder-width apart',
                    'Drive through heels to lift hips up',
                    'Squeeze glutes hard at the top',
                    'Lower hips back down with control'
                ],
                'equipment' => ['Barbell', 'Bench', 'Weight Plates', 'Barbell Pad'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/Barbell-Hip-Thrust.gif',
                'muscle_groups' => [
                    'primary' => ['Gluteus Maximus'],
                    'secondary' => ['Hamstrings', 'Core']
                ],
                'tips' => [
                    'Keep chin tucked throughout',
                    'Don\'t hyperextend your back at the top',
                    'Focus on glute contraction, not just hip height'
                ]
            ],
            [
                'name' => 'Cable Kickbacks',
                'category' => 'glutes',
                'description' => 'An isolation exercise that targets the glutes with constant tension from the cable.',
                'steps' => [
                    'Attach ankle strap to low cable pulley',
                    'Face the machine and hold on for support',
                    'Keep working leg straight',
                    'Kick leg back and up, squeezing glute',
                    'Return to starting position with control',
                    'Complete all reps before switching legs'
                ],
                'equipment' => ['Cable Machine', 'Ankle Strap'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/Cable-Kickback.gif',
                'muscle_groups' => [
                    'primary' => ['Gluteus Maximus'],
                    'secondary' => ['Hamstrings']
                ],
                'tips' => [
                    'Don\'t arch your lower back excessively',
                    'Focus on squeezing the glute',
                    'Keep hips square to the machine'
                ]
            ],

            // CARDIO EXERCISES
            [
                'name' => 'Treadmill',
                'category' => 'cardio',
                'description' => 'Running or walking on a treadmill is an excellent cardiovascular exercise that improves heart health and burns calories.',
                'steps' => [
                    'Step onto the treadmill and start at a slow pace',
                    'Gradually increase speed to desired intensity',
                    'Maintain good posture with shoulders back',
                    'Land mid-foot with each step',
                    'Swing arms naturally',
                    'Cool down by gradually decreasing speed'
                ],
                'equipment' => ['Treadmill'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Cardiovascular System', 'Legs'],
                    'secondary' => ['Core', 'Calves']
                ],
                'tips' => [
                    'Don\'t hold onto the handrails',
                    'Start with a warm-up',
                    'Vary incline and speed for better results'
                ]
            ],
            [
                'name' => 'Jump Rope',
                'category' => 'cardio',
                'description' => 'A high-intensity cardio exercise that improves coordination, agility, and cardiovascular fitness.',
                'steps' => [
                    'Hold rope handles at hip level',
                    'Keep elbows close to your sides',
                    'Rotate the rope using wrist movement',
                    'Jump just high enough to clear the rope',
                    'Land softly on the balls of your feet',
                    'Maintain a steady rhythm'
                ],
                'equipment' => ['Jump Rope'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Cardiovascular System', 'Calves'],
                    'secondary' => ['Shoulders', 'Core', 'Forearms']
                ],
                'tips' => [
                    'Start with short intervals',
                    'Keep jumps low and efficient',
                    'Adjust rope length to your height'
                ]
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create([
                'name' => $exercise['name'],
                'slug' => Str::slug($exercise['name']),
                'category' => $exercise['category'],
                'description' => $exercise['description'],
                'steps' => $exercise['steps'],
                'equipment' => $exercise['equipment'],
                'difficulty_level' => $exercise['difficulty_level'],
                'gif_path' => $exercise['gif_path'],
                'muscle_groups' => $exercise['muscle_groups'],
                'tips' => $exercise['tips'],
            ]);
        }
    }
}
