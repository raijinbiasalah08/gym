<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'record_date',
        'weight',
        'height',
        'bmi',
        'body_fat_percentage',
        'muscle_mass',
        'chest_measurement',
        'waist_measurement',
        'hip_measurement',
        'arm_measurement',
        'thigh_measurement',
        'notes',
        'photos',
    ];

    protected $casts = [
        'record_date' => 'date',
        'weight' => 'decimal:1',
        'height' => 'decimal:1',
        'bmi' => 'decimal:1',
        'body_fat_percentage' => 'decimal:1',
        'muscle_mass' => 'decimal:1',
        'chest_measurement' => 'decimal:1',
        'waist_measurement' => 'decimal:1',
        'hip_measurement' => 'decimal:1',
        'arm_measurement' => 'decimal:1',
        'thigh_measurement' => 'decimal:1',
        'photos' => 'array',
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}