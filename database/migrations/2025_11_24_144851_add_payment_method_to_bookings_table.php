<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_method', [
                'cash', 
                'credit_card', 
                'debit_card', 
                'bank_transfer', 
                'online', 
                'face_to_face', 
                'mobile_money', 
                'check', 
                'e_wallet'
            ])->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};
