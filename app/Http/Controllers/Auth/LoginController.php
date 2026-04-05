<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Already logged in — just send to dashboard, nothing else
        if (Auth::check()) {
            $user = Auth::user();

            // Don't redirect to change-password from here
            // Just send to dashboard directly
            return redirect()->route($user->dashboardRoute());
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'student_number' => ['required', 'string'],
            'password'       => ['required', 'string'],
        ]);

        $credentials = [
            'student_number' => $request->student_number,
            'password'       => $request->password,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'student_number' => 'The provided credentials do not match our records.',
            ]);
        }

        $user = Auth::user();

        // Check if account is active
        if (!$user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'student_number' => 'Your account has been deactivated. Please contact the administrator.',
            ]);
        }

        $this->logActivity($user, 'login', 'User logged in');

        $request->session()->regenerate();

        // Check password changed ONLY here after successful login
       // ✅ NEW — redirect to role-specific password change route
    if (!$user->password_changed) {
    $roleName = $user->role?->name;

    $passwordRoutes = [
        'super_admin'     => 'super_admin.password.form',
        'religious_admin' => 'religious_admin.password.form',
        'sub_admin'       => 'sub_admin.password.form',
        'student'         => 'student.password.form',
    ];

    $route = $passwordRoutes[$roleName] ?? null;

    if ($route && \Illuminate\Support\Facades\Route::has($route)) {
        return redirect()->route($route)
            ->with('info', 'You must change your default password before continuing.');
    }
}

return redirect()->route($user->dashboardRoute());

        return redirect()->route($user->dashboardRoute());
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $this->logActivity(Auth::user(), 'logout', 'User logged out');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    private function logActivity($user, string $action, string $description): void
    {
        try {
            ActivityLog::create([
                'user_id'      => $user->id,
                'action'       => $action,
                'subject_type' => 'User',
                'subject_id'   => $user->id,
                'properties'   => json_encode([
                    'ip'         => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'note'       => $description,
                ]),
            ]);
        } catch (\Exception $e) {
            // silent fail
        }
    }
}