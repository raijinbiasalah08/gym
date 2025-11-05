<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $query = Progress::with('member');

        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('record_date', [$request->date_from, $request->date_to]);
        }

        $progress = $query->orderBy('record_date', 'desc')->paginate(10);

        return response()->json($progress);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'record_date' => 'required|date',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0',
            'chest_measurement' => 'nullable|numeric|min:0',
            'waist_measurement' => 'nullable|numeric|min:0',
            'hip_measurement' => 'nullable|numeric|min:0',
            'arm_measurement' => 'nullable|numeric|min:0',
            'thigh_measurement' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate BMI
        $validated['bmi'] = $this->calculateBMI($validated['weight'], $validated['height']);

        $progress = Progress::create($validated);

        return response()->json([
            'message' => 'Progress recorded successfully',
            'progress' => $progress
        ], 201);
    }

    public function show(Progress $progress)
    {
        $progress->load('member');

        return response()->json($progress);
    }

    public function update(Request $request, Progress $progress)
    {
        $validated = $request->validate([
            'record_date' => 'required|date',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass' => 'nullable|numeric|min:0',
            'chest_measurement' => 'nullable|numeric|min:0',
            'waist_measurement' => 'nullable|numeric|min:0',
            'hip_measurement' => 'nullable|numeric|min:0',
            'arm_measurement' => 'nullable|numeric|min:0',
            'thigh_measurement' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate BMI
        $validated['bmi'] = $this->calculateBMI($validated['weight'], $validated['height']);

        $progress->update($validated);

        return response()->json([
            'message' => 'Progress updated successfully',
            'progress' => $progress
        ]);
    }

    public function destroy(Progress $progress)
    {
        $progress->delete();

        return response()->json(['message' => 'Progress record deleted successfully']);
    }

    public function memberProgress($memberId)
    {
        $progress = Progress::where('member_id', $memberId)
            ->orderBy('record_date')
            ->get(['record_date', 'weight', 'bmi', 'body_fat_percentage', 'muscle_mass']);

        return response()->json($progress);
    }

    private function calculateBMI($weight, $height)
    {
        // Height should be in meters for BMI calculation
        // Assuming height is stored in cm, convert to meters
        $heightInMeters = $height / 100;
        return round($weight / ($heightInMeters * $heightInMeters), 1);
    }
}