<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Specify the table name since it's not the plural of the model name
    protected $table = 'attendance';

    protected $fillable = [
        'member_id',
        'check_in',
        'check_out',
        'date',
        'workout_duration',
        'calories_burned',
        'notes',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'date' => 'date',
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->where('date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    // If you remove the unique constraint, you might want this method to check for existing records
    public static function hasCheckedInToday($memberId)
    {
        return static::where('member_id', $memberId)
            ->whereDate('date', today())
            ->exists();
    }
}