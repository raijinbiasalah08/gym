<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TrainerController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $trainers = User::trainers()
            ->withCount(['trainerBookings', 'workoutPlans'])
            ->latest()
            ->paginate(10);

        return view('admin.trainers.index', compact('trainers'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.trainers.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'specialization' => 'required|string|max:255',
            'certifications' => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'trainer';
        $validated['is_active'] = true;

        $trainer = User::create($validated);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Trainer created successfully.');
    }

    public function show(User $trainer)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (!$trainer->isTrainer()) {
            abort(404);
        }

        $trainer->loadCount(['trainerBookings', 'workoutPlans']);
        $trainer->load(['trainerBookings.member', 'workoutPlans.member']);

        return view('admin.trainers.show', compact('trainer'));
    }

    public function edit(User $trainer)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (!$trainer->isTrainer()) {
            abort(404);
        }

        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(Request $request, User $trainer)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (!$trainer->isTrainer()) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($trainer->id)],
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'certifications' => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $trainer->update($validated);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Trainer updated successfully.');
    }

    public function destroy(User $trainer)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (!$trainer->isTrainer()) {
            abort(404);
        }

        $trainer->delete();

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Trainer deleted successfully.');
    }

    public function toggleStatus(User $trainer)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        if (!$trainer->isTrainer()) {
            abort(404);
        }

        $trainer->update(['is_active' => !$trainer->is_active]);

        return response()->json([
            'message' => 'Trainer status updated successfully',
            'is_active' => $trainer->is_active
        ]);
    }
}