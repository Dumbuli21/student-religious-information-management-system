<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $religion = $user->religion;

        if (!$religion) {
            abort(403, 'You are not assigned to any religion.');
        }

        $religionId = $religion->id;

        $stats = [
            // Announcements for this student's religion
            'announcements'     => Announcement::where('religion_id', $religionId)
                                               ->where('is_published', true)
                                               ->count(),

            // Total events for this religion
            'events'            => Event::where('religion_id', $religionId)->count(),

            // Upcoming events
            'upcoming_events'   => Event::where('religion_id', $religionId)
                                        ->where('status', 'upcoming')
                                        ->where('start_date', '>=', now())
                                        ->count(),

            // Events this student registered for
            'my_registrations'  => EventRegistration::where('user_id', $user->id)->count(),
        ];

        // Recent published announcements
        $recent_announcements = Announcement::where('religion_id', $religionId)
                                            ->where('is_published', true)
                                            ->latest('published_at')
                                            ->take(5)
                                            ->get();

        // Upcoming events
        $upcoming_events = Event::where('religion_id', $religionId)
                                ->where('status', 'upcoming')
                                ->where('start_date', '>=', now())
                                ->orderBy('start_date')
                                ->take(5)
                                ->get();

        // Events the student has registered for
        $my_events = Event::whereHas('registrations', fn($q) => $q->where('user_id', $user->id))
                          ->where('religion_id', $religionId)
                          ->with('registrations', fn($q) => $q->where('user_id', $user->id))
                          ->orderBy('start_date')
                          ->take(5)
                          ->get();

        return view('student.dashboard', compact(
            'user',
            'religion',
            'stats',
            'recent_announcements',
            'upcoming_events',
            'my_events',
        ));
    }
}