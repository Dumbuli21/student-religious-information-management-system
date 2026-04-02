<?php

namespace App\Http\Controllers\ReligiousAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Level;
use App\Models\Programme;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
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

        $members = User::where('religion_id', $religionId)
                       ->with(['role', 'level', 'department', 'programme', 'region'])
                       ->latest()
                       ->paginate(15);

        // ✅ Only student and sub_admin
        $roles = Role::whereIn('name', ['student', 'sub_admin'])->get();

        $levels      = Level::all();
        $departments = Department::all();
        $programmes  = Programme::all();
        $regions     = Region::orderBy('name')->get();

        // ✅ student role id for JS default
        $studentRoleId = $roles->firstWhere('name', 'student')?->id;

        $stats = [
            'total'    => User::where('religion_id', $religionId)->count(),
            'active'   => User::where('religion_id', $religionId)->where('is_active', true)->count(),
            'inactive' => User::where('religion_id', $religionId)->where('is_active', false)->count(),
            'students' => User::where('religion_id', $religionId)
                              ->whereHas('role', fn($q) => $q->where('name', 'student'))
                              ->count(),
        ];

        return view('religious_admin.members', compact(
            'members', 'religion', 'stats',
            'roles', 'levels', 'departments', 'programmes', 'regions',
            'studentRoleId'
        ));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $religionId = $this->getReligionId();

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'student_number'   => 'required|string|unique:users,student_number',
            'gender'           => 'required|in:male,female',
            'role_id'          => 'required|exists:roles,id',
            'level_id'         => 'nullable|exists:levels,id',
            'department_id'    => 'nullable|exists:departments,id',
            'programme_id'     => 'nullable|exists:programmes,id',
            'region_id'        => 'nullable|exists:regions,id',
            'year_of_study'    => 'nullable|integer|min:1|max:4',
            'phone'            => 'nullable|string|max:20',
            'password_changed' => 'required|in:0,1',
        ]);

        // ✅ Ensure only allowed roles
        $allowedRole = Role::whereIn('name', ['student', 'sub_admin'])
                           ->where('id', $validated['role_id'])
                           ->exists();
        if (!$allowedRole) abort(403, 'Invalid role selected.');

        User::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'student_number'   => $validated['student_number'],
            'gender'           => $validated['gender'],
            'role_id'          => $validated['role_id'],
            'religion_id'      => $religionId,
            'level_id'         => $validated['level_id'] ?? null,
            'department_id'    => $validated['department_id'] ?? null,
            'programme_id'     => $validated['programme_id'] ?? null,
            'region_id'        => $validated['region_id'] ?? null,
            'year_of_study'    => $validated['year_of_study'] ?? null,
            'phone'            => $validated['phone'] ?? null,
            'password'         => Hash::make('must123'),
            'is_active'        => true,
            'password_changed' => $validated['password_changed'],
            'created_by'       => Auth::id(),
        ]);

        return redirect()->route('religious_admin.members.index')
            ->with('success', "Member <strong>{$validated['name']}</strong> added. Default password: <strong>must123</strong>");
    }

    // ─── SHOW (JSON for modals) ───────────────────────────────────────────────
    public function show(User $member)
    {
        $this->authorizeMember($member);
        $member->load(['role', 'level', 'department', 'programme', 'region', 'creator']);

        return response()->json([
            'id'               => $member->id,
            'name'             => $member->name,
            'email'            => $member->email,
            'student_number'   => $member->student_number,
            'phone'            => $member->phone,
            'gender'           => $member->gender,
            'is_active'        => $member->is_active,
            'password_changed' => $member->password_changed,
            'year_of_study'    => $member->year_of_study,
            'role_id'          => $member->role_id,
            'level_id'         => $member->level_id,
            'department_id'    => $member->department_id,
            'programme_id'     => $member->programme_id,
            'region_id'        => $member->region_id,
            'role_name'        => ucwords(str_replace('_', ' ', $member->role?->name)),
            'level_name'       => $member->level?->name,
            'department_name'  => $member->department?->name,
            'programme_name'   => $member->programme?->name,
            'region_name'      => $member->region?->name,
            'creator_name'     => $member->creator?->name ?? 'System',
            'created_at'       => $member->created_at->format('d M Y, h:i A'),
            'updated_at'       => $member->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, User $member)
    {
        $this->authorizeMember($member);

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $member->id,
            'student_number' => 'required|string|unique:users,student_number,' . $member->id,
            'gender'         => 'required|in:male,female',
            'role_id'        => 'required|exists:roles,id',
            'level_id'       => 'nullable|exists:levels,id',
            'department_id'  => 'nullable|exists:departments,id',
            'programme_id'   => 'nullable|exists:programmes,id',
            'region_id'      => 'nullable|exists:regions,id',
            'year_of_study'  => 'nullable|integer|min:1|max:4',
            'phone'          => 'nullable|string|max:20',
            'is_active'      => 'required|in:0,1',
        ]);

        $member->update($validated);

        return redirect()->route('religious_admin.members.index')
            ->with('success', "Member <strong>{$member->name}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(User $member)
    {
        $this->authorizeMember($member);

        if ($member->id === Auth::id()) {
            return redirect()->route('religious_admin.members.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $name = $member->name;
        $member->delete();

        return redirect()->route('religious_admin.members.index')
            ->with('success', "Member <strong>{$name}</strong> removed.");
    }

    // ─── TOGGLE STATUS ────────────────────────────────────────────────────────
    public function toggleStatus(User $member)
    {
        $this->authorizeMember($member);
        $member->update(['is_active' => !$member->is_active]);
        $status = $member->is_active ? 'activated' : 'deactivated';

        return redirect()->route('religious_admin.members.index')
            ->with('success', "Member <strong>{$member->name}</strong> {$status}.");
    }

    // ─── RESET PASSWORD ───────────────────────────────────────────────────────
    public function resetPassword(User $member)
    {
        $this->authorizeMember($member);
        $member->update([
            'password'         => Hash::make('must123'),
            'password_changed' => false,
        ]);

        return redirect()->route('religious_admin.members.index')
            ->with('success', "Password for <strong>{$member->name}</strong> reset to <strong>must123</strong>.");
    }

    // ─── Authorize ────────────────────────────────────────────────────────────
    private function authorizeMember(User $member): void
    {
        if ($member->religion_id !== $this->getReligionId()) {
            abort(403, 'This member does not belong to your religion.');
        }
    }
}