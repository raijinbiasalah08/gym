<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'date_of_birth',
        'membership_type',
        'membership_expiry',
        'height',
        'weight',
        'emergency_contact',
        'health_notes',
        'specialization',
        'certifications',
        'experience_years',
        'hourly_rate',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'membership_expiry' => 'date',
        'is_active' => 'boolean',
        'hourly_rate' => 'decimal:2',
    ];

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'member_id');
    }

    public function trainerBookings()
    {
        return $this->hasMany(Booking::class, 'trainer_id');
    }

    public function workoutPlans()
    {
        return $this->hasMany(WorkoutPlan::class, 'trainer_id');
    }

    public function assignedWorkoutPlans()
    {
        return $this->hasMany(WorkoutPlan::class, 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    // Scopes
    public function scopeMembers($query)
    {
        return $query->where('role', 'member');
    }

    public function scopeTrainers($query)
    {
        return $query->where('role', 'trainer');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTrainer()
    {
        return $this->role === 'trainer';
    }

    public function isMember()
    {
        return $this->role === 'member';
    }

    public function getMembershipStatusAttribute()
    {
        if (!$this->membership_expiry) {
            return 'inactive';
        }

        return $this->membership_expiry->isFuture() ? 'active' : 'expired';
    }
}