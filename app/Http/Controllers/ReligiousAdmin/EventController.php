<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // ─── Guard ────────────────────────────────────────────────────────────────
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
        $religionId = $this->getReligionId();
        $religion   = Auth::user()->religion;

        $events = Event::where('religion_id', $religionId)
                       ->with('creator')
                       ->latest()
                       ->paginate(10);

        $stats = [
            'total'     => Event::where('religion_id', $religionId)->count(),
            'upcoming'  => Event::where('religion_id', $religionId)->where('status', 'upcoming')->count(),
            'ongoing'   => Event::where('religion_id', $religionId)->where('status', 'ongoing')->count(),
            'completed' => Event::where('religion_id', $religionId)->where('status', 'completed')->count(),
            'cancelled' => Event::where('religion_id', $religionId)->where('status', 'cancelled')->count(),
        ];

        return view('religious_admin.events', compact('events', 'religion', 'stats'));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $religionId = $this->getReligionId();

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_date'       => 'required|date|after_or_equal:today',
            'end_date'         => 'required|date|after_or_equal:start_date',
            'location'         => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'status'           => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        Event::create([
            'religion_id'      => $religionId,
            'title'            => $validated['title'],
            'description'      => $validated['description'] ?? null,
            'start_date'       => $validated['start_date'],
            'end_date'         => $validated['end_date'],
            'location'         => $validated['location'] ?? null,
            'max_participants' => $validated['max_participants'] ?? null,
            'status'           => $validated['status'],
            'created_by'       => Auth::id(),
        ]);

        return redirect()->route('religious_admin.events.index')
            ->with('success', "Event <strong>{$validated['title']}</strong> created successfully.");
    }

    // ─── SHOW (JSON for modal) ────────────────────────────────────────────────
    public function show(Event $event)
    {
        $this->authorizeEvent($event);

        $event->load('creator');

        return response()->json([
            'id'               => $event->id,
            'title'            => $event->title,
            'description'      => $event->description,
            'start_date'       => $event->start_date,
            'end_date'         => $event->end_date,
            'start_date_fmt'   => \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i'),
            'end_date_fmt'     => \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i'),
            'start_date_input' => \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i'),
            'end_date_input'   => \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i'),
            'location'         => $event->location,
            'max_participants' => $event->max_participants,
            'status'           => $event->status,
            'creator_name'     => $event->creator?->name ?? 'System',
            'created_at'       => $event->created_at->format('d M Y, h:i A'),
            'updated_at'       => $event->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, Event $event)
    {
        $this->authorizeEvent($event);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after_or_equal:start_date',
            'location'         => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'status'           => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update($validated);

        return redirect()->route('religious_admin.events.index')
            ->with('success', "Event <strong>{$event->title}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(Event $event)
    {
        $this->authorizeEvent($event);

        $title = $event->title;
        $event->delete();

        return redirect()->route('religious_admin.events.index')
            ->with('success', "Event <strong>{$title}</strong> deleted successfully.");
    }

    // ─── TOGGLE STATUS ────────────────────────────────────────────────────────
    public function toggleStatus(Request $request, Event $event)
    {
        $this->authorizeEvent($event);

        $request->validate([
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update(['status' => $request->status]);

        return redirect()->route('religious_admin.events.index')
            ->with('success', "Event <strong>{$event->title}</strong> status updated to <strong>{$request->status}</strong>.");
    }

    // ─── Authorize ────────────────────────────────────────────────────────────
    private function authorizeEvent(Event $event): void
    {
        if ($event->religion_id !== $this->getReligionId()) {
            abort(403, 'You do not have access to this event.');
        }
    }
}