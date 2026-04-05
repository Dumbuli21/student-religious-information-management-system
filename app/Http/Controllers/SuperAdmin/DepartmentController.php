<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount(['programmes', 'users'])
                                 ->latest()
                                 ->paginate(10);

        return view('super_admin.management.department', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create($validated);

        return redirect()->route('super_admin.management.departments.index')
            ->with('success', "Department <strong>{$validated['name']}</strong> created successfully.");
    }

    public function show(Department $department)
    {
        $department->loadCount(['programmes', 'users']);

        return response()->json([
            'id'               => $department->id,
            'name'             => $department->name,
            'programmes_count' => $department->programmes_count,
            'users_count'      => $department->users_count,
            'created_at'       => $department->created_at->format('d M Y, h:i A'),
            'updated_at'       => $department->updated_at->format('d M Y, h:i A'),
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        $department->update($validated);

        return redirect()->route('super_admin.management.departments.index')
            ->with('success', "Department <strong>{$department->name}</strong> updated successfully.");
    }

    public function destroy(Department $department)
    {
        if ($department->users()->count() > 0) {
            return redirect()->route('super_admin.management.departments.index')
                ->with('error', "Cannot delete <strong>{$department->name}</strong> — it has assigned users.");
        }

        $name = $department->name;
        $department->delete();

        return redirect()->route('super_admin.management.departments.index')
            ->with('success', "Department <strong>{$name}</strong> deleted successfully.");
    }
}