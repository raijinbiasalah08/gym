<?php

/**
 * Test script to verify trainer registration with document uploads
 * This simulates the registration process to check if valid_id_path is saved correctly
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== Trainer Registration Test ===\n\n";

// Check if valid_id_path is in fillable array
$user = new User();
$fillable = $user->getFillable();

echo "1. Checking if 'valid_id_path' is in fillable array...\n";
if (in_array('valid_id_path', $fillable)) {
    echo "   ✓ SUCCESS: 'valid_id_path' is in fillable array\n\n";
} else {
    echo "   ✗ FAILED: 'valid_id_path' is NOT in fillable array\n\n";
    exit(1);
}

// Test creating a trainer with valid_id_path
echo "2. Testing trainer creation with valid_id_path...\n";

$testEmail = 'test.trainer.' . time() . '@gym.com';

try {
    $trainer = User::create([
        'name' => 'Test Trainer',
        'email' => $testEmail,
        'password' => Hash::make('password123'),
        'role' => 'trainer',
        'phone' => '09123456789',
        'sex' => 'male',
        'date_of_birth' => '1990-01-01',
        'specialization' => 'Strength Training',
        'experience_years' => 5,
        'hourly_rate' => 50.00,
        'is_active' => false,
        'approval_status' => 'pending',
        'valid_id_path' => 'trainer_documents/test/valid_id.jpg',
        'certifications' => json_encode(['trainer_documents/test/cert1.pdf', 'trainer_documents/test/cert2.pdf']),
    ]);

    echo "   ✓ SUCCESS: Trainer created with ID: {$trainer->id}\n";
    echo "   - Name: {$trainer->name}\n";
    echo "   - Email: {$trainer->email}\n";
    echo "   - Valid ID Path: {$trainer->valid_id_path}\n";
    echo "   - Certifications: {$trainer->certifications}\n";
    echo "   - Approval Status: {$trainer->approval_status}\n\n";

    // Verify the data was saved correctly
    $savedTrainer = User::find($trainer->id);
    
    echo "3. Verifying saved data...\n";
    if ($savedTrainer->valid_id_path === 'trainer_documents/test/valid_id.jpg') {
        echo "   ✓ SUCCESS: valid_id_path saved correctly\n";
    } else {
        echo "   ✗ FAILED: valid_id_path not saved (value: " . ($savedTrainer->valid_id_path ?? 'NULL') . ")\n";
    }

    if ($savedTrainer->certifications) {
        $certs = json_decode($savedTrainer->certifications, true);
        if (is_array($certs) && count($certs) === 2) {
            echo "   ✓ SUCCESS: certifications saved correctly (2 files)\n";
        } else {
            echo "   ✗ FAILED: certifications not saved correctly\n";
        }
    } else {
        echo "   ✗ FAILED: certifications is NULL\n";
    }

    // Clean up
    echo "\n4. Cleaning up test data...\n";
    $savedTrainer->delete();
    echo "   ✓ Test trainer deleted\n";

    echo "\n=== ALL TESTS PASSED ===\n";

} catch (\Exception $e) {
    echo "   ✗ FAILED: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
