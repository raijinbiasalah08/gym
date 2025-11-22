<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.reports.index');
    }

    public function financialReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.financial');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Total revenue
        $totalRevenue = Payment::paid()
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->sum('amount');

        // Payment methods breakdown
        $paymentMethods = Payment::whereBetween('payment_date', [$startDate, $endDate])
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->groupBy('payment_method')
            ->get();

        // Monthly revenue trend
        $monthlyRevenue = Payment::paid()
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->select(
                DB::raw('YEAR(payment_date) as year'),
                DB::raw('MONTH(payment_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Top members by spending
        $topMembers = Payment::paid()
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->with('member')
            ->select('member_id', DB::raw('SUM(amount) as total_spent'))
            ->groupBy('member_id')
            ->orderBy('total_spent', 'desc')
            ->take(10)
            ->get();

        return view('admin.reports.financial', compact(
            'totalRevenue', 
            'paymentMethods', 
            'monthlyRevenue',
            'topMembers',
            'startDate',
            'endDate'
        ));
    }

    public function attendanceReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.attendance');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Member attendance summary
        $attendance = Attendance::with('member')
            ->whereBetween('date', [$startDate, $endDate])
            ->select(
                'member_id',
                DB::raw('COUNT(*) as total_visits'),
                DB::raw('AVG(workout_duration) as avg_duration'),
                DB::raw('SUM(calories_burned) as total_calories')
            )
            ->groupBy('member_id')
            ->orderBy('total_visits', 'desc')
            ->get();

        // Daily attendance trend
        $dailyAttendance = Attendance::whereBetween('date', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(date) as date'),
                DB::raw('COUNT(*) as visits')
            )
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date')
            ->get();

        // Peak hours analysis
        $peakHours = Attendance::whereBetween('date', [$startDate, $endDate])
            ->select(
                DB::raw('HOUR(check_in) as hour'),
                DB::raw('COUNT(*) as visits')
            )
            ->groupBy(DB::raw('HOUR(check_in)'))
            ->orderBy('visits', 'desc')
            ->get();

        return view('admin.reports.attendance', compact(
            'attendance',
            'dailyAttendance',
            'peakHours',
            'startDate',
            'endDate'
        ));
    }

    public function membershipReport()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        // Membership type statistics
        $membershipStats = User::members()
            ->select(
                'membership_type',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(CASE WHEN membership_expiry > NOW() THEN 1 ELSE 0 END) as active')
            )
            ->groupBy('membership_type')
            ->get();

        // New members this month
        $newMembers = User::members()
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // Expiring memberships
        $expiringThisMonth = User::members()
            ->whereYear('membership_expiry', now()->year)
            ->whereMonth('membership_expiry', now()->month)
            ->count();

        // Membership growth trend
        $membershipGrowth = User::members()
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as new_members')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Active vs inactive members
        $activeMembers = User::members()->active()->count();
        $inactiveMembers = User::members()->where('is_active', false)->count();

        return view('admin.reports.membership', compact(
            'membershipStats',
            'newMembers',
            'expiringThisMonth',
            'membershipGrowth',
            'activeMembers',
            'inactiveMembers'
        ));
    }

    public function trainerPerformanceReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.trainer-performance');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $trainerPerformance = User::trainers()
            ->withCount(['trainerBookings as total_sessions' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('booking_date', [$startDate, $endDate])
                      ->where('status', 'completed');
            }])
            ->withCount(['workoutPlans as active_plans' => function ($query) {
                $query->where('status', 'active');
            }])
            ->withSum(['trainerBookings as total_earnings' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('booking_date', [$startDate, $endDate])
                      ->where('status', 'completed');
            }], 'price')
            ->get();

        return view('admin.reports.trainer-performance', compact(
            'trainerPerformance',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export financial report to CSV
     */
    public function financialReportExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $payments = Payment::paid()
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->with('member')
            ->orderBy('payment_date')
            ->get();

        $fileName = "financial_report_{$startDate}_to_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($payments) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Transaction ID', 'Member', 'Email', 'Amount', 'Payment Method', 'Payment Date', 'Status']);

            foreach ($payments as $p) {
                fputcsv($out, [
                    $p->transaction_id ?? '',
                    optional($p->member)->name ?? '',
                    optional($p->member)->email ?? '',
                    number_format($p->amount, 2),
                    $p->payment_method ?? '',
                    $p->payment_date ?? '',
                    $p->status ?? '',
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export attendance report to CSV
     */
    public function attendanceReportExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $records = Attendance::with('member')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();

        $fileName = "attendance_report_{$startDate}_to_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($records) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Member', 'Email', 'Date', 'Check In', 'Check Out', 'Duration (mins)', 'Calories']);

            foreach ($records as $r) {
                fputcsv($out, [
                    optional($r->member)->name ?? '',
                    optional($r->member)->email ?? '',
                    $r->date ?? '',
                    $r->check_in ?? '',
                    $r->check_out ?? '',
                    $r->workout_duration ?? '',
                    $r->calories_burned ?? '',
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export membership report to CSV
     */
    public function membershipReportExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $members = User::members()->get();

        $fileName = 'membership_report_all.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($members) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Name', 'Email', 'Membership Type', 'Joined At', 'Expiry', 'Active']);

            foreach ($members as $m) {
                fputcsv($out, [
                    $m->name ?? '',
                    $m->email ?? '',
                    $m->membership_type ?? '',
                    optional($m->created_at)->toDateTimeString() ?? '',
                    optional($m->membership_expiry)->toDateString() ?? '',
                    $m->is_active ? 'Yes' : 'No',
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export trainer performance report to CSV
     */
    public function trainerPerformanceExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $trainers = User::trainers()->get();

        $fileName = "trainer_performance_{$startDate}_to_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($trainers, $startDate, $endDate) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Trainer', 'Email', 'Total Sessions', 'Active Plans', 'Total Earnings']);

            foreach ($trainers as $t) {
                $totalSessions = $t->trainerBookings()->whereBetween('booking_date', [$startDate, $endDate])->where('status', 'completed')->count();
                $activePlans = $t->workoutPlans()->where('status', 'active')->count();
                $totalEarnings = $t->trainerBookings()->whereBetween('booking_date', [$startDate, $endDate])->where('status', 'completed')->sum('price');

                fputcsv($out, [
                    $t->name ?? '',
                    $t->email ?? '',
                    $totalSessions,
                    $activePlans,
                    number_format($totalEarnings, 2),
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Class utilization report
     */
    public function classUtilizationReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        if (! $request->has('start_date')) {
            return view('admin.reports.class-utilization');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $utilization = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->select('session_type', DB::raw('COUNT(*) as total_sessions'), DB::raw('AVG(TIMESTAMPDIFF(MINUTE, start_time, end_time)) as avg_duration'))
            ->groupBy('session_type')
            ->orderBy('total_sessions', 'desc')
            ->get();

        return view('admin.reports.class-utilization', compact('utilization', 'startDate', 'endDate'));
    }

    public function classUtilizationExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $rows = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->select('session_type', DB::raw('COUNT(*) as total_sessions'), DB::raw('AVG(TIMESTAMPDIFF(MINUTE, start_time, end_time)) as avg_duration'))
            ->groupBy('session_type')
            ->orderBy('total_sessions', 'desc')
            ->get();

        $fileName = "class_utilization_{$startDate}_to_{$endDate}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Session Type', 'Total Sessions', 'Avg Duration (mins)']);
            foreach ($rows as $r) {
                fputcsv($out, [$r->session_type, $r->total_sessions, round($r->avg_duration, 1)]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Revenue by trainer report
     */
    public function revenueByTrainerReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.revenue-by-trainer');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $byTrainer = Booking::completed()
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->select('trainer_id', DB::raw('COUNT(*) as sessions'), DB::raw('SUM(price) as total_earnings'))
            ->with('trainer')
            ->groupBy('trainer_id')
            ->orderBy('total_earnings', 'desc')
            ->get();

        return view('admin.reports.revenue-by-trainer', compact('byTrainer', 'startDate', 'endDate'));
    }

    public function revenueByTrainerExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $rows = Booking::completed()
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->select('trainer_id', DB::raw('COUNT(*) as sessions'), DB::raw('SUM(price) as total_earnings'))
            ->with('trainer')
            ->groupBy('trainer_id')
            ->orderBy('total_earnings', 'desc')
            ->get();

        $fileName = "revenue_by_trainer_{$startDate}_to_{$endDate}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Trainer', 'Email', 'Sessions', 'Total Earnings']);
            foreach ($rows as $r) {
                fputcsv($out, [optional($r->trainer)->name ?? '', optional($r->trainer)->email ?? '', $r->sessions, number_format($r->total_earnings, 2)]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Member retention report
     */
    public function memberRetentionReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.member-retention');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // members with bookings in period
        $membersInPeriod = Booking::whereBetween('booking_date', [$startDate->toDateString(), $endDate->toDateString()])->pluck('member_id')->unique();

        // members who had bookings before startDate
        $previousMembers = Booking::where('booking_date', '<', $startDate->toDateString())->pluck('member_id')->unique();

        $returning = $membersInPeriod->intersect($previousMembers)->count();
        $total = $membersInPeriod->count();
        $retentionRate = $total > 0 ? round(($returning / $total) * 100, 1) : 0;

        return view('admin.reports.member-retention', compact('returning', 'total', 'retentionRate', 'startDate', 'endDate'));
    }

    public function memberRetentionExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $membersInPeriod = Booking::whereBetween('booking_date', [$startDate->toDateString(), $endDate->toDateString()])->pluck('member_id')->unique();
        $previousMembers = Booking::where('booking_date', '<', $startDate->toDateString())->pluck('member_id')->unique();

        $returningIds = $membersInPeriod->intersect($previousMembers);
        $members = \App\Models\User::whereIn('id', $returningIds)->get();

        $fileName = "member_retention_{$startDate->toDateString()}_to_{$endDate->toDateString()}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($members) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Name', 'Email', 'Joined At']);
            foreach ($members as $m) {
                fputcsv($out, [$m->name, $m->email, optional($m->created_at)->toDateString()]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Upcoming expirations report
     */
    public function upcomingExpirationsReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $days = $request->input('days', 30);
        $start = now();
        $end = now()->addDays($days);

        $expiring = User::members()->whereBetween('membership_expiry', [$start->toDateString(), $end->toDateString()])->get();

        return view('admin.reports.upcoming-expirations', compact('expiring', 'days'));
    }

    public function upcomingExpirationsExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $days = $request->input('days', 30);
        $start = now();
        $end = now()->addDays($days);

        $members = User::members()->whereBetween('membership_expiry', [$start->toDateString(), $end->toDateString()])->get();

        $fileName = "upcoming_expirations_next_{$days}_days.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($members) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Name', 'Email', 'Membership Type', 'Expiry Date', 'Days Remaining']);
            foreach ($members as $m) {
                $days = optional($m->membership_expiry)->diffInDays(now());
                fputcsv($out, [$m->name, $m->email, $m->membership_type, optional($m->membership_expiry)->toDateString(), $days]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Booking analytics report
     */
    public function bookingAnalyticsReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.booking-analytics');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        $daily = Booking::whereBetween('booking_date', [$start, $end])
            ->select(DB::raw('DATE(booking_date) as date'), DB::raw('COUNT(*) as bookings'))
            ->groupBy(DB::raw('DATE(booking_date)'))
            ->orderBy('date')
            ->get();

        $statusCounts = Booking::whereBetween('booking_date', [$start, $end])
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.reports.booking-analytics', compact('daily', 'statusCounts', 'start', 'end'));
    }

    public function bookingAnalyticsExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        $rows = Booking::whereBetween('booking_date', [$start, $end])
            ->orderBy('booking_date')
            ->get();

        $fileName = "booking_analytics_{$start}_to_{$end}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Date', 'Member', 'Trainer', 'Session Type', 'Start', 'End', 'Status', 'Price']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    optional($r->booking_date)->toDateString() ?? $r->booking_date,
                    optional($r->member)->name ?? '',
                    optional($r->trainer)->name ?? '',
                    $r->session_type,
                    $r->start_time,
                    $r->end_time,
                    $r->status,
                    number_format($r->price ?? 0, 2),
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Progress tracking report
     */
    public function progressTrackingReport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (! $request->has('start_date')) {
            return view('admin.reports.progress-tracking');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        $latest = \App\Models\Progress::whereBetween('record_date', [$start, $end])
            ->with('member')
            ->orderBy('record_date', 'desc')
            ->get();

        return view('admin.reports.progress-tracking', compact('latest', 'start', 'end'));
    }

    public function progressTrackingExport(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        $rows = \App\Models\Progress::whereBetween('record_date', [$start, $end])
            ->with('member')
            ->orderBy('record_date', 'desc')
            ->get();

        $fileName = "progress_tracking_{$start}_to_{$end}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Date', 'Member', 'Weight', 'BMI', 'Body Fat %']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    optional($r->record_date)->toDateString(),
                    optional($r->member)->name ?? '',
                    $r->weight,
                    $r->bmi,
                    $r->body_fat_percentage,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}