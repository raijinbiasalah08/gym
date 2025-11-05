<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Attendance;
use App\Models\Progress;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $member = Auth::user();

        $stats = [
            'upcoming_sessions' => Booking::where('member_id', $member->id)
                ->upcoming()
                ->count(),
            'completed_sessions' => Booking::where('member_id', $member->id)
                ->completed()
                ->count(),
            'total_workouts' => Attendance::where('member_id', $member->id)->count(),
            'pending_payments' => Payment::where('member_id', $member->id)
                ->pending()
                ->count(),
        ];

        $todaySession = Booking::with('trainer')
            ->where('member_id', $member->id)
            ->whereDate('booking_date', today())
            ->where('status', 'confirmed')
            ->first();

        $recentProgress = Progress::where('member_id', $member->id)
            ->latest()
            ->take(3)
            ->get();

        return view('member.dashboard', compact('stats', 'todaySession', 'recentProgress'));
    }
}