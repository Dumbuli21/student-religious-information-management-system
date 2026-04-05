<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BaseProfileController extends Controller
{
    // Override in child to set role prefix e.g. 'student', 'religious_admin'
    protected string $rolePrefix   = 'student';
    protected string $profileView  = 'student.profile';
    protected string $passwordView = 'student.change_password';

    public function show()
    {
        $user     = Auth::user()->load(['role','religion','region','level','department','programme']);
        $regions  = Region::orderBy('name')->get();
        $religion = $user->religion;

        return view($this->profileView, compact('user', 'regions', 'religion'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'phone'     => 'nullable|string|max:20',
            'region_id' => 'nullable|exists:regions,id',
        ]);

        $user->update($validated);

        return redirect()->route("{$this->rolePrefix}.profile")
            ->with('success', 'Profile updated successfully.');
    }

    public function changePasswordForm()
    {
        $user     = Auth::user();
        $religion = $user->religion;

        return view($this->passwordView, compact('user', 'religion'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password'         => Hash::make($request->password),
            'password_changed' => true,
        ]);

        return redirect()->route("{$this->rolePrefix}.profile")
            ->with('success', 'Password changed successfully.');
    }
}