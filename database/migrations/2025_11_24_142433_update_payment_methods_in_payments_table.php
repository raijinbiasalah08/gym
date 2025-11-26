<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, update existing 'card' values to 'credit_card'
        DB::table('payments')
            ->where('payment_method', 'card')
            ->update(['payment_method' => 'credit_card']);

        // For MySQL, we need to alter the enum column
        DB::statement("ALTER TABLE payments MODIFY COLUMN payment_method ENUM('cash', 'credit_card', 'debit_card', 'bank_transfer', 'online', 'face_to_face', 'mobile_money', 'check', 'e_wallet') NOT NULL");
    }

    public function down(): void
    {
        // Revert credit_card back to card
        DB::table('payments')
            ->where('payment_method', 'credit_card')
            ->update(['payment_method' => 'card']);

        // Revert to original enum values
        DB::statement("ALTER TABLE payments MODIFY COLUMN payment_method ENUM('cash', 'card', 'bank_transfer', 'online') NOT NULL");
    }
};
