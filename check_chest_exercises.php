<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Exercise;

// Check a few exercises to see their data
$exercises = Exercise::where('category', 'chest')->take(5)->get();

echo "Checking chest exercises:\n\n";

foreach ($exercises as $exercise) {
    echo "=== " . $exercise->name . " ===\n";
    echo "Slug: " . $exercise->slug . "\n";
    echo "Has steps: " . (is_array($exercise->steps) && count($exercise->steps) > 0 ? 'YES (' . count($exercise->steps) . ')' : 'NO') . "\n";
    echo "Has muscle_groups: " . (is_array($exercise->muscle_groups) && count($exercise->muscle_groups) > 0 ? 'YES' : 'NO') . "\n";
    
    if (is_array($exercise->muscle_groups)) {
        echo "  - Has primary: " . (isset($exercise->muscle_groups['primary']) ? 'YES' : 'NO') . "\n";
        echo "  - Has secondary: " . (isset($exercise->muscle_groups['secondary']) ? 'YES' : 'NO') . "\n";
    }
    
    echo "\n";
}
