<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkoutSplitsController extends Controller
{
    public function index()
    {
        return view('member.workout-splits.index');
    }
}
