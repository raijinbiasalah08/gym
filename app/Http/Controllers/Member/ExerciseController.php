<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display the exercise library for members
     */
    public function index()
    {
        return view('member.exercises.index');
    }

    /**
     * Display the specified exercise details
     */
    public function show($slug)
    {
        $exercise = Exercise::where('slug', $slug)->first();
        
        // If exercise doesn't exist in database, show coming soon page
        if (!$exercise) {
            return view('member.exercises.coming-soon', [
                'exerciseName' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug
            ]);
        }
        
        return view('member.exercises.show', compact('exercise'));
    }
}
