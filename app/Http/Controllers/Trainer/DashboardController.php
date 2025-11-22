<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\WorkoutPlan;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $trainer = Auth::user();

        $stats = [
            'total_clients' => User::members()->count(),
            'today_sessions' => Booking::where('trainer_id', $trainer->id)
                ->whereDate('booking_date', today())
                ->count(),
            'active_plans' => WorkoutPlan::where('trainer_id', $trainer->id)
                ->active()
                ->count(),
            'total_sessions' => Booking::where('trainer_id', $trainer->id)
                ->count(),
            'upcoming_sessions' => Booking::where('trainer_id', $trainer->id)
                ->upcoming()
                ->count(),
            'completed_sessions' => Booking::where('trainer_id', $trainer->id)
                ->completed()
                ->count(),
            'pending_bookings' => Booking::where('trainer_id', $trainer->id)
                ->pending()
                ->count(),
            'monthly_earnings' => Booking::where('trainer_id', $trainer->id)
                ->where('status', 'completed')
                ->whereMonth('booking_date', now()->month)
                ->sum('price'),
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

        // Upcoming sessions for the week
        $weekSessions = Booking::with('member')
            ->where('trainer_id', $trainer->id)
            ->whereBetween('booking_date', [now(), now()->addDays(7)])
            ->where('status', 'confirmed')
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get();

        // Recent attendance recorded
        $recentAttendance = Attendance::with('member')
            ->latest()
            ->take(5)
            ->get();

        // Active workout plans
        $activePlans = WorkoutPlan::with('member')
            ->where('trainer_id', $trainer->id)
            ->active()
            ->latest()
            ->take(5)
            ->get();

        return view('trainer.dashboard', compact(
            'stats', 
            'todaySessions', 
            'recentClients',
            'weekSessions',
            'recentAttendance',
            'activePlans'
        ));
    }

    public function earningsChart(Request $request)
    {
        $trainer = Auth::user();

        $period = $request->get('period', 'month');

        $query = Booking::where('trainer_id', $trainer->id)
            ->where('status', 'completed');

        if ($period === 'week') {
            $earnings = $query->whereBetween('booking_date', [now()->startOfWeek(), now()->endOfWeek()])
                ->selectRaw('DAYNAME(booking_date) as day, SUM(price) as total')
                ->groupBy(DB::raw('DAYNAME(booking_date)'))
                ->get();
        } else {
            $earnings = $query->whereYear('booking_date', now()->year)
                ->whereMonth('booking_date', now()->month)
                ->selectRaw('DAY(booking_date) as day, SUM(price) as total')
                ->groupBy(DB::raw('DAY(booking_date)'))
                ->get();
        }

        return response()->json($earnings);
    }
}