<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::where('email', 'admin@gym.com')->first();

if ($admin) {
    $admin->password = Hash::make('password');
    $admin->is_active = true;
    $admin->save();
    echo "Admin password reset successfully!\n";
    echo "Email: admin@gym.com\n";
    echo "Password: password\n";
} else {
    echo "Admin user not found!\n";
}
