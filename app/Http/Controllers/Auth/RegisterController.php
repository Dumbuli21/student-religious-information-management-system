<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Level;
use App\Models\Programme;
use App\Models\Region;        // ✅ NEW
use App\Models\Religion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showForm()
    {
        $roles      = Role::all();
        $religions  = Religion::where('status', 'active')->get();
        $levels     = Level::all();
        $departments = Department::all();
        $programmes = Programme::all();
        $regions    = Region::orderBy('name')->get(); // ✅ NEW

        $users = User::with([
            'role',
            'religion',
            'region',       // ✅ NEW
            'level',
            'department',
            'programme',
        ])->latest()->get();

        return view('auth.register', compact(
            'roles',
            'religions',
            'levels',
            'departments',
            'programmes',
            'regions',      // ✅ NEW
            'users'
        ));
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'student_number'   => 'required|string|unique:users,student_number',
            'gender'           => 'required|in:male,female',
            'role_id'          => 'required|exists:roles,id',
            'religion_id'      => 'nullable|exists:religions,id',
            'region_id'        => 'nullable|exists:regions,id',  // ✅ was 'region' string
            'level_id'         => 'nullable|exists:levels,id',
            'department_id'    => 'nullable|exists:departments,id',
            'programme_id'     => 'nullable|exists:programmes,id',
            'year_of_study'    => 'nullable|integer|min:1|max:4',
            'phone'            => 'nullable|string|max:20',
            'password_changed' => 'required|in:0,1',
        ]);

        $user = User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'student_number'   => $request->student_number,
            'gender'           => $request->gender,
            'role_id'          => $request->role_id,
            'religion_id'      => $request->religion_id ?: null,
            'region_id'        => $request->region_id ?: null,   // ✅ was 'region' string
            'level_id'         => $request->level_id ?: null,
            'department_id'    => $request->department_id ?: null,
            'programme_id'     => $request->programme_id ?: null,
            'year_of_study'    => $request->year_of_study,
            'phone'            => $request->phone,
            'password'         => Hash::make('must123'),
            'is_active'        => true,
            'password_changed' => $request->password_changed,
            'created_by'       => auth()->id() ?? null,
        ]);

        return redirect()->route('register')
            ->with('success', "User '{$user->name}' has been successfully created!<br>
                               Login ID: <strong>{$user->student_number}</strong><br>
                               Default Password: <strong>must123</strong>");
    }
}