<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'trainer', 'member'])->default('member');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            
            // Member specific fields
            $table->enum('membership_type', ['basic', 'premium', 'vip'])->default('basic');
            $table->date('membership_expiry')->nullable();
            $table->decimal('height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('weight', 5, 2)->nullable()->comment('in kg');
            $table->string('emergency_contact')->nullable();
            $table->text('health_notes')->nullable();
            
            // Trainer specific fields
            $table->string('specialization')->nullable();
            $table->text('certifications')->nullable();
            $table->integer('experience_years')->default(0);
            $table->decimal('hourly_rate', 8, 2)->default(0);
            
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};