<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
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

        $feedbacks = Feedback::where('user_id', Auth::id())
                             ->where('religion_id', $religionId)
                             ->latest()
                             ->paginate(10);

        return view('student.feedback', compact('feedbacks', 'religion'));
    }

    public function store(Request $request)
    {
        $religionId = $this->getReligionId();

        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Feedback::create([
            'religion_id' => $religionId,
            'user_id'     => Auth::id(),
            'subject'     => $validated['subject'] ?? null,
            'message'     => $validated['message'],
            'status'      => 'pending',
        ]);

        return redirect()->route('student.feedback.index')
            ->with('success', 'Your feedback has been submitted successfully.');
    }

    public function destroy(Feedback $feedback)
    {
        // Only own feedback
        if ($feedback->user_id !== Auth::id()) abort(403);

        $feedback->delete();

        return redirect()->route('student.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}