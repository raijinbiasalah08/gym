<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Notification;

echo "Creating test notification...\n\n";

$admin = User::where('email', 'admin@gym.com')->first();

if (!$admin) {
    echo "❌ Admin user not found!\n";
    exit(1);
}

Notification::create([
    'user_id' => $admin->id,
    'type' => 'user_registration',
    'title' => 'New Member Registration',
    'message' => 'Test User has registered as a member and is pending approval.',
    'icon' => 'fas fa-user-plus',
    'color' => 'info',
    'link' => '/admin/user-approvals',
    'is_read' => false,
]);

echo "✓ Test notification created successfully!\n";
echo "Admin: " . $admin->name . " (" . $admin->email . ")\n";
echo "\nCheck your notifications at: http://127.0.0.1:8000/notifications\n";
