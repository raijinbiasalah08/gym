<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isTrainer()) {
            abort(403, 'Unauthorized access.');
        }

        $trainer = Auth::user();
        
        $query = Booking::with('member')
            ->where('trainer_id', $trainer->id);

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Booking::where('trainer_id', $trainer->id)->count(),
            'pending' => Booking::where('trainer_id', $trainer->id)->pending()->count(),
            'confirmed' => Booking::where('trainer_id', $trainer->id)->confirmed()->count(),
            'completed' => Booking::where('trainer_id', $trainer->id)->completed()->count(),
        ];

        return view('trainer.bookings.index', compact('bookings', 'stats'));
    }

    public function show(Booking $booking)
    {
        if (!Auth::user()->isTrainer() || $booking->trainer_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $booking->load('member');

        return view('trainer.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if (!Auth::user()->isTrainer() || $booking->trainer_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'required|in:confirmed,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('trainer.bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function calendar()
    {
        if (!Auth::user()->isTrainer()) {
            abort(403, 'Unauthorized access.');
        }

        $trainer = Auth::user();
        
        $bookings = Booking::with('member')
            ->where('trainer_id', $trainer->id)
            ->where('status', 'confirmed')
            ->where('booking_date', '>=', now())
            ->get(['id', 'member_id', 'booking_date', 'start_time', 'end_time', 'session_type'])
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->member->name . ' - ' . ucfirst($booking->session_type),
                    'start' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->start_time,
                    'end' => $booking->booking_date->format('Y-m-d') . 'T' . $booking->end_time,
                    'color' => $this->getEventColor($booking->session_type),
                ];
            });

        return view('trainer.bookings.calendar', compact('bookings'));
    }

    private function getEventColor($sessionType)
    {
        return match($sessionType) {
            'personal_training' => '#3B82F6', // blue
            'group_session' => '#10B981', // green
            'consultation' => '#8B5CF6', // purple
            default => '#6B7280', // gray
        };
    }
}