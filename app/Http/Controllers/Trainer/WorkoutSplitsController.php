<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutSplitsController extends Controller
{
    public function index()
    {
        return view('trainer.workout-splits.index');
    }
}
