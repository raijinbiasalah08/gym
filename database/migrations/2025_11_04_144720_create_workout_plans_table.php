<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('goal');
            $table->integer('duration_weeks');
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced']);
            $table->json('exercises'); // Array of exercises with details
            $table->json('schedule'); // Weekly schedule
            $table->json('diet_plan')->nullable(); // Optional diet plan
            $table->enum('status', ['active', 'completed', 'paused'])->default('active');
            $table->timestamps();

            $table->index(['trainer_id', 'status']);
            $table->index(['member_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};