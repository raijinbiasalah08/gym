<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Exercise;

$exercise = Exercise::where('slug', 'cable-crossover')->first();

if ($exercise) {
    echo "Exercise found: " . $exercise->name . "\n";
    echo "Steps type: " . gettype($exercise->steps) . "\n";
    echo "Steps is array: " . (is_array($exercise->steps) ? 'yes' : 'no') . "\n";
    echo "Muscle groups type: " . gettype($exercise->muscle_groups) . "\n";
    echo "Muscle groups is array: " . (is_array($exercise->muscle_groups) ? 'yes' : 'no') . "\n";
    
    if (is_array($exercise->steps)) {
        echo "Steps count: " . count($exercise->steps) . "\n";
    } else {
        echo "Steps value: " . $exercise->steps . "\n";
    }
    
    if (is_array($exercise->muscle_groups)) {
        echo "Muscle groups: " . json_encode($exercise->muscle_groups) . "\n";
    } else {
        echo "Muscle groups value: " . $exercise->muscle_groups . "\n";
    }
} else {
    echo "Exercise not found\n";
}
