<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== Admin User Verification ===\n\n";

$admin = User::where('email', 'admin@gym.com')->first();

if (!$admin) {
    echo "❌ Admin user NOT found!\n";
    exit(1);
}

echo "✓ Admin user found!\n\n";
echo "ID: " . $admin->id . "\n";
echo "Name: " . $admin->name . "\n";
echo "Email: " . $admin->email . "\n";
echo "Role: " . $admin->role . "\n";
echo "Active: " . ($admin->is_active ? 'Yes' : 'No') . "\n";
echo "Approval Status: " . ($admin->approval_status ?? 'NULL') . "\n";

echo "\n--- Password Test ---\n";
if (Hash::check('password', $admin->password)) {
    echo "✓ Password 'password' is correct!\n";
} else {
    echo "❌ Password 'password' does NOT match!\n";
}

echo "\n--- Login Requirements Check ---\n";
$canLogin = true;

if ($admin->approval_status !== 'approved') {
    echo "❌ Approval status is '{$admin->approval_status}' (must be 'approved')\n";
    $canLogin = false;
} else {
    echo "✓ Approval status is 'approved'\n";
}

if (!$admin->is_active) {
    echo "❌ Account is not active\n";
    $canLogin = false;
} else {
    echo "✓ Account is active\n";
}

echo "\n";
if ($canLogin) {
    echo "✓✓✓ Admin account is ready to login! ✓✓✓\n";
    echo "\nLogin Credentials:\n";
    echo "Email: admin@gym.com\n";
    echo "Password: password\n";
} else {
    echo "❌ Admin account has issues that prevent login\n";
}
