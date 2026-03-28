<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        $roles     = Role::all();
        $religions = Religion::where('status', 'active')->get();
        $users     = User::with('role', 'religion')->latest()->get();

        return view('auth.register', compact('roles', 'religions', 'users'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'student_number' => 'required|string|unique:users,student_number',
            'role_id'        => 'required|exists:roles,id',
            'religion_id'    => 'nullable|exists:religions,id',
            'phone'          => 'nullable|string|max:20',
            'region'         => 'nullable|string|max:100',
            'course'         => 'nullable|string|max:100',
            'year_of_study'  => 'nullable|integer|min:1|max:10',
            'password_changed' => 'required|in:0,1',
        ]);

        $user = User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'student_number'   => $request->student_number,
            'role_id'          => $request->role_id,
            'religion_id'      => $request->religion_id ?: null,
            'phone'            => $request->phone,
            'region'           => $request->region,
            'course'           => $request->course,
            'year_of_study'    => $request->year_of_study,
            'password'         => Hash::make('must123'),
            'is_active'        => 1,
            'password_changed' => $request->password_changed,
        ]);

        return redirect()->route('register')
            ->with('success', "User '{$user->name}' created! Login: {$user->student_number} / must123");
    }
}