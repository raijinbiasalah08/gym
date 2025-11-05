<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $trainer = Auth::user();

        $stats = [
            'total_clients' => User::members()->count(),
            'upcoming_sessions' => Booking::where('trainer_id', $trainer->id)
                ->upcoming()
                ->count(),
            'completed_sessions' => Booking::where('trainer_id', $trainer->id)
                ->completed()
                ->count(),
            'active_plans' => WorkoutPlan::where('trainer_id', $trainer->id)
                ->active()
                ->count(),
        ];

        $todaySessions = Booking::with('member')
            ->where('trainer_id', $trainer->id)
            ->whereDate('booking_date', today())
            ->where('status', 'confirmed')
            ->orderBy('start_time')
            ->get();

        $recentClients = User::members()
            ->latest()
            ->take(5)
            ->get();

        return view('trainer.dashboard', compact('stats', 'todaySessions', 'recentClients'));
    }
}