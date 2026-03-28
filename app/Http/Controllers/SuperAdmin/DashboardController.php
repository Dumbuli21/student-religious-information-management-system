<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Religion;
use App\Models\User;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->requirePasswordChanged();
        $this->requireRole('super_admin');

        $stats = [
            'total_users'         => User::count(),
            'total_religions'     => Religion::count(),
            'total_events'        => Event::count(),
            'total_announcements' => Announcement::count(),
            'active_users'        => User::where('is_active', true)->count(),
        ];

        $recent_users = User::with('role', 'religion')
            ->latest()->take(5)->get();

        return view('super_admin.dashboard', compact('stats', 'recent_users'));
    }
}