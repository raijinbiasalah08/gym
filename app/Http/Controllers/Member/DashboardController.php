<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Attendance;
use App\Models\Progress;
use App\Models\Payment;
// DB facade already imported where needed; avoid duplicate import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'membership_days_remaining' => $member->membership_days_remaining,
            'total_spent' => $member->total_spent,
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

        // Upcoming sessions
        $upcomingSessions = Booking::with('trainer')
            ->where('member_id', $member->id)
            ->upcoming()
            ->take(3)
            ->get();

        // Recent attendance
        $recentAttendance = Attendance::where('member_id', $member->id)
            ->latest()
            ->take(5)
            ->get();

        // Recent payments
        $recentPayments = Payment::where('member_id', $member->id)
            ->latest()
            ->take(5)
            ->get();

        return view('member.dashboard', compact(
            'stats', 
            'todaySession', 
            'recentProgress',
            'upcomingSessions',
            'recentAttendance',
            'recentPayments'
        ));
    }

    public function attendanceIndex()
    {
        $member = Auth::user();

        $attendance = Attendance::where('member_id', $member->id)
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('member.attendance.index', compact('attendance'));
    }

    public function progressChart()
    {
        $member = Auth::user();

        $progress = Progress::where('member_id', $member->id)
            ->orderBy('record_date')
            ->get(['record_date', 'weight', 'bmi', 'body_fat_percentage', 'muscle_mass']);

        return response()->json($progress);
    }

    public function attendanceChart()
    {
        $member = Auth::user();

        $attendance = Attendance::where('member_id', $member->id)
            ->selectRaw('DATE(date) as date, COUNT(*) as visits, SUM(workout_duration) as total_duration')
            ->when(request('start_date'), function($q){
                $q->whereDate('date', '>=', request('start_date'));
            })
            ->when(request('end_date'), function($q){
                $q->whereDate('date', '<=', request('end_date'));
            })
            ->when(!request('start_date') && !request('end_date'), function($q){
                return $q->where('date', '>=', now()->subDays(30));
            })
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date')
            ->get();

        return response()->json($attendance);
    }

    public function attendanceExport(Request $request)
    {
        $member = Auth::user();

        $query = Attendance::where('member_id', $member->id);

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->input('end_date'));
        }

        $rows = $query->orderBy('date', 'desc')->get();

        $filename = 'attendance_' . $member->id . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Date','Check In','Check Out','Duration (min)','Calories','Notes']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->date ? $r->date->format('Y-m-d') : '',
                    optional($r->check_in)->format('H:i') ?? '',
                    optional($r->check_out)->format('H:i') ?? '',
                    $r->workout_duration ?? '',
                    $r->calories_burned ?? '',
                    $r->notes ?? '',
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function membershipPage()
    {
        // Fetch fresh data from database to avoid cached values
        $member = Auth::user()->fresh();

        $payments = Payment::where('member_id', $member->id)
            ->latest()
            ->take(12)
            ->get();

        return view('member.membership', compact('member', 'payments'));
    }

    public function updateMembership(Request $request)
    {
        $request->validate([
            'membership_type' => 'required|in:basic,premium,vip',
        ]);

        $member = Auth::user();
        
        // Update membership type
        $member->membership_type = $request->membership_type;
        
        // Extend membership by 30 days from now or from current expiry (whichever is later)
        if ($member->membership_expiry && $member->membership_expiry->isFuture()) {
            $member->membership_expiry = $member->membership_expiry->addDays(30);
        } else {
            $member->membership_expiry = now()->addDays(30);
        }
        
        $member->save();
        
        // Refresh the user instance to get updated data
        $member->fresh();

        return redirect()->route('member.membership')
            ->with('success', 'Membership plan updated successfully! Your new plan is now active.');
    }
}