<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->date('record_date');
            $table->decimal('weight', 5, 2)->comment('in kg');
            $table->decimal('height', 5, 2)->comment('in cm');
            $table->decimal('bmi', 4, 2)->nullable();
            $table->decimal('body_fat_percentage', 4, 2)->nullable();
            $table->decimal('muscle_mass', 5, 2)->nullable();
            $table->decimal('chest_measurement', 5, 2)->nullable();
            $table->decimal('waist_measurement', 5, 2)->nullable();
            $table->decimal('hip_measurement', 5, 2)->nullable();
            $table->decimal('arm_measurement', 5, 2)->nullable();
            $table->decimal('thigh_measurement', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->json('photos')->nullable();
            $table->timestamps();

            $table->index(['member_id', 'record_date']);
            $table->unique(['member_id', 'record_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};