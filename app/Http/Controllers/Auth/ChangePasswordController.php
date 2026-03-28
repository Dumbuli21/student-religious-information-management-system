<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        // Simply show the form — no redirects here
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers(),
            ],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Your current password is incorrect.',
            ]);
        }

        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'New password must be different from your current password.',
            ]);
        }

        // Save new password
        $user->password         = Hash::make($request->password);
        $user->password_changed = true;
        $user->save();

        try {
            ActivityLog::create([
                'user_id'      => $user->id,
                'action'       => 'password_changed',
                'subject_type' => 'User',
                'subject_id'   => $user->id,
                'properties'   => json_encode(['ip' => $request->ip()]),
            ]);
        } catch (\Exception $e) {
            //
        }

        // Fresh reload of user to get updated role
        $user->refresh();

        return redirect()->route($user->dashboardRoute())
            ->with('success', 'Password changed successfully! Welcome to SRIMS.');
    }
}