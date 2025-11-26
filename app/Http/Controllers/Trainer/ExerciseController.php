<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display the specified exercise.
     */
    public function show($slug)
    {
        $exercise = Exercise::where('slug', $slug)->first();
        
        // If exercise doesn't exist in database, show coming soon page
        if (!$exercise) {
            return view('trainer.exercises.coming-soon', [
                'exerciseName' => ucwords(str_replace('-', ' ', $slug)),
                'slug' => $slug
            ]);
        }
        
        return view('trainer.exercises.show', compact('exercise'));
    }
}
