<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReligionController extends Controller
{
    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $religions = Religion::withCount('users')->latest()->paginate(10);

        return view('super_admin.religions', compact('religions'));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:religions,name',
            'description' => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('religions/logos', 'public');
        }

        Religion::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'logo'        => $logoPath,
            'status'      => $validated['status'],
        ]);

        return redirect()->route('super_admin.religions.index')
            ->with('success', "Religion <strong>{$validated['name']}</strong> created successfully.");
    }

    // ─── SHOW (JSON for modal) ────────────────────────────────────────────────
    public function show(Religion $religion)
    {
        $religion->loadCount('users');

        return response()->json([
            'id'          => $religion->id,
            'name'        => $religion->name,
            'description' => $religion->description,
            'logo'        => $religion->logo ? asset('storage/' . $religion->logo) : null,
            'status'      => $religion->status,
            'users_count' => $religion->users_count,
            'created_at'  => $religion->created_at->format('d M Y, h:i A'),
            'updated_at'  => $religion->updated_at->format('d M Y, h:i A'),
        ]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, Religion $religion)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:religions,name,' . $religion->id,
            'description' => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($religion->logo) {
                Storage::disk('public')->delete($religion->logo);
            }
            $validated['logo'] = $request->file('logo')->store('religions/logos', 'public');
        }

        $religion->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'logo'        => $validated['logo'] ?? $religion->logo,
            'status'      => $validated['status'],
        ]);

        return redirect()->route('super_admin.religions.index')
            ->with('success', "Religion <strong>{$religion->name}</strong> updated successfully.");
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(Religion $religion)
    {
        // Prevent deleting if users are assigned
        if ($religion->users()->count() > 0) {
            return redirect()->route('super_admin.religions.index')
                ->with('error', "Cannot delete <strong>{$religion->name}</strong> — it has assigned users.");
        }

        if ($religion->logo) {
            Storage::disk('public')->delete($religion->logo);
        }

        $name = $religion->name;
        $religion->delete();

        return redirect()->route('super_admin.religions.index')
            ->with('success', "Religion <strong>{$name}</strong> has been deleted.");
    }

    // ─── TOGGLE STATUS ────────────────────────────────────────────────────────
    public function toggleStatus(Religion $religion)
    {
        $religion->update([
            'status' => $religion->status === 'active' ? 'inactive' : 'active',
        ]);

        return redirect()->route('super_admin.religions.index')
            ->with('success', "Religion <strong>{$religion->name}</strong> status updated.");
    }
}