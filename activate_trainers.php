<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "=== INACTIVE TRAINERS ===\n\n";

$inactiveTrainers = User::where('role', 'trainer')
    ->where('is_active', false)
    ->get();

if ($inactiveTrainers->count() > 0) {
    foreach ($inactiveTrainers as $trainer) {
        echo "ID: {$trainer->id}\n";
        echo "Name: {$trainer->name}\n";
        echo "Email: {$trainer->email}\n";
        echo "Specialization: {$trainer->specialization}\n";
        echo "---\n";
    }
    
    echo "\nActivating all inactive trainers...\n";
    User::where('role', 'trainer')
        ->where('is_active', false)
        ->update(['is_active' => true]);
    
    echo "All trainers have been activated!\n";
} else {
    echo "No inactive trainers found.\n";
}

echo "\n=== ACTIVE TRAINERS ===\n\n";
$activeTrainers = User::where('role', 'trainer')
    ->where('is_active', true)
    ->get();

foreach ($activeTrainers as $trainer) {
    echo "✓ {$trainer->name} ({$trainer->email})\n";
}

echo "\nTotal active trainers: {$activeTrainers->count()}\n";
