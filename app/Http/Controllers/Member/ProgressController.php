<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $member = Auth::user();

        $progress = Progress::where('member_id', $member->id)
            ->orderBy('record_date', 'desc')
            ->paginate(10);

        return response()->json($progress);
    }

    public function show(Progress $progress)
    {
        if ($progress->member_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($progress);
    }

    public function progressChart()
    {
        $member = Auth::user();

        $progress = Progress::where('member_id', $member->id)
            ->orderBy('record_date')
            ->get(['record_date', 'weight', 'bmi', 'body_fat_percentage', 'muscle_mass']);

        return response()->json($progress);
    }

    public function latestProgress()
    {
        $member = Auth::user();

        $progress = Progress::where('member_id', $member->id)
            ->latest('record_date')
            ->first();

        return response()->json($progress);
    }
}