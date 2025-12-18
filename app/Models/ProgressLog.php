<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    protected $fillable = [
        'user_id',
        'weight',
        'body_fat_percentage',
        'bmi',
        'photo_path',
        'log_date',
    ];

    protected $casts = [
        'log_date' => 'date',
        'weight' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
        'bmi' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
