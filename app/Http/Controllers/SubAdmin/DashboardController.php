<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\BaseController;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->requirePasswordChanged();
        $this->requireRole('sub_admin');

        $user       = Auth::user();
        $religionId = $user->religion_id;

        $upcoming_events      = Event::where('religion_id', $religionId)->where('status', 'upcoming')->orderBy('start_date')->take(5)->get();
        $latest_announcements = Announcement::where('religion_id', $religionId)->where('is_published', true)->latest('published_at')->take(5)->get();

        return view('sub_admin.dashboard', compact('upcoming_events', 'latest_announcements'));
    }
}