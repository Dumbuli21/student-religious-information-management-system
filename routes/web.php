<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SuperAdmin\DashboardController    as SuperAdminDashboard;
use App\Http\Controllers\ReligiousAdmin\DashboardController as ReligiousAdminDashboard;
use App\Http\Controllers\SubAdmin\DashboardController      as SubAdminDashboard;
use App\Http\Controllers\Student\DashboardController       as StudentDashboard;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\ReligionController;
use App\Http\Controllers\SuperAdmin\DepartmentController;
use App\Http\Controllers\SuperAdmin\ProgrammeController;
use App\Http\Controllers\ReligiousAdmin\AnnouncementController;
use App\Http\Controllers\ReligiousAdmin\EventController;
use App\Http\Controllers\ReligiousAdmin\MemberController;
use App\Http\Controllers\ReligiousAdmin\FeedbackController;




// ── Guest only ────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/',       [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login',  [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// ── Temp register ─────────────────────────────────────────────────────────────
Route::get('/register',  [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// ── Authenticated ─────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/change-password',  [ChangePasswordController::class, 'showChangeForm'])->name('password.change.form');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.change');

    // ── Dashboards ────────────────────────────────────────────────────────────
    Route::get('/super-admin/dashboard',     [SuperAdminDashboard::class,     'index'])->name('super_admin.dashboard');
    Route::get('/religious-admin/dashboard', [ReligiousAdminDashboard::class, 'index'])->name('religious_admin.dashboard');
    Route::get('/sub-admin/dashboard',       [SubAdminDashboard::class,       'index'])->name('sub_admin.dashboard');
    Route::get('/student/dashboard',         [StudentDashboard::class,        'index'])->name('student.dashboard');

    // ── Super Admin ───────────────────────────────────────────────────────────
    Route::prefix('super-admin')->name('super_admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['create', 'edit']);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])
             ->name('users.reset-password');

    Route::resource('religions', ReligionController::class)->except(['create', 'edit']);
    Route::post('religions/{religion}/toggle-status', [ReligionController::class, 'toggleStatus'])
         ->name('religions.toggle-status');

    Route::resource('departments', DepartmentController::class)->except(['create', 'edit']);
    Route::resource('programmes',  ProgrammeController::class)->except(['create', 'edit']);

    });




// ── Religious Admin ───────────────────────────────────────────────
Route::prefix('religious-admin')->name('religious_admin.')->group(function () {

    Route::resource('announcements', AnnouncementController::class)->except(['create', 'edit']);
    Route::post('announcements/{announcement}/toggle-publish', [AnnouncementController::class, 'togglePublish'])
         ->name('announcements.toggle-publish');

    Route::resource('events', EventController::class)->except(['create', 'edit']);
    Route::post('events/{event}/toggle-status', [EventController::class, 'toggleStatus'])
         ->name('events.toggle-status');


     Route::resource('members',  MemberController::class)->except(['create', 'edit']);
    Route::post('members/{user}/toggle-status', [MemberController::class, 'toggleStatus'])
         ->name('members.toggle-status');
    Route::post('members/{user}/reset-password', [MemberController::class, 'resetPassword'])
         ->name('members.reset-password');

    Route::resource('feedback', FeedbackController::class)->except(['create', 'edit', 'update']);
    Route::post('feedback/{feedback}/update-status', [FeedbackController::class, 'updateStatus'])
         ->name('feedback.update-status');

});

    

// inside Route::prefix('religious-admin')->name('religious_admin.')->group(function () {

   

    
});