<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'password'         => Hash::make($request->password),
            'password_changed' => true,
        ]);

        // After successful change, redirect based on role
        return $this->redirectBasedOnRole($user);
    }

    private function redirectBasedOnRole($user)
    {
        switch ($user->role->name) {
            case 'super_admin':
                return redirect()->route('dashboard.superadmin')->with('success', 'Password changed successfully!');

            case 'religious_admin':
                return redirect()->route('dashboard.religious')->with('success', 'Password changed successfully!');

            case 'sub_admin':
                return redirect()->route('dashboard.subadmin')->with('success', 'Password changed successfully!');

            case 'student':
                return redirect()->route('dashboard.student')->with('success', 'Password changed successfully!');

            default:
                return redirect()->route('dashboard')->with('success', 'Password changed successfully!');
        }
    }
}