<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\BaseController;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->requirePasswordChanged();
        $this->requireRole('religious_admin');

        $user       = Auth::user();
        $religionId = $user->religion_id;

        $stats = [
            'my_announcements' => Announcement::where('religion_id', $religionId)->count(),
            'my_events'        => Event::where('religion_id', $religionId)->count(),
            'members'          => User::where('religion_id', $religionId)->count(),
            'upcoming_events'  => Event::where('religion_id', $religionId)->where('status', 'upcoming')->count(),
        ];

        $recent_announcements = Announcement::where('religion_id', $religionId)->latest()->take(5)->get();
        $upcoming_events      = Event::where('religion_id', $religionId)->where('status', 'upcoming')->orderBy('start_date')->take(5)->get();

        return view('religious_admin.dashboard', compact('stats', 'recent_announcements', 'upcoming_events'));
    }
}