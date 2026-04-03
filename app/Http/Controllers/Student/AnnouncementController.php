<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    private function getReligionId(): int
    {
        $id = Auth::user()->religion_id;
        if (!$id) abort(403, 'You are not assigned to any religion.');
        return $id;
    }

    public function index()
    {
        $religionId = $this->getReligionId();
        $religion   = Auth::user()->religion;

        $announcements = Announcement::where('religion_id', $religionId)
                                     ->where('is_published', true)
                                     ->latest('published_at')
                                     ->paginate(10);

        return view('student.announcements', compact('announcements', 'religion'));
    }

    public function show(Announcement $announcement)
    {
        // Ensure it belongs to student's religion and is published
        if ($announcement->religion_id !== $this->getReligionId() || !$announcement->is_published) {
            abort(404);
        }

        $religion = Auth::user()->religion;

        return view('student.announcement_show', compact('announcement', 'religion'));
    }
}