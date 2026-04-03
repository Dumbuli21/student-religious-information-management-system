<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;
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
            'announcements' => Announcement::where('religion_id', $religionId)->count(),
            'events'        => Event::where('religion_id', $religionId)->count(),
            'members'       => User::where('religion_id', $religionId)
                                   ->where('is_active', true)
                                   ->count(),
            'upcoming'      => Event::where('religion_id', $religionId)
                                    ->where('status', 'upcoming')
                                    ->where('start_date', '>=', now())
                                    ->count(),
        ];

        $recent_announcements = Announcement::where('religion_id', $religionId)
                                            ->latest()
                                            ->take(5)
                                            ->get();

        $upcoming_events = Event::where('religion_id', $religionId)
                                ->where('status', 'upcoming')
                                ->where('start_date', '>=', now())
                                ->orderBy('start_date')
                                ->take(5)
                                ->get();

        return view('sub_admin.dashboard', compact(
            'religion',
            'stats',
            'recent_announcements',
            'upcoming_events',
        ));
    }
}