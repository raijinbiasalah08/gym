<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('member');

        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('date', [$request->date_from, $request->date_to]);
        }

        $attendance = $query->latest()->paginate(15);

        return response()->json($attendance);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'check_in' => 'required|date_format:Y-m-d H:i:s',
            'check_out' => 'nullable|date_format:Y-m-d H:i:s|after:check_in',
            'date' => 'required|date',
            'workout_duration' => 'nullable|integer|min:0',
            'calories_burned' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        // Check if attendance already exists for this member and date
        $existingAttendance = Attendance::where('member_id', $validated['member_id'])
            ->whereDate('date', $validated['date'])
            ->first();

        if ($existingAttendance) {
            return response()->json([
                'message' => 'Attendance already recorded for this member today'
            ], 422);
        }

        $attendance = Attendance::create($validated);

        return response()->json([
            'message' => 'Attendance recorded successfully',
            'attendance' => $attendance
        ], 201);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'check_out' => 'nullable|date_format:Y-m-d H:i:s|after:check_in',
            'workout_duration' => 'nullable|integer|min:0',
            'calories_burned' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return response()->json([
            'message' => 'Attendance updated successfully',
            'attendance' => $attendance
        ]);
    }

    public function todayAttendance()
    {
        $attendance = Attendance::with('member')
            ->whereDate('date', today())
            ->latest()
            ->get();

        return response()->json($attendance);
    }
}