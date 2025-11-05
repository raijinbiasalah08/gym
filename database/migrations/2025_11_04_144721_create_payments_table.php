<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->date('due_date');
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'online']);
            $table->string('transaction_id')->unique()->nullable();
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->text('description');
            $table->enum('membership_type', ['basic', 'premium', 'vip']);
            $table->date('period_start');
            $table->date('period_end');
            $table->timestamps();

            $table->index(['member_id', 'status']);
            $table->index(['payment_date', 'status']);
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};