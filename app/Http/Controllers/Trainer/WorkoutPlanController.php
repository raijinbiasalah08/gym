<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\WorkoutPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    public function index(Request $request)
    {
        $trainer = Auth::user();

        $query = WorkoutPlan::with('member')
            ->where('trainer_id', $trainer->id);

        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $plans = $query->latest()->paginate(10);

        return response()->json($plans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goal' => 'required|string|max:255',
            'duration_weeks' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'exercises' => 'required|array',
            'exercises.*.name' => 'required|string',
            'exercises.*.sets' => 'required|integer',
            'exercises.*.reps' => 'required|string',
            'exercises.*.rest' => 'nullable|string',
            'schedule' => 'required|array',
            'diet_plan' => 'nullable|array',
        ]);

        $validated['trainer_id'] = Auth::id();
        $validated['status'] = 'active';

        $workoutPlan = WorkoutPlan::create($validated);

        return response()->json([
            'message' => 'Workout plan created successfully',
            'plan' => $workoutPlan
        ], 201);
    }

    public function show(WorkoutPlan $workoutPlan)
    {
        if ($workoutPlan->trainer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $workoutPlan->load('member', 'trainer');

        return response()->json($workoutPlan);
    }

    public function update(Request $request, WorkoutPlan $workoutPlan)
    {
        if ($workoutPlan->trainer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goal' => 'required|string|max:255',
            'duration_weeks' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'exercises' => 'required|array',
            'schedule' => 'required|array',
            'diet_plan' => 'nullable|array',
            'status' => 'required|in:active,completed,paused',
        ]);

        $workoutPlan->update($validated);

        return response()->json([
            'message' => 'Workout plan updated successfully',
            'plan' => $workoutPlan
        ]);
    }

    public function destroy(WorkoutPlan $workoutPlan)
    {
        if ($workoutPlan->trainer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $workoutPlan->delete();

        return response()->json(['message' => 'Workout plan deleted successfully']);
    }

    public function getMembers()
    {
        $members = User::members()->active()->get(['id', 'name', 'email']);

        return response()->json($members);
    }
}