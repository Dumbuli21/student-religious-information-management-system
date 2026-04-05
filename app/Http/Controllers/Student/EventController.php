<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
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
        $user       = Auth::user();

        $events = Event::where('religion_id', $religionId)
                       ->whereIn('status', ['upcoming', 'ongoing'])
                       ->orderBy('start_date')
                       ->paginate(10);

        $registeredEventIds = EventRegistration::where('user_id', $user->id)
                                               ->pluck('event_id')
                                               ->toArray();

        $stats = [
            'total'    => Event::where('religion_id', $religionId)->count(),
            'upcoming' => Event::where('religion_id', $religionId)->where('status', 'upcoming')->count(),
            'ongoing'  => Event::where('religion_id', $religionId)->where('status', 'ongoing')->count(),
            'my_count' => count($registeredEventIds),
        ];

        return view('student.events', compact(
            'events', 'religion', 'stats', 'registeredEventIds'
        ));
    }

    // ✅ UPDATED METHOD (AJAX + NORMAL VIEW)
    public function show(Event $event)
    {
        if ($event->religion_id !== $this->getReligionId()) abort(404);

        $user              = Auth::user();
        $registered        = EventRegistration::where('event_id', $event->id)
                                              ->where('user_id', $user->id)
                                              ->exists();

        $participantsCount = EventRegistration::where('event_id', $event->id)->count();

        // ✅ AJAX request (for modal)
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'id'                 => $event->id,
                'title'              => $event->title,
                'description'        => $event->description,
                'start_date_fmt'     => Carbon::parse($event->start_date)->format('d M Y, H:i'),
                'end_date_fmt'       => Carbon::parse($event->end_date)->format('d M Y, H:i'),
                'start_date_input'   => Carbon::parse($event->start_date)->format('Y-m-d\TH:i'),
                'end_date_input'     => Carbon::parse($event->end_date)->format('Y-m-d\TH:i'),
                'location'           => $event->location,
                'max_participants'   => $event->max_participants,
                'participants_count' => $participantsCount,
                'status'             => $event->status,
                'is_registered'      => $registered,
            ]);
        }

        // ✅ Normal page view
        $religion = Auth::user()->religion;

        return view('student.events', compact(
            'event', 'religion', 'registered', 'participantsCount'
        ));
    }

    public function register(Event $event)
    {
        if ($event->religion_id !== $this->getReligionId()) abort(404);

        $user = Auth::user();

        if (EventRegistration::where('event_id', $event->id)
                              ->where('user_id', $user->id)
                              ->exists()) {
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }

        if ($event->max_participants) {
            $count = EventRegistration::where('event_id', $event->id)->count();
            if ($count >= $event->max_participants) {
                return redirect()->back()->with('error', 'This event is full.');
            }
        }

        EventRegistration::create([
            'event_id'      => $event->id,
            'user_id'       => $user->id,
            'registered_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', "You have successfully registered for {$event->title}.");
    }

    public function unregister(Event $event)
    {
        if ($event->religion_id !== $this->getReligionId()) abort(404);

        EventRegistration::where('event_id', $event->id)
                         ->where('user_id', Auth::id())
                         ->delete();

        return redirect()->back()
            ->with('success', "You have unregistered from {$event->title}.");
    }
}