<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // ─── Guard ────────────────────────────────────────────────────────────────
    private function getReligionId(): int
    {
        $religionId = Auth::user()->religion_id;
        if (!$religionId) abort(403, 'You are not assigned to any religion.');
        return $religionId;
    }

    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $religionId = $this->getReligionId();
        $religion   = Auth::user()->religion;

        $feedbacks = Feedback::where('religion_id', $religionId)
                             ->with('user')
                             ->latest()
                             ->paginate(10);

        $stats = [
            'total'    => Feedback::where('religion_id', $religionId)->count(),
            'pending'  => Feedback::where('religion_id', $religionId)->where('status', 'pending')->count(),
            'reviewed' => Feedback::where('religion_id', $religionId)->where('status', 'reviewed')->count(),
            'resolved' => Feedback::where('religion_id', $religionId)->where('status', 'resolved')->count(),
        ];

        return view('religious_admin.feedback', compact('feedbacks', 'religion', 'stats'));
    }

    // ─── SHOW (JSON for modal) ────────────────────────────────────────────────
    public function show(Feedback $feedback)
    {
        $this->authorizeFeedback($feedback);
        $feedback->load('user');

        return response()->json([
            'id'         => $feedback->id,
            'subject'    => $feedback->subject,
            'message'    => $feedback->message,
            'status'     => $feedback->status,
            'user_name'  => $feedback->user?->name ?? 'Anonymous',
            'user_email' => $feedback->user?->email ?? '–',
            'created_at' => $feedback->created_at->format('d M Y, h:i A'),
            'updated_at' => $feedback->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(Feedback $feedback)
    {
        $this->authorizeFeedback($feedback);

        $feedback->delete();

        return redirect()->route('religious_admin.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }

    // ─── UPDATE STATUS ────────────────────────────────────────────────────────
    public function updateStatus(Request $request, Feedback $feedback)
    {
        $this->authorizeFeedback($feedback);

        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
        ]);

        $feedback->update(['status' => $request->status]);

        return redirect()->route('religious_admin.feedback.index')
            ->with('success', "Feedback marked as <strong>{$request->status}</strong>.");
    }

    // ─── Authorize ────────────────────────────────────────────────────────────
    private function authorizeFeedback(Feedback $feedback): void
    {
        if ($feedback->religion_id !== $this->getReligionId()) {
            abort(403, 'This feedback does not belong to your religion.');
        }
    }
}