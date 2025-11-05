<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $stats = [
            'total_members' => User::members()->count(),
            'total_trainers' => User::trainers()->count(),
            'active_bookings' => Booking::where('status', 'confirmed')->count(),
            'pending_payments' => Payment::pending()->count(),
            'total_revenue' => Payment::paid()->sum('amount'),
            'today_attendance' => Attendance::today()->count(),
        ];

        $recentMembers = User::members()
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = Payment::with('member')
            ->latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Payment::paid()
            ->whereYear('payment_date', now()->year)
            ->whereMonth('payment_date', now()->month)
            ->sum('amount');

        return view('admin.dashboard', compact('stats', 'recentMembers', 'recentPayments', 'monthlyRevenue'));
    }

    public function monthlyRevenue()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $revenue = Payment::paid()
            ->select(
                DB::raw('YEAR(payment_date) as year'),
                DB::raw('MONTH(payment_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return response()->json($revenue);
    }
}