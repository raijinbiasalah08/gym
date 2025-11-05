<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->datetime('check_in');
            $table->datetime('check_out')->nullable();
            $table->date('date');
            $table->integer('workout_duration')->nullable()->comment('in minutes');
            $table->integer('calories_burned')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['member_id', 'date']);
            $table->index(['member_id', 'date']);
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};