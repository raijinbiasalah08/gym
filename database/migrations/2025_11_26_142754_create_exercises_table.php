<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // chest, shoulders, back, arms, legs, core, glutes, cardio
            $table->text('description');
            $table->json('steps'); // Array of step-by-step instructions
            $table->json('equipment')->nullable(); // Array of required equipment
            $table->string('difficulty_level')->default('intermediate'); // beginner, intermediate, advanced
            $table->string('gif_path')->nullable();
            $table->json('muscle_groups')->nullable(); // Primary and secondary muscles
            $table->json('tips')->nullable(); // Safety tips and form cues
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
