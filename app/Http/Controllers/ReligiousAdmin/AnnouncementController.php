<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // ─── Guard: ensure user belongs to a religion ─────────────────────────────
    private function getReligionId(): int
    {
        $religionId = Auth::user()->religion_id;

        if (!$religionId) {
            abort(403, 'You are not assigned to any religion.');
        }

        return $religionId;
    }

    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $religionId    = $this->getReligionId();
        $religion      = Auth::user()->religion;

        $announcements = Announcement::where('religion_id', $religionId)
                                     ->with('creator')
                                     ->latest()
                                     ->paginate(10);

        $stats = [
            'total'     => Announcement::where('religion_id', $religionId)->count(),
            'published' => Announcement::where('religion_id', $religionId)->where('is_published', true)->count(),
            'drafts'    => Announcement::where('religion_id', $religionId)->where('is_published', false)->count(),
        ];

        return view('religious_admin.announcements', compact('announcements', 'religion', 'stats'));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
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

        return redirect()->route('religious_admin.announcements.index')
            ->with('success', "Announcement <strong>{$validated['title']}</strong> created successfully.");
    }

    // ─── SHOW (JSON for modal) ────────────────────────────────────────────────
    public function show(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);

        $announcement->load('creator');

        return response()->json([
            'id'           => $announcement->id,
            'title'        => $announcement->title,
            'content'      => $announcement->content,
            'is_published' => $announcement->is_published,
            'published_at' => $announcement->published_at
                                ? $announcement->published_at->format('d M Y, h:i A')
                                : null,
            'creator_name' => $announcement->creator?->name ?? 'System',
            'created_at'   => $announcement->created_at->format('d M Y, h:i A'),
            'updated_at'   => $announcement->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
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
                                ? now()
                                : $announcement->published_at,
        ]);

        return redirect()->route('religious_admin.announcements.index')
            ->with('success', "Announcement <strong>{$announcement->title}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);

        $title = $announcement->title;
        $announcement->delete();

        return redirect()->route('religious_admin.announcements.index')
            ->with('success', "Announcement <strong>{$title}</strong> deleted successfully.");
    }

    // ─── TOGGLE PUBLISH ───────────────────────────────────────────────────────
    public function togglePublish(Announcement $announcement)
    {
        $this->authorizeAnnouncement($announcement);

        $announcement->update([
            'is_published' => !$announcement->is_published,
            'published_at' => !$announcement->is_published ? now() : $announcement->published_at,
        ]);

        $status = $announcement->is_published ? 'published' : 'unpublished';

        return redirect()->route('religious_admin.announcements.index')
            ->with('success', "Announcement <strong>{$announcement->title}</strong> {$status}.");
    }

    // ─── Authorize: announcement must belong to this religion ─────────────────
    private function authorizeAnnouncement(Announcement $announcement): void
    {
        if ($announcement->religion_id !== $this->getReligionId()) {
            abort(403, 'You do not have access to this announcement.');
        }
    }
}