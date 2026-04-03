<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    private function getReligionId(): int
    {
        $id = Auth::user()->religion_id;
        if (!$id) abort(403, 'You are not assigned to any religion.');
        return $id;
    }

    private function authorizeAnnouncement(Announcement $announcement): void
    {
        if ($announcement->religion_id !== $this->getReligionId()) {
            abort(403, 'Access denied.');
        }
    }

    public function index()
    {
        $religionId   = $this->getReligionId();
        $religion     = Auth::user()->religion;

        $announcements = Announcement::where('religion_id', $religionId)
                                     ->with('creator')
                                     ->latest()
                                     ->paginate(10);

        $stats = [
            'total'     => Announcement::where('religion_id', $religionId)->count(),
            'published' => Announcement::where('religion_id', $religionId)->where('is_published', true)->count(),
            'drafts'    => Announcement::where('religion_id', $religionId)->where('is_published', false)->count(),
        ];

        return view('sub_admin.announcements', compact('announcements', 'religion', 'stats'));
    }

    public function store(Request $request)
    {
        $religionId = $this->getReligionId();

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'is_published' => 'required|in:0,1',
        ]);

        Announcement::create([
            'religion_id'  => $religionId,
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'is_published' => $validated['is_published'],
            'published_at' => $validated['is_published'] ? now() : null,
            'created_by'   => Auth::id(),
        ]);

        return redirect()->route('sub_admin.announcements.index')
            ->with('success', "Announcement <strong>{$validated['title']}</strong> created successfully.");
    }

    public function show(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);
        $announcement->load('creator');

        return response()->json([
            'id'           => $announcement->id,
            'title'        => $announcement->title,
            'content'      => $announcement->content,
            'is_published' => $announcement->is_published,
            'published_at' => $announcement->published_at?->format('d M Y, h:i A'),
            'creator_name' => $announcement->creator?->name ?? 'System',
            'created_at'   => $announcement->created_at->format('d M Y, h:i A'),
            'updated_at'   => $announcement->updated_at->format('d M Y, h:i A'),
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'is_published' => 'required|in:0,1',
        ]);

        $announcement->update([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'is_published' => $validated['is_published'],
            'published_at' => $validated['is_published'] && !$announcement->published_at
                                ? now() : $announcement->published_at,
        ]);

        return redirect()->route('sub_admin.announcements.index')
            ->with('success', "Announcement <strong>{$announcement->title}</strong> updated successfully.");
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);
        $title = $announcement->title;
        $announcement->delete();

        return redirect()->route('sub_admin.announcements.index')
            ->with('success', "Announcement <strong>{$title}</strong> deleted.");
    }

    public function togglePublish(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);

        $announcement->update([
            'is_published' => !$announcement->is_published,
            'published_at' => !$announcement->is_published ? now() : $announcement->published_at,
        ]);

        $status = $announcement->is_published ? 'published' : 'unpublished';

        return redirect()->route('sub_admin.announcements.index')
            ->with('success', "Announcement <strong>{$announcement->title}</strong> {$status}.");
    }
}