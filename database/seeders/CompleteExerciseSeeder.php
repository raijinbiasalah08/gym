<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompleteExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder adds ALL remaining exercises that don't exist yet
     */
    public function run(): void
    {
        $exercises = [
            // REMAINING CHEST EXERCISES
            [
                'name' => 'Decline Barbell Bench Press',
                'category' => 'chest',
                'description' => 'The decline barbell bench press targets the lower portion of the pectoral muscles. The decline angle shifts emphasis to the lower chest, helping create a well-rounded chest development.',
                'steps' => [
                    'Set the bench to a decline angle (15-30 degrees)',
                    'Secure your legs at the top of the bench',
                    'Lie back and grip the barbell slightly wider than shoulder-width',
                    'Unrack the bar and position it above your lower chest',
                    'Lower the bar to your lower chest with control',
                    'Press the bar back up to full extension'
                ],
                'equipment' => ['Barbell', 'Decline Bench', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/decline-barbell-bench-press.gif',
                'muscle_groups' => [
                    'primary' => ['Lower Pectoralis Major'],
                    'secondary' => ['Triceps', 'Anterior Deltoids']
                ],
                'tips' => [
                    'Keep your feet secured to prevent sliding',
                    'Don\'t bounce the bar off your chest',
                    'Control the descent to maximize muscle engagement'
                ]
            ],
            [
                'name' => 'Incline Dumbbell Press',
                'category' => 'chest',
                'description' => 'Similar to the incline barbell press but with dumbbells, allowing for greater range of motion and independent arm movement.',
                'steps' => [
                    'Set bench to 30-45 degree incline',
                    'Sit with dumbbells on thighs',
                    'Lie back and position dumbbells at shoulder level',
                    'Press dumbbells up and slightly together',
                    'Lower with control back to starting position',
                    'Maintain constant tension on upper chest'
                ],
                'equipment' => ['Dumbbells', 'Incline Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Upper Pectoralis Major'],
                    'secondary' => ['Anterior Deltoids', 'Triceps']
                ],
                'tips' => [
                    'Don\'t let dumbbells drift too far apart',
                    'Keep elbows at 45-degree angle',
                    'Focus on squeezing upper chest at top'
                ]
            ],
            [
                'name' => 'Dumbbell Flyes',
                'category' => 'chest',
                'description' => 'An isolation exercise that stretches and contracts the chest muscles through a wide arc of motion.',
                'steps' => [
                    'Lie flat on bench with dumbbells above chest',
                    'Keep slight bend in elbows throughout',
                    'Lower dumbbells out to sides in wide arc',
                    'Feel stretch in chest at bottom',
                    'Bring dumbbells back together above chest',
                    'Squeeze chest at the top'
                ],
                'equipment' => ['Dumbbells', 'Flat Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/dumbbell-flyes.gif',
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major'],
                    'secondary' => ['Anterior Deltoids']
                ],
                'tips' => [
                    'Use lighter weight than pressing movements',
                    'Maintain slight elbow bend - don\'t straighten arms',
                    'Control the stretch at the bottom'
                ]
            ],
            [
                'name' => 'Incline Dumbbell Flyes',
                'category' => 'chest',
                'description' => 'Targets the upper chest with a stretching motion, excellent for chest development and definition.',
                'steps' => [
                    'Set bench to 30-45 degree incline',
                    'Start with dumbbells above upper chest',
                    'Lower dumbbells in wide arc to sides',
                    'Keep elbows slightly bent',
                    'Feel stretch in upper chest',
                    'Return to starting position with controlled motion'
                ],
                'equipment' => ['Dumbbells', 'Incline Bench'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/incline-dumbbell-flyes.gif',
                'muscle_groups' => [
                    'primary' => ['Upper Pectoralis Major'],
                    'secondary' => ['Anterior Deltoids']
                ],
                'tips' => [
                    'Don\'t go too heavy on this isolation exercise',
                    'Focus on the stretch and contraction',
                    'Keep movement smooth and controlled'
                ]
            ],
            [
                'name' => 'Cable Crossover',
                'category' => 'chest',
                'description' => 'A cable exercise that provides constant tension throughout the movement, excellent for chest definition.',
                'steps' => [
                    'Stand in center of cable station',
                    'Grab high pulley handles',
                    'Step forward with slight lean',
                    'Bring handles together in front of chest',
                    'Squeeze chest at peak contraction',
                    'Return to starting position with control'
                ],
                'equipment' => ['Cable Machine', 'D-Handles'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/cable-crossover.gif',
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major'],
                    'secondary' => ['Anterior Deltoids']
                ],
                'tips' => [
                    'Keep core engaged for stability',
                    'Don\'t let arms drift too far back',
                    'Focus on squeezing chest together'
                ]
            ],
            [
                'name' => 'Pec Deck Machine',
                'category' => 'chest',
                'description' => 'A machine-based isolation exercise that targets the chest with a controlled movement pattern.',
                'steps' => [
                    'Adjust seat height so handles are at chest level',
                    'Sit with back flat against pad',
                    'Grip handles with elbows at 90 degrees',
                    'Bring handles together in front of chest',
                    'Squeeze chest at peak contraction',
                    'Return to starting position slowly'
                ],
                'equipment' => ['Pec Deck Machine'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/pec-deck-machine.gif',
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major'],
                    'secondary' => []
                ],
                'tips' => [
                    'Don\'t use momentum',
                    'Keep back pressed against pad',
                    'Control both the positive and negative portions'
                ]
            ],
            [
                'name' => 'Decline Push-Ups',
                'category' => 'chest',
                'description' => 'An advanced push-up variation with feet elevated, increasing difficulty and upper chest emphasis.',
                'steps' => [
                    'Place feet on elevated surface (bench, box)',
                    'Hands on ground shoulder-width apart',
                    'Keep body in straight line',
                    'Lower chest toward ground',
                    'Push back up to starting position',
                    'Maintain core engagement throughout'
                ],
                'equipment' => ['Bench or Box'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/decline-push-ups.gif',
                'muscle_groups' => [
                    'primary' => ['Upper Pectoralis Major'],
                    'secondary' => ['Triceps', 'Anterior Deltoids', 'Core']
                ],
                'tips' => [
                    'Keep hips from sagging',
                    'Control the descent',
                    'Full range of motion for best results'
                ]
            ],
            [
                'name' => 'Chest Dips',
                'category' => 'chest',
                'description' => 'A bodyweight exercise that targets the lower chest and triceps with significant intensity.',
                'steps' => [
                    'Grip parallel bars and lift yourself up',
                    'Lean forward slightly (chest emphasis)',
                    'Lower body by bending elbows',
                    'Go down until slight stretch in chest',
                    'Push back up to starting position',
                    'Keep elbows flared slightly outward'
                ],
                'equipment' => ['Dip Bars or Dip Station'],
                'difficulty_level' => 'intermediate',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Lower Pectoralis Major', 'Triceps'],
                    'secondary' => ['Anterior Deltoids']
                ],
                'tips' => [
                    'Lean forward for chest emphasis',
                    'Don\'t go too deep if you feel shoulder discomfort',
                    'Add weight when bodyweight becomes easy'
                ]
            ],
            [
                'name' => 'Cable Chest Press',
                'category' => 'chest',
                'description' => 'A cable variation of the chest press providing constant tension throughout the movement.',
                'steps' => [
                    'Set cables to chest height',
                    'Stand in center with handles in each hand',
                    'Step forward into split stance',
                    'Press handles forward and together',
                    'Squeeze chest at full extension',
                    'Return to starting position with control'
                ],
                'equipment' => ['Cable Machine', 'D-Handles'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/cable-chest-press.gif',
                'muscle_groups' => [
                    'primary' => ['Pectoralis Major'],
                    'secondary' => ['Triceps', 'Anterior Deltoids']
                ],
                'tips' => [
                    'Keep core tight for stability',
                    'Don\'t let cables pull you backward',
                    'Maintain constant tension'
                ]
            ],
            [
                'name' => 'Landmine Press',
                'category' => 'chest',
                'description' => 'A unique pressing angle using a landmine attachment, great for upper chest and shoulder development.',
                'steps' => [
                    'Load barbell in landmine attachment',
                    'Hold end of barbell at chest level',
                    'Press barbell up and forward',
                    'Follow natural arc of movement',
                    'Lower back to chest with control',
                    'Repeat for desired reps'
                ],
                'equipment' => ['Barbell', 'Landmine Attachment', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/landmine-press.gif',
                'muscle_groups' => [
                    'primary' => ['Upper Pectoralis Major', 'Anterior Deltoids'],
                    'secondary' => ['Triceps', 'Core']
                ],
                'tips' => [
                    'Keep core engaged throughout',
                    'Follow the natural arc - don\'t fight it',
                    'Can be done single-arm or double-arm'
                ]
            ],

            // REMAINING SHOULDER EXERCISES
            [
                'name' => 'Seated Barbell Press',
                'category' => 'shoulders',
                'description' => 'A seated variation of the overhead press that provides back support and isolates the shoulders.',
                'steps' => [
                    'Sit on bench with back support',
                    'Grip barbell at shoulder width',
                    'Start with bar at upper chest level',
                    'Press bar straight overhead',
                    'Lower back to starting position',
                    'Keep core engaged throughout'
                ],
                'equipment' => ['Barbell', 'Bench with Back Support', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/seated-barbell-press.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids', 'Medial Deltoids'],
                    'secondary' => ['Triceps', 'Upper Chest']
                ],
                'tips' => [
                    'Keep back pressed against pad',
                    'Don\'t arch excessively',
                    'Control the descent'
                ]
            ],
            [
                'name' => 'Dumbbell Shoulder Press',
                'category' => 'shoulders',
                'description' => 'A fundamental shoulder exercise using dumbbells for independent arm movement and balanced development.',
                'steps' => [
                    'Sit on bench with back support',
                    'Hold dumbbells at shoulder level',
                    'Press dumbbells overhead',
                    'Bring dumbbells together at top',
                    'Lower back to shoulder level',
                    'Maintain control throughout'
                ],
                'equipment' => ['Dumbbells', 'Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/dumbbell-shoulder-press.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids', 'Medial Deltoids'],
                    'secondary' => ['Triceps', 'Upper Chest']
                ],
                'tips' => [
                    'Don\'t let dumbbells drift too far forward or back',
                    'Keep wrists straight',
                    'Full range of motion for best results'
                ]
            ],
            [
                'name' => 'Arnold Press',
                'category' => 'shoulders',
                'description' => 'Named after Arnold Schwarzenegger, this exercise combines a press with rotation for complete shoulder development.',
                'steps' => [
                    'Start with dumbbells at shoulder level, palms facing you',
                    'As you press up, rotate palms to face forward',
                    'Finish with arms extended overhead',
                    'Reverse the motion on the way down',
                    'Return to starting position with palms facing you',
                    'Maintain smooth, controlled rotation'
                ],
                'equipment' => ['Dumbbells', 'Bench'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/arnold-press.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids', 'Medial Deltoids'],
                    'secondary' => ['Posterior Deltoids', 'Triceps']
                ],
                'tips' => [
                    'Use lighter weight than regular shoulder press',
                    'Focus on smooth rotation',
                    'Don\'t rush the movement'
                ]
            ],
            [
                'name' => 'Push Press',
                'category' => 'shoulders',
                'description' => 'An explosive overhead press variation using leg drive to move heavier weights.',
                'steps' => [
                    'Start with barbell at shoulder level',
                    'Dip knees slightly',
                    'Explosively drive through legs',
                    'Press bar overhead as you extend legs',
                    'Lock out arms at top',
                    'Lower bar back to shoulders with control'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'advanced',
                'gif_path' => '/lottie/exercises/push-press.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids', 'Medial Deltoids'],
                    'secondary' => ['Triceps', 'Quadriceps', 'Core']
                ],
                'tips' => [
                    'Use leg drive, don\'t just press with arms',
                    'Keep bar path vertical',
                    'This is a power movement - be explosive'
                ]
            ],
            [
                'name' => 'Front Raises',
                'category' => 'shoulders',
                'description' => 'An isolation exercise targeting the front deltoids.',
                'steps' => [
                    'Stand with dumbbells in front of thighs',
                    'Keep slight bend in elbows',
                    'Raise dumbbells forward to shoulder height',
                    'Pause briefly at top',
                    'Lower back down with control',
                    'Alternate arms or do both together'
                ],
                'equipment' => ['Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/front-raises.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids'],
                    'secondary' => ['Upper Chest']
                ],
                'tips' => [
                    'Don\'t use momentum',
                    'Keep core tight',
                    'Stop at shoulder height - no higher'
                ]
            ],

            // REMAINING SHOULDER EXERCISES (continued)
            [
                'name' => 'Cable Lateral Raises',
                'category' => 'shoulders',
                'description' => 'Cable variation of lateral raises providing constant tension on the medial deltoids.',
                'steps' => [
                    'Stand sideways to cable machine',
                    'Grab low pulley handle with far hand',
                    'Raise cable out to side to shoulder height',
                    'Keep elbow slightly bent',
                    'Lower with control',
                    'Complete all reps then switch sides'
                ],
                'equipment' => ['Cable Machine', 'D-Handle'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/cable-lateral-raises.gif',
                'muscle_groups' => [
                    'primary' => ['Medial Deltoids'],
                    'secondary' => ['Trapezius']
                ],
                'tips' => [
                    'Don\'t swing the weight',
                    'Lead with elbow, not hand',
                    'Keep constant tension on muscle'
                ]
            ],
            [
                'name' => 'Dumbbell Shrugs',
                'category' => 'shoulders',
                'description' => 'Targets the trapezius muscles for upper back and neck development.',
                'steps' => [
                    'Stand with dumbbells at sides',
                    'Keep arms straight',
                    'Shrug shoulders straight up toward ears',
                    'Hold peak contraction briefly',
                    'Lower shoulders back down',
                    'Don\'t roll shoulders - straight up and down'
                ],
                'equipment' => ['Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/dumbbell-shrugs.gif',
                'muscle_groups' => [
                    'primary' => ['Upper Trapezius'],
                    'secondary' => ['Levator Scapulae']
                ],
                'tips' => [
                    'Don\'t roll shoulders in circles',
                    'Keep arms straight throughout',
                    'Focus on squeezing traps at top'
                ]
            ],
            [
                'name' => 'Face Pulls',
                'category' => 'shoulders',
                'description' => 'Excellent for rear deltoids and upper back, important for shoulder health and posture.',
                'steps' => [
                    'Set cable to upper chest height',
                    'Use rope attachment',
                    'Pull rope toward face',
                    'Separate hands at end of pull',
                    'Squeeze shoulder blades together',
                    'Return to start with control'
                ],
                'equipment' => ['Cable Machine', 'Rope Attachment'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/face-pulls.gif',
                'muscle_groups' => [
                    'primary' => ['Posterior Deltoids', 'Rhomboids'],
                    'secondary' => ['Middle Trapezius', 'Rotator Cuff']
                ],
                'tips' => [
                    'Pull to face level, not chest',
                    'Focus on external rotation',
                    'Great for shoulder health'
                ]
            ],
            [
                'name' => 'Plate Front Raise',
                'category' => 'shoulders',
                'description' => 'Front deltoid isolation using a weight plate for variety.',
                'steps' => [
                    'Hold weight plate at bottom with both hands',
                    'Stand with feet shoulder-width apart',
                    'Raise plate forward to shoulder height',
                    'Keep arms slightly bent',
                    'Lower back down with control',
                    'Maintain core engagement'
                ],
                'equipment' => ['Weight Plate'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/plate-front-raise.gif',
                'muscle_groups' => [
                    'primary' => ['Anterior Deltoids'],
                    'secondary' => ['Upper Chest', 'Core']
                ],
                'tips' => [
                    'Don\'t swing the plate',
                    'Control the movement',
                    'Stop at shoulder height'
                ]
            ],

            // BACK EXERCISES
            [
                'name' => 'Lat Pulldown',
                'category' => 'back',
                'description' => 'A fundamental back exercise that targets the latissimus dorsi, great for building back width.',
                'steps' => [
                    'Sit at lat pulldown machine',
                    'Grip bar wider than shoulder-width',
                    'Pull bar down to upper chest',
                    'Squeeze shoulder blades together',
                    'Control the return to starting position',
                    'Keep chest up throughout'
                ],
                'equipment' => ['Lat Pulldown Machine'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/lat-pulldown.gif',
                'muscle_groups' => [
                    'primary' => ['Latissimus Dorsi'],
                    'secondary' => ['Biceps', 'Rhomboids', 'Trapezius']
                ],
                'tips' => [
                    'Pull with elbows, not hands',
                    'Don\'t lean back excessively',
                    'Focus on squeezing lats'
                ]
            ],
            [
                'name' => 'Close Grip Lat Pulldown',
                'category' => 'back',
                'description' => 'Narrow grip variation emphasizing the lower lats and providing greater range of motion.',
                'steps' => [
                    'Use close grip attachment',
                    'Sit with knees secured',
                    'Pull attachment to upper chest',
                    'Keep elbows close to body',
                    'Squeeze lats at bottom',
                    'Return to full stretch at top'
                ],
                'equipment' => ['Lat Pulldown Machine', 'Close Grip Attachment'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/close-grip-lat-pulldown.gif',
                'muscle_groups' => [
                    'primary' => ['Lower Latissimus Dorsi'],
                    'secondary' => ['Biceps', 'Rhomboids']
                ],
                'tips' => [
                    'Greater range of motion than wide grip',
                    'Focus on lower lat contraction',
                    'Keep chest up'
                ]
            ],
            [
                'name' => 'Dumbbell Rows',
                'category' => 'back',
                'description' => 'Unilateral rowing exercise that builds back thickness and corrects imbalances.',
                'steps' => [
                    'Place one knee and hand on bench',
                    'Hold dumbbell in opposite hand',
                    'Pull dumbbell to hip',
                    'Keep elbow close to body',
                    'Squeeze back at top',
                    'Lower with control'
                ],
                'equipment' => ['Dumbbell', 'Flat Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/dumbbell-rows.gif',
                'muscle_groups' => [
                    'primary' => ['Latissimus Dorsi', 'Rhomboids'],
                    'secondary' => ['Biceps', 'Rear Deltoids']
                ],
                'tips' => [
                    'Keep back flat, don\'t rotate',
                    'Pull to hip, not chest',
                    'Focus on squeezing back muscles'
                ]
            ],
            [
                'name' => 'Deadlifts',
                'category' => 'back',
                'description' => 'The king of back exercises, building overall back strength and mass.',
                'steps' => [
                    'Stand with feet hip-width apart',
                    'Grip barbell just outside legs',
                    'Keep back straight, chest up',
                    'Drive through heels to stand up',
                    'Squeeze glutes at top',
                    'Lower bar back down with control'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'advanced',
                'gif_path' => '/lottie/exercises/back-deadlifts.gif',
                'muscle_groups' => [
                    'primary' => ['Erector Spinae', 'Glutes', 'Hamstrings'],
                    'secondary' => ['Trapezius', 'Lats', 'Forearms']
                ],
                'tips' => [
                    'Keep bar close to body',
                    'Don\'t round your back',
                    'This is a full body exercise'
                ]
            ],
            [
                'name' => 'Chin-Ups',
                'category' => 'back',
                'description' => 'Underhand grip pull-up variation with greater bicep involvement.',
                'steps' => [
                    'Hang from bar with underhand grip',
                    'Hands shoulder-width apart',
                    'Pull yourself up until chin over bar',
                    'Keep core engaged',
                    'Lower yourself with control',
                    'Full extension at bottom'
                ],
                'equipment' => ['Pull-up Bar'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/chin-ups.gif',
                'muscle_groups' => [
                    'primary' => ['Latissimus Dorsi', 'Biceps'],
                    'secondary' => ['Rhomboids', 'Rear Deltoids']
                ],
                'tips' => [
                    'Easier than pull-ups due to bicep involvement',
                    'Use assistance if needed',
                    'Full range of motion'
                ]
            ],
            [
                'name' => 'Chest Supported Rows',
                'category' => 'back',
                'description' => 'Rowing variation with chest support to isolate the back muscles.',
                'steps' => [
                    'Lie face down on incline bench',
                    'Hold dumbbells hanging down',
                    'Pull dumbbells to sides of chest',
                    'Squeeze shoulder blades together',
                    'Lower with control',
                    'Keep chest pressed against bench'
                ],
                'equipment' => ['Dumbbells', 'Incline Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/chest-supported-rows.gif',
                'muscle_groups' => [
                    'primary' => ['Rhomboids', 'Middle Trapezius'],
                    'secondary' => ['Latissimus Dorsi', 'Rear Deltoids']
                ],
                'tips' => [
                    'Chest support removes lower back stress',
                    'Focus purely on back muscles',
                    'Great for high reps'
                ]
            ],
            [
                'name' => 'Hyperextensions',
                'category' => 'back',
                'description' => 'Lower back exercise that strengthens the erector spinae.',
                'steps' => [
                    'Position yourself on hyperextension bench',
                    'Cross arms over chest',
                    'Lower torso toward ground',
                    'Raise back up to parallel',
                    'Squeeze glutes and lower back',
                    'Don\'t hyperextend past parallel'
                ],
                'equipment' => ['Hyperextension Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/hyperextensions.gif',
                'muscle_groups' => [
                    'primary' => ['Erector Spinae'],
                    'secondary' => ['Glutes', 'Hamstrings']
                ],
                'tips' => [
                    'Don\'t go too high - stop at parallel',
                    'Control the movement',
                    'Great for lower back health'
                ]
            ],

            // ARMS EXERCISES
            [
                'name' => 'Dumbbell Bicep Curls',
                'category' => 'arms',
                'description' => 'Classic bicep exercise using dumbbells for independent arm development.',
                'steps' => [
                    'Stand with dumbbells at sides',
                    'Keep elbows close to body',
                    'Curl dumbbells up to shoulders',
                    'Squeeze biceps at top',
                    'Lower with control',
                    'Can alternate or do both together'
                ],
                'equipment' => ['Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii'],
                    'secondary' => ['Brachialis', 'Forearms']
                ],
                'tips' => [
                    'Don\'t swing the weights',
                    'Keep elbows stationary',
                    'Full range of motion'
                ]
            ],
            [
                'name' => 'Hammer Curls',
                'category' => 'arms',
                'description' => 'Neutral grip curl that targets the brachialis and brachioradialis.',
                'steps' => [
                    'Hold dumbbells with neutral grip (palms facing each other)',
                    'Keep elbows at sides',
                    'Curl dumbbells up',
                    'Maintain neutral grip throughout',
                    'Lower back down with control',
                    'Alternate or do both together'
                ],
                'equipment' => ['Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/hammer-curls.gif',
                'muscle_groups' => [
                    'primary' => ['Brachialis', 'Brachioradialis'],
                    'secondary' => ['Biceps Brachii']
                ],
                'tips' => [
                    'Builds arm thickness',
                    'Easier on wrists than supinated curls',
                    'Keep wrists neutral'
                ]
            ],
            [
                'name' => 'Preacher Curl',
                'category' => 'arms',
                'description' => 'Isolated bicep exercise using a preacher bench to prevent cheating.',
                'steps' => [
                    'Sit at preacher bench',
                    'Rest arms on pad',
                    'Curl weight up',
                    'Squeeze biceps at top',
                    'Lower to full extension',
                    'Keep arms on pad throughout'
                ],
                'equipment' => ['Preacher Bench', 'EZ Bar or Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/preacher-curl.gif',
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii (especially lower portion)'],
                    'secondary' => ['Brachialis']
                ],
                'tips' => [
                    'Can\'t cheat with this exercise',
                    'Great for bicep peak',
                    'Don\'t hyperextend at bottom'
                ]
            ],
            [
                'name' => 'Cable Bicep Curl',
                'category' => 'arms',
                'description' => 'Cable variation providing constant tension on the biceps.',
                'steps' => [
                    'Stand facing low cable pulley',
                    'Grip bar with underhand grip',
                    'Curl bar up to shoulders',
                    'Keep elbows at sides',
                    'Squeeze at top',
                    'Lower with control'
                ],
                'equipment' => ['Cable Machine', 'Straight Bar Attachment'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/cable-bicep-curl.gif',
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii'],
                    'secondary' => ['Brachialis', 'Forearms']
                ],
                'tips' => [
                    'Constant tension throughout movement',
                    'Don\'t let cable pull you forward',
                    'Control both directions'
                ]
            ],
            [
                'name' => 'Incline Dumbbell Curl',
                'category' => 'arms',
                'description' => 'Bicep curl on an incline bench for greater stretch and long head emphasis.',
                'steps' => [
                    'Sit on incline bench (45 degrees)',
                    'Let arms hang straight down',
                    'Curl dumbbells up',
                    'Keep upper arms stationary',
                    'Squeeze biceps at top',
                    'Lower to full stretch'
                ],
                'equipment' => ['Dumbbells', 'Incline Bench'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/incline-dumbbell-curl.gif',
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii (long head)'],
                    'secondary' => ['Brachialis']
                ],
                'tips' => [
                    'Great stretch on biceps',
                    'Targets long head of biceps',
                    'Use lighter weight than standing curls'
                ]
            ],
            [
                'name' => 'Concentration Curl',
                'category' => 'arms',
                'description' => 'Isolated bicep exercise performed seated with arm braced against leg.',
                'steps' => [
                    'Sit on bench with legs spread',
                    'Brace elbow against inner thigh',
                    'Curl dumbbell up',
                    'Squeeze bicep at top',
                    'Lower with control',
                    'Complete all reps then switch arms'
                ],
                'equipment' => ['Dumbbell', 'Bench'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/Concentration-Curl.gif',
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii (peak)'],
                    'secondary' => ['Brachialis']
                ],
                'tips' => [
                    'Perfect isolation - can\'t cheat',
                    'Great for bicep peak',
                    'Focus on squeeze at top'
                ]
            ],
            [
                'name' => '21s',
                'category' => 'arms',
                'description' => 'Advanced bicep training method using partial reps in three ranges.',
                'steps' => [
                    '7 reps: bottom half (arms straight to 90 degrees)',
                    '7 reps: top half (90 degrees to full contraction)',
                    '7 reps: full range of motion',
                    'No rest between ranges',
                    'Use lighter weight than normal curls',
                    'Prepare for intense pump'
                ],
                'equipment' => ['Barbell or Dumbbells'],
                'difficulty_level' => 'advanced',
                'gif_path' => '/lottie/exercises/21s.gif',
                'muscle_groups' => [
                    'primary' => ['Biceps Brachii'],
                    'secondary' => ['Brachialis', 'Forearms']
                ],
                'tips' => [
                    'Intense bicep workout',
                    'Use 50-60% of normal curl weight',
                    'Great for breaking plateaus'
                ]
            ],
            [
                'name' => 'Tricep Dips',
                'category' => 'arms',
                'description' => 'Bodyweight exercise for triceps, can also target chest depending on form.',
                'steps' => [
                    'Grip parallel bars',
                    'Keep body upright (tricep emphasis)',
                    'Lower body by bending elbows',
                    'Go down until elbows at 90 degrees',
                    'Push back up to starting position',
                    'Keep elbows close to body'
                ],
                'equipment' => ['Dip Bars'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/Triceps-Dips.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii'],
                    'secondary' => ['Chest', 'Anterior Deltoids']
                ],
                'tips' => [
                    'Stay upright for tricep emphasis',
                    'Add weight when bodyweight becomes easy',
                    'Don\'t go too deep if shoulders hurt'
                ]
            ],
            [
                'name' => 'Skull Crushers',
                'category' => 'arms',
                'description' => 'Lying tricep extension targeting all three heads of the triceps.',
                'steps' => [
                    'Lie on bench with barbell above chest',
                    'Lower bar to forehead by bending elbows',
                    'Keep upper arms stationary',
                    'Extend arms back to starting position',
                    'Squeeze triceps at top',
                    'Control the descent'
                ],
                'equipment' => ['Barbell or EZ Bar', 'Flat Bench'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/SKULL_CRUSHERS.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii (all three heads)'],
                    'secondary' => []
                ],
                'tips' => [
                    'Keep elbows in, don\'t let them flare',
                    'Control the weight carefully',
                    'EZ bar is easier on wrists'
                ]
            ],
            [
                'name' => 'Overhead Triceps Extensions',
                'category' => 'arms',
                'description' => 'Overhead extension emphasizing the long head of the triceps.',
                'steps' => [
                    'Stand or sit with dumbbell overhead',
                    'Hold dumbbell with both hands',
                    'Lower dumbbell behind head',
                    'Keep elbows pointing forward',
                    'Extend arms back to starting position',
                    'Squeeze triceps at top'
                ],
                'equipment' => ['Dumbbell'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/overhead-triceps-extensions.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii (long head)'],
                    'secondary' => []
                ],
                'tips' => [
                    'Great stretch on triceps',
                    'Keep elbows from flaring out',
                    'Can be done seated or standing'
                ]
            ],
            [
                'name' => 'Close Grip Bench Press',
                'category' => 'arms',
                'description' => 'Compound pressing movement emphasizing the triceps.',
                'steps' => [
                    'Lie on bench',
                    'Grip barbell with hands shoulder-width or closer',
                    'Lower bar to lower chest',
                    'Keep elbows close to body',
                    'Press back up',
                    'Squeeze triceps at top'
                ],
                'equipment' => ['Barbell', 'Flat Bench', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/close-grip-bench-press.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii'],
                    'secondary' => ['Chest', 'Anterior Deltoids']
                ],
                'tips' => [
                    'Don\'t go too narrow - shoulder width is fine',
                    'Keep elbows tucked',
                    'Great mass builder for triceps'
                ]
            ],
            [
                'name' => 'Diamond Push-Ups',
                'category' => 'arms',
                'description' => 'Bodyweight tricep exercise with hands forming a diamond shape.',
                'steps' => [
                    'Get in push-up position',
                    'Place hands together forming diamond with thumbs and index fingers',
                    'Lower chest to hands',
                    'Keep elbows close to body',
                    'Push back up',
                    'Squeeze triceps at top'
                ],
                'equipment' => ['None (Bodyweight)'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/diamond-push-ups.gif',
                'muscle_groups' => [
                    'primary' => ['Triceps Brachii'],
                    'secondary' => ['Chest', 'Anterior Deltoids', 'Core']
                ],
                'tips' => [
                    'Harder than regular push-ups',
                    'Keep body straight',
                    'Great for tricep definition'
                ]
            ],

            // LEGS EXERCISES
            [
                'name' => 'Front Squat',
                'category' => 'legs',
                'description' => 'Squat variation with barbell in front, emphasizing quads and core.',
                'steps' => [
                    'Rest barbell on front of shoulders',
                    'Cross arms or use clean grip',
                    'Keep chest up and elbows high',
                    'Squat down keeping torso upright',
                    'Drive through heels to stand',
                    'Maintain upright posture throughout'
                ],
                'equipment' => ['Barbell', 'Squat Rack', 'Weight Plates'],
                'difficulty_level' => 'advanced',
                'gif_path' => '/lottie/exercises/Front-Squat.gif',
                'muscle_groups' => [
                    'primary' => ['Quadriceps'],
                    'secondary' => ['Glutes', 'Core', 'Upper Back']
                ],
                'tips' => [
                    'Keep elbows high to prevent bar rolling',
                    'More quad emphasis than back squat',
                    'Requires good mobility'
                ]
            ],
            [
                'name' => 'Leg Curls',
                'category' => 'legs',
                'description' => 'Isolation exercise for the hamstrings.',
                'steps' => [
                    'Lie face down on leg curl machine',
                    'Position pad on back of ankles',
                    'Curl legs up toward glutes',
                    'Squeeze hamstrings at top',
                    'Lower with control',
                    'Don\'t let weight stack touch between reps'
                ],
                'equipment' => ['Leg Curl Machine'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/LEG_CURL.gif',
                'muscle_groups' => [
                    'primary' => ['Hamstrings'],
                    'secondary' => ['Calves']
                ],
                'tips' => [
                    'Don\'t lift hips off pad',
                    'Full range of motion',
                    'Control the negative'
                ]
            ],
            [
                'name' => 'Hack Squats',
                'category' => 'legs',
                'description' => 'Machine squat variation targeting the quads with back support.',
                'steps' => [
                    'Position shoulders under pads',
                    'Place feet on platform shoulder-width apart',
                    'Release safety handles',
                    'Lower by bending knees',
                    'Go down until thighs parallel or below',
                    'Drive through heels to return'
                ],
                'equipment' => ['Hack Squat Machine'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/hack-squats.gif',
                'muscle_groups' => [
                    'primary' => ['Quadriceps'],
                    'secondary' => ['Glutes', 'Hamstrings']
                ],
                'tips' => [
                    'Keep back pressed against pad',
                    'Great quad isolation',
                    'Easier on lower back than free squats'
                ]
            ],
            [
                'name' => 'Bulgarian Split Squat',
                'category' => 'legs',
                'description' => 'Single-leg squat variation with rear foot elevated.',
                'steps' => [
                    'Place rear foot on bench behind you',
                    'Front foot forward in lunge position',
                    'Lower down by bending front knee',
                    'Keep torso upright',
                    'Drive through front heel to stand',
                    'Complete all reps then switch legs'
                ],
                'equipment' => ['Bench', 'Dumbbells (optional)'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/Bulgarian-Split-Squat.gif',
                'muscle_groups' => [
                    'primary' => ['Quadriceps', 'Glutes'],
                    'secondary' => ['Hamstrings', 'Core']
                ],
                'tips' => [
                    'Great for balance and unilateral strength',
                    'Front knee shouldn\'t go past toes excessively',
                    'Challenging but very effective'
                ]
            ],
            [
                'name' => 'Romanian Deadlifts',
                'category' => 'legs',
                'description' => 'Hip hinge movement targeting hamstrings and glutes.',
                'steps' => [
                    'Hold barbell at hip level',
                    'Keep knees slightly bent',
                    'Hinge at hips, lowering bar down legs',
                    'Feel stretch in hamstrings',
                    'Drive hips forward to return',
                    'Keep back straight throughout'
                ],
                'equipment' => ['Barbell', 'Weight Plates'],
                'difficulty_level' => 'intermediate',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Hamstrings', 'Glutes'],
                    'secondary' => ['Erector Spinae', 'Forearms']
                ],
                'tips' => [
                    'This is a hip hinge, not a squat',
                    'Keep bar close to legs',
                    'Great for hamstring development'
                ]
            ],
            [
                'name' => 'Sumo Squats',
                'category' => 'glutes',
                'description' => 'Wide stance squat emphasizing inner thighs and glutes.',
                'steps' => [
                    'Stand with feet wider than shoulder-width',
                    'Point toes outward at 45 degrees',
                    'Squat down keeping knees tracking over toes',
                    'Keep torso upright',
                    'Drive through heels to stand',
                    'Squeeze glutes at top'
                ],
                'equipment' => ['Barbell or Dumbbells'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Glutes', 'Adductors'],
                    'secondary' => ['Quadriceps', 'Hamstrings']
                ],
                'tips' => [
                    'Great for inner thigh and glute development',
                    'Keep knees pushed out',
                    'Wider stance than regular squats'
                ]
            ],
            [
                'name' => 'Glute Kickback Machine',
                'category' => 'glutes',
                'description' => 'Machine-based glute isolation exercise.',
                'steps' => [
                    'Position yourself on glute kickback machine',
                    'Place working leg on pad',
                    'Kick leg back and up',
                    'Squeeze glute at top',
                    'Return to starting position',
                    'Complete all reps then switch legs'
                ],
                'equipment' => ['Glute Kickback Machine'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/GLUTE_Kickback-machine.gif',
                'muscle_groups' => [
                    'primary' => ['Gluteus Maximus'],
                    'secondary' => ['Hamstrings']
                ],
                'tips' => [
                    'Focus on glute contraction',
                    'Don\'t hyperextend lower back',
                    'Control the movement'
                ]
            ],

            // CORE EXERCISES
            [
                'name' => 'Reverse Crunches',
                'category' => 'core',
                'description' => 'Targets the lower abs by bringing knees toward chest.',
                'steps' => [
                    'Lie on back with knees bent',
                    'Lift knees toward chest',
                    'Curl hips off ground',
                    'Squeeze abs at top',
                    'Lower back down with control',
                    'Don\'t let feet touch ground between reps'
                ],
                'equipment' => ['Exercise Mat'],
                'difficulty_level' => 'beginner',
                'gif_path' => null,
                'muscle_groups' => [
                    'primary' => ['Lower Rectus Abdominis'],
                    'secondary' => ['Hip Flexors']
                ],
                'tips' => [
                    'Focus on using abs, not momentum',
                    'Curl hips up, don\'t just bring knees in',
                    'Great for lower ab development'
                ]
            ],
            [
                'name' => 'Bicycle Crunches',
                'category' => 'core',
                'description' => 'Dynamic ab exercise targeting obliques and rectus abdominis.',
                'steps' => [
                    'Lie on back with hands behind head',
                    'Bring opposite elbow to opposite knee',
                    'Extend other leg out',
                    'Alternate sides in cycling motion',
                    'Keep core engaged throughout',
                    'Don\'t pull on neck'
                ],
                'equipment' => ['Exercise Mat'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/Bicycle-Crunch.gif',
                'muscle_groups' => [
                    'primary' => ['Rectus Abdominis', 'Obliques'],
                    'secondary' => ['Hip Flexors']
                ],
                'tips' => [
                    'Focus on rotation',
                    'Don\'t rush - control the movement',
                    'Very effective for core'
                ]
            ],
            [
                'name' => 'Cable Crunches',
                'category' => 'core',
                'description' => 'Weighted ab exercise using cable machine for progressive overload.',
                'steps' => [
                    'Kneel facing cable machine',
                    'Hold rope attachment at head level',
                    'Crunch down bringing elbows to knees',
                    'Squeeze abs at bottom',
                    'Return to starting position',
                    'Keep hips stationary'
                ],
                'equipment' => ['Cable Machine', 'Rope Attachment'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/Cable-Crunch.gif',
                'muscle_groups' => [
                    'primary' => ['Rectus Abdominis'],
                    'secondary' => ['Obliques']
                ],
                'tips' => [
                    'Can add weight progressively',
                    'Focus on ab contraction',
                    'Don\'t use hip flexors'
                ]
            ],
            [
                'name' => 'Oblique Crunches',
                'category' => 'core',
                'description' => 'Targets the oblique muscles on the sides of the abdomen.',
                'steps' => [
                    'Lie on side with knees bent',
                    'Place hand behind head',
                    'Crunch up bringing elbow toward hip',
                    'Squeeze oblique at top',
                    'Lower back down',
                    'Complete all reps then switch sides'
                ],
                'equipment' => ['Exercise Mat'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/oblique-crunches.gif',
                'muscle_groups' => [
                    'primary' => ['Obliques'],
                    'secondary' => ['Rectus Abdominis']
                ],
                'tips' => [
                    'Focus on side contraction',
                    'Don\'t pull on neck',
                    'Great for oblique definition'
                ]
            ],
            [
                'name' => 'Side Plank',
                'category' => 'core',
                'description' => 'Isometric exercise for obliques and core stability.',
                'steps' => [
                    'Lie on side with elbow under shoulder',
                    'Stack feet on top of each other',
                    'Lift hips off ground',
                    'Keep body in straight line',
                    'Hold for time',
                    'Switch sides'
                ],
                'equipment' => ['Exercise Mat'],
                'difficulty_level' => 'intermediate',
                'gif_path' => '/lottie/exercises/side-plank.gif',
                'muscle_groups' => [
                    'primary' => ['Obliques', 'Transverse Abdominis'],
                    'secondary' => ['Shoulders', 'Hip Abductors']
                ],
                'tips' => [
                    'Don\'t let hips sag',
                    'Keep body in straight line',
                    'Great for core stability'
                ]
            ],

            // CARDIO EXERCISES
            [
                'name' => 'Jumping Jacks',
                'category' => 'cardio',
                'description' => 'Full body cardio exercise that elevates heart rate quickly.',
                'steps' => [
                    'Start with feet together, arms at sides',
                    'Jump feet apart while raising arms overhead',
                    'Jump feet back together while lowering arms',
                    'Repeat at steady pace',
                    'Maintain rhythm',
                    'Land softly on balls of feet'
                ],
                'equipment' => ['None'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/jumping-jacks.gif',
                'muscle_groups' => [
                    'primary' => ['Cardiovascular System'],
                    'secondary' => ['Calves', 'Shoulders', 'Core']
                ],
                'tips' => [
                    'Great warm-up exercise',
                    'Keep steady rhythm',
                    'Land softly to protect joints'
                ]
            ],
            [
                'name' => 'Cycling',
                'category' => 'cardio',
                'description' => 'Low-impact cardio exercise excellent for leg endurance and cardiovascular health.',
                'steps' => [
                    'Adjust seat height properly',
                    'Start pedaling at comfortable pace',
                    'Gradually increase intensity',
                    'Maintain steady cadence',
                    'Keep upper body relaxed',
                    'Cool down gradually'
                ],
                'equipment' => ['Stationary Bike or Bicycle'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/cycling.gif',
                'muscle_groups' => [
                    'primary' => ['Cardiovascular System', 'Quadriceps'],
                    'secondary' => ['Hamstrings', 'Calves', 'Glutes']
                ],
                'tips' => [
                    'Low impact on joints',
                    'Adjust resistance for intensity',
                    'Great for endurance'
                ]
            ],
            [
                'name' => 'Walking',
                'category' => 'cardio',
                'description' => 'The most accessible form of cardio, suitable for all fitness levels.',
                'steps' => [
                    'Maintain good posture',
                    'Swing arms naturally',
                    'Land heel first, roll to toe',
                    'Keep steady pace',
                    'Breathe rhythmically',
                    'Gradually increase duration or intensity'
                ],
                'equipment' => ['Comfortable Shoes'],
                'difficulty_level' => 'beginner',
                'gif_path' => '/lottie/exercises/walking.gif',
                'muscle_groups' => [
                    'primary' => ['Cardiovascular System'],
                    'secondary' => ['Legs', 'Core']
                ],
                'tips' => [
                    'Perfect for beginners',
                    'Can be done anywhere',
                    'Increase incline or speed for more challenge'
                ]
            ]
        ];

        foreach ($exercises as $exercise) {
            Exercise::updateOrCreate(
                ['slug' => Str::slug($exercise['name'])],
                [
                    'name' => $exercise['name'],
                    'category' => $exercise['category'],
                    'description' => $exercise['description'],
                    'steps' => $exercise['steps'],
                    'equipment' => $exercise['equipment'],
                    'difficulty_level' => $exercise['difficulty_level'],
                    'gif_path' => $exercise['gif_path'],
                    'muscle_groups' => $exercise['muscle_groups'],
                    'tips' => $exercise['tips'],
                ]
            );
        }

        $this->command->info('Added ' . count($exercises) . ' additional exercises!');
    }
}
