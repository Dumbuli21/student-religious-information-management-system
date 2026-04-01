<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $programmes  = Programme::with('department')
                                ->withCount('users')
                                ->latest()
                                ->paginate(10);

        $departments = Department::orderBy('name')->get();

        return view('super_admin.management.programmes', compact('programmes', 'departments'));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Programme::create($validated);

        return redirect()->route('super_admin.programmes.index')
            ->with('success', "Programme <strong>{$validated['name']}</strong> created successfully.");
    }

    // ─── SHOW (JSON for modal) ────────────────────────────────────────────────
    public function show(Programme $programme)
    {
        $programme->load('department')->loadCount('users');

        return response()->json([
            'id'              => $programme->id,
            'name'            => $programme->name,
            'department_id'   => $programme->department_id,
            'department_name' => $programme->department?->name,
            'users_count'     => $programme->users_count,
            'created_at'      => $programme->created_at->format('d M Y, h:i A'),
            'updated_at'      => $programme->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, Programme $programme)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $programme->update($validated);

        return redirect()->route('super_admin.programmes.index')
            ->with('success', "Programme <strong>{$programme->name}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(Programme $programme)
    {
        if ($programme->users()->count() > 0) {
            return redirect()->route('super_admin.programmes.index')
                ->with('error', "Cannot delete <strong>{$programme->name}</strong> — it has assigned users.");
        }

        $name = $programme->name;
        $programme->delete();

        return redirect()->route('super_admin.programmes.index')
            ->with('success', "Programme <strong>{$name}</strong> deleted successfully.");
    }
}