<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * Call this at the top of any dashboard method.
     * e.g.  $this->requireRole('super_admin');
     */
    protected function requireRole(string $role): void
    {
        if (!Auth::check()) {
            abort(redirect()->route('login'));
        }

        if (Auth::user()->role?->name !== $role) {
            abort(403, 'You do not have permission to access this page.');
        }
    }

    /**
     * Ensure password has been changed — call in any protected method.
     */
    protected function requirePasswordChanged(): void
    {
        if (Auth::check() && !Auth::user()->password_changed) {
            abort(redirect()->route('password.change.form'));
        }
    }
}