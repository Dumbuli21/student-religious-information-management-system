<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user      = Auth::user();
        $religion  = $user->religion;

        // Guard — must belong to a religion
        if (!$religion) {
            abort(403, 'You are not assigned to any religion.');
        }

        $religionId = $religion->id;

        $stats = [
            // Announcements created under this religion
            'my_announcements' => Announcement::where('religion_id', $religionId)->count(),

            // Events under this religion
            'my_events'        => Event::where('religion_id', $religionId)->count(),

            // Members (users) belonging to this religion
            'members'          => User::where('religion_id', $religionId)
                                      ->where('is_active', true)
                                      ->count(),

            // Upcoming events under this religion
            'upcoming_events'  => Event::where('religion_id', $religionId)
                                       ->where('status', 'upcoming')
                                       ->where('start_date', '>=', now())
                                       ->count(),
        ];

        // Recent announcements for this religion
        $recent_announcements = Announcement::where('religion_id', $religionId)
                                            ->latest()
                                            ->take(5)
                                            ->get();

        // Upcoming events for this religion
        $upcoming_events = Event::where('religion_id', $religionId)
                                ->where('status', 'upcoming')
                                ->where('start_date', '>=', now())
                                ->orderBy('start_date')
                                ->take(5)
                                ->get();

        // Recent members who joined this religion
        $recent_members = User::where('religion_id', $religionId)
                              ->with(['role', 'department', 'programme'])
                              ->latest()
                              ->take(5)
                              ->get();

        return view('religious_admin.dashboard', compact(
            'religion',
            'stats',
            'recent_announcements',
            'upcoming_events',
            'recent_members',
        ));
    }
}   