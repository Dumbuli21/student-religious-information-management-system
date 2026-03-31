<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Level;
use App\Models\Programme;
use App\Models\Region;
use App\Models\Religion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $users = User::with([
            'role', 'religion', 'region', 'level', 'department', 'programme',
        ])->latest()->paginate(15);

        $roles       = Role::all();
        $religions   = Religion::where('status', 'active')->get();
        $levels      = Level::all();
        $departments = Department::all();
        $programmes  = Programme::all();
        $regions     = Region::orderBy('name')->get();

        return view('super_admin.users', compact(
            'users', 'roles', 'religions', 'levels', 'departments', 'programmes', 'regions'
        ));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'student_number'   => 'required|string|unique:users,student_number',
            'gender'           => 'required|in:male,female',
            'role_id'          => 'required|exists:roles,id',
            'religion_id'      => 'nullable|exists:religions,id',
            'region_id'        => 'nullable|exists:regions,id',
            'level_id'         => 'nullable|exists:levels,id',
            'department_id'    => 'nullable|exists:departments,id',
            'programme_id'     => 'nullable|exists:programmes,id',
            'year_of_study'    => 'nullable|integer|min:1|max:4',
            'phone'            => 'nullable|string|max:20',
            'password_changed' => 'required|in:0,1',
        ]);

        $user = User::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'student_number'   => $validated['student_number'],
            'gender'           => $validated['gender'],
            'role_id'          => $validated['role_id'],
            'religion_id'      => $validated['religion_id'] ?? null,
            'region_id'        => $validated['region_id'] ?? null,
            'level_id'         => $validated['level_id'] ?? null,
            'department_id'    => $validated['department_id'] ?? null,
            'programme_id'     => $validated['programme_id'] ?? null,
            'year_of_study'    => $validated['year_of_study'] ?? null,
            'phone'            => $validated['phone'] ?? null,
            'password'         => Hash::make('must123'),
            'is_active'        => true,
            'password_changed' => $validated['password_changed'],
            'created_by'       => auth()->id(),
        ]);

        return redirect()->route('super_admin.users.index')
            ->with('success', "User <strong>{$user->name}</strong> created successfully! Default password: <strong>must123</strong>");
    }

    // ─── SHOW (JSON for modals) ───────────────────────────────────────────────
    public function show(User $user)
    {
        $user->load(['role', 'religion', 'region', 'level', 'department', 'programme', 'creator']);

        return response()->json([
            'id'               => $user->id,
            'name'             => $user->name,
            'email'            => $user->email,
            'student_number'   => $user->student_number,
            'phone'            => $user->phone,
            'gender'           => $user->gender,
            'is_active'        => $user->is_active,
            'password_changed' => $user->password_changed,
            'year_of_study'    => $user->year_of_study,
            'role_id'          => $user->role_id,
            'religion_id'      => $user->religion_id,
            'region_id'        => $user->region_id,
            'level_id'         => $user->level_id,
            'department_id'    => $user->department_id,
            'programme_id'     => $user->programme_id,
            'role_name'        => ucwords(str_replace('_', ' ', $user->role?->name)),
            'religion_name'    => $user->religion?->name,
            'region_name'      => $user->region?->name,
            'level_name'       => $user->level?->name,
            'department_name'  => $user->department?->name,
            'programme_name'   => $user->programme?->name,
            'creator_name'     => $user->creator?->name ?? 'System',
            'created_at'       => $user->created_at->format('d M Y, h:i A'),
            'updated_at'       => $user->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'student_number' => 'required|string|unique:users,student_number,' . $user->id,
            'gender'         => 'required|in:male,female',
            'role_id'        => 'required|exists:roles,id',
            'religion_id'    => 'nullable|exists:religions,id',
            'region_id'      => 'nullable|exists:regions,id',
            'level_id'       => 'nullable|exists:levels,id',
            'department_id'  => 'nullable|exists:departments,id',
            'programme_id'   => 'nullable|exists:programmes,id',
            'year_of_study'  => 'nullable|integer|min:1|max:4',
            'phone'          => 'nullable|string|max:20',
            'is_active'      => 'required|in:0,1',
        ]);

        $user->update([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'student_number' => $validated['student_number'],
            'gender'         => $validated['gender'],
            'role_id'        => $validated['role_id'],
            'religion_id'    => $validated['religion_id'] ?? null,
            'region_id'      => $validated['region_id'] ?? null,
            'level_id'       => $validated['level_id'] ?? null,
            'department_id'  => $validated['department_id'] ?? null,
            'programme_id'   => $validated['programme_id'] ?? null,
            'year_of_study'  => $validated['year_of_study'] ?? null,
            'phone'          => $validated['phone'] ?? null,
            'is_active'      => $validated['is_active'],
        ]);

        return redirect()->route('super_admin.users.index')
            ->with('success', "User <strong>{$user->name}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('super_admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('super_admin.users.index')
            ->with('success', "User <strong>{$name}</strong> has been deleted.");
    }

    // ─── RESET PASSWORD ───────────────────────────────────────────────────────
    public function resetPassword(User $user)
    {
        $user->update([
            'password'         => Hash::make('must123'),
            'password_changed' => false,
        ]);

        return redirect()->route('super_admin.users.index')
            ->with('success', "Password for <strong>{$user->name}</strong> reset to <strong>must123</strong>.");
    }
}