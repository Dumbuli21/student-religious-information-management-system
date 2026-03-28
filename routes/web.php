<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SuperAdmin\DashboardController    as SuperAdminDashboard;
use App\Http\Controllers\ReligiousAdmin\DashboardController as ReligiousAdminDashboard;
use App\Http\Controllers\SubAdmin\DashboardController      as SubAdminDashboard;
use App\Http\Controllers\Student\DashboardController       as StudentDashboard;

// ── Guest only ────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/',       [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login',  [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// ── Temp register (delete when done) ─────────────────────────────────────────
Route::get('/register',  [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// ── Authenticated ─────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/change-password',  [ChangePasswordController::class, 'showChangeForm'])->name('password.change.form');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.change');

    // Dashboards — only Laravel built-in 'auth' middleware, role checked inside controller
    Route::get('/super-admin/dashboard',    [SuperAdminDashboard::class,    'index'])->name('super_admin.dashboard');
    Route::get('/religious-admin/dashboard',[ReligiousAdminDashboard::class,'index'])->name('religious_admin.dashboard');
    Route::get('/sub-admin/dashboard',      [SubAdminDashboard::class,      'index'])->name('sub_admin.dashboard');
    Route::get('/student/dashboard',        [StudentDashboard::class,       'index'])->name('student.dashboard');

});