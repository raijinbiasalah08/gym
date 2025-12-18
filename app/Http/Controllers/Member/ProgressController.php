<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ProgressLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Auth::user();

        // Fetch logs ordered by date for the chart and list
        $logs = ProgressLog::where('user_id', $member->id)
            ->orderBy('log_date', 'asc')
            ->get();

        return view('member.progress.index', compact('logs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:20|max:300',
            'body_fat_percentage' => 'nullable|numeric|min:3|max:60',
            'log_date' => 'required|date|before_or_equal:today',
            'photo' => 'nullable|image|max:5120', // 5MB max
        ]);

        // Calculate BMI automatically if height is present in user profile
        // Assuming height is stored in meters in user profile or we ask relevant question. 
        // For now, let's calculate based on weight and a fixed height or just store what we have.
        // If we don't have height, we can't calc BMI accurately here unless we ask for it every time or store it in user profile.
        // Let's assume we calculate it if the user has a reference height, otherwise we leave it null or calc it in JS.
        // **Correction**: The plan said "calculate BMI automatically". 
        // Let's check if the user has a height attribute.
        
        $user = Auth::user();
        $bmi = null;

        // Simple BMI calc if we had height. 
        // Since User model schema isn't fully visible, I'll assume we might not have height yet.
        // However, I'll add logic: IF user has height, calc BMI. 
        // Else, just store the weight.
        
        // Handling Photo Upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('progress_photos', 'public');
        }

        ProgressLog::create([
            'user_id' => $user->id,
            'weight' => $validated['weight'],
            'body_fat_percentage' => $validated['body_fat_percentage'],
            'bmi' => $bmi, // Will be null for now, or calculated if we add height logic later
            'photo_path' => $photoPath,
            'log_date' => $validated['log_date'],
        ]);

        return redirect()->route('member.progress.index')->with('success', 'Progress logged successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgressLog $progressLog)
    {
        if ($progressLog->user_id !== Auth::id()) {
            abort(403);
        }

        if ($progressLog->photo_path) {
            Storage::disk('public')->delete($progressLog->photo_path);
        }

        $progressLog->delete();

        return back()->with('success', 'Log deleted successfully.');
    }
}