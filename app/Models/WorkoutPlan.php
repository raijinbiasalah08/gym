<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'member_id',
        'title',
        'description',
        'goal',
        'duration_weeks',
        'difficulty_level',
        'exercises',
        'schedule',
        'diet_plan',
        'status',
    ];

    protected $casts = [
        'exercises' => 'array',
        'schedule' => 'array',
        'diet_plan' => 'array',
    ];

    // Relationships
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}