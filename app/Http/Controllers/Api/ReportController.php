<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function financialReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $revenue = Payment::paid()
            ->whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->sum('amount');

        $payments = Payment::with('member')
            ->whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->get();

        $paymentMethods = Payment::whereBetween('payment_date', [$request->start_date, $request->end_date])
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->groupBy('payment_method')
            ->get();

        return response()->json([
            'period' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ],
            'total_revenue' => $revenue,
            'total_transactions' => $payments->count(),
            'payments' => $payments,
            'payment_methods' => $paymentMethods,
        ]);
    }

    public function attendanceReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $attendance = Attendance::with('member')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->select(
                'member_id',
                DB::raw('COUNT(*) as total_visits'),
                DB::raw('AVG(workout_duration) as avg_duration'),
                DB::raw('SUM(calories_burned) as total_calories')
            )
            ->groupBy('member_id')
            ->get();

        $dailyAttendance = Attendance::whereBetween('date', [$request->start_date, $request->end_date])
            ->select(
                DB::raw('DATE(date) as date'),
                DB::raw('COUNT(*) as visits')
            )
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date')
            ->get();

        return response()->json([
            'period' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ],
            'total_visits' => $attendance->sum('total_visits'),
            'unique_members' => $attendance->count(),
            'member_attendance' => $attendance,
            'daily_attendance' => $dailyAttendance,
        ]);
    }

    public function membershipReport()
    {
        $membershipStats = User::members()
            ->select(
                'membership_type',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(CASE WHEN membership_expiry > NOW() THEN 1 ELSE 0 END) as active')
            )
            ->groupBy('membership_type')
            ->get();

        $newMembers = User::members()
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $expiringThisMonth = User::members()
            ->whereYear('membership_expiry', now()->year)
            ->whereMonth('membership_expiry', now()->month)
            ->count();

        return response()->json([
            'membership_stats' => $membershipStats,
            'new_members_this_month' => $newMembers,
            'expiring_this_month' => $expiringThisMonth,
            'total_members' => User::members()->count(),
            'active_members' => User::members()->where('membership_expiry', '>', now())->count(),
        ]);
    }

    public function trainerPerformance(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $performance = User::trainers()
            ->withCount(['trainerBookings as total_sessions' => function ($query) use ($request) {
                $query->whereBetween('booking_date', [$request->start_date, $request->end_date])
                      ->where('status', 'completed');
            }])
            ->withCount(['workoutPlans as active_plans' => function ($query) {
                $query->where('status', 'active');
            }])
            ->withSum(['trainerBookings as total_earnings' => function ($query) use ($request) {
                $query->whereBetween('booking_date', [$request->start_date, $request->end_date])
                      ->where('status', 'completed');
            }], 'price')
            ->get();

        return response()->json([
            'period' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ],
            'trainer_performance' => $performance,
        ]);
    }
}