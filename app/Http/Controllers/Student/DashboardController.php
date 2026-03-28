<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\BaseController;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->requirePasswordChanged();
        $this->requireRole('student');

        $user       = Auth::user();
        $religionId = $user->religion_id;

        $upcoming_events      = Event::where('religion_id', $religionId)->where('status', 'upcoming')->orderBy('start_date')->take(5)->get();
        $latest_announcements = Announcement::where('religion_id', $religionId)->where('is_published', true)->latest('published_at')->take(5)->get();
        $my_registrations     = EventRegistration::where('user_id', $user->id)->with('event')->latest('registered_at')->take(5)->get();
        $unread_notifications = $user->notifications()->where('is_read', false)->count();

        return view('student.dashboard', compact(
            'upcoming_events', 'latest_announcements',
            'my_registrations', 'unread_notifications'
        ));
    }
}
