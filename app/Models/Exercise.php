<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'steps',
        'equipment',
        'difficulty_level',
        'gif_path',
        'muscle_groups',
        'tips',
    ];

    protected $casts = [
        'steps' => 'array',
        'equipment' => 'array',
        'muscle_groups' => 'array',
        'tips' => 'array',
    ];

    /**
     * Scope a query to only include exercises of a given category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get the difficulty level badge color.
     */
    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty_level) {
            'beginner' => 'green',
            'intermediate' => 'yellow',
            'advanced' => 'red',
            default => 'gray',
        };
    }
}
