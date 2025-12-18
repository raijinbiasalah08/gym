<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger,success',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->has('active');

        $announcement = Announcement::create($validated);

        // Notify all active users if the announcement is active
        if ($announcement->active) {
            $users = User::where('is_active', true)->get();
            
            // Map announcement type to notification colors and icons
            $colors = [
                'info' => 'blue',
                'warning' => 'yellow',
                'danger' => 'red',
                'success' => 'green',
            ];

            $icons = [
                'info' => 'fas fa-info-circle',
                'warning' => 'fas fa-exclamation-triangle',
                'danger' => 'fas fa-exclamation-circle',
                'success' => 'fas fa-check-circle',
            ];
            
            // Create notification for each user
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'announcement',
                    'title' => $announcement->title,
                    'message' => $announcement->message,
                    'icon' => $icons[$announcement->type] ?? 'fas fa-bell',
                    'color' => $colors[$announcement->type] ?? 'blue',
                    'link' => null,
                    'is_read' => false,
                ]);
            }
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,warning,danger,success',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->has('active');

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
