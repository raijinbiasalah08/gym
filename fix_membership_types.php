<?php

/**
 * Fix Membership Types Script
 * 
 * This script updates user membership types based on their payment records.
 * Run this from the Laravel root directory: php fix_membership_types.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentTransaction;

echo "🔧 Starting Membership Type Fix...\n\n";

// Get all members
$members = User::where('role', 'member')->get();

$fixed = 0;
$skipped = 0;

foreach ($members as $member) {
    echo "Checking {$member->name} (ID: {$member->id})...\n";
    echo "  Current membership: " . strtoupper($member->membership_type) . "\n";
    
    // Check payment transactions first (newer system)
    $latestTransaction = PaymentTransaction::where('user_id', $member->id)
        ->where('status', 'completed')
        ->whereNotNull('membership_type')
        ->latest()
        ->first();
    
    // Check old payments if no transaction found
    $latestPayment = Payment::where('member_id', $member->id)
        ->where('status', 'paid')
        ->whereNotNull('membership_type')
        ->latest()
        ->first();
    
    // Determine the correct membership type
    $correctType = null;
    $source = null;
    
    if ($latestTransaction) {
        $correctType = $latestTransaction->membership_type;
        $source = "PaymentTransaction (₱" . number_format($latestTransaction->amount, 2) . ")";
    } elseif ($latestPayment) {
        $correctType = $latestPayment->membership_type;
        $source = "Payment (₱" . number_format($latestPayment->amount, 2) . ")";
    }
    
    if ($correctType && $correctType !== $member->membership_type) {
        echo "  ✅ Found payment record: {$source}\n";
        echo "  🔄 Updating from " . strtoupper($member->membership_type) . " to " . strtoupper($correctType) . "\n";
        
        $member->update(['membership_type' => $correctType]);
        $fixed++;
        echo "  ✓ Updated successfully!\n\n";
    } else {
        if ($correctType === $member->membership_type) {
            echo "  ✓ Already correct\n\n";
        } else {
            echo "  ⚠️  No payment records found - keeping current type\n\n";
        }
        $skipped++;
    }
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "📊 Summary:\n";
echo "  Total members checked: " . $members->count() . "\n";
echo "  Fixed: {$fixed}\n";
echo "  Skipped: {$skipped}\n";
echo "\n✅ Done!\n";
