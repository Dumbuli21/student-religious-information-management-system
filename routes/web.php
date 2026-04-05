<?php

use Illuminate\Support\Facades\Route;

// ── Auth Controllers ──────────────────────────────────────────────────────────
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ── Dashboard Controllers ─────────────────────────────────────────────────────
use App\Http\Controllers\SuperAdmin\DashboardController    as SuperAdminDashboard;
use App\Http\Controllers\ReligiousAdmin\DashboardController as ReligiousAdminDashboard;
use App\Http\Controllers\SubAdmin\DashboardController      as SubAdminDashboard;
use App\Http\Controllers\Student\DashboardController       as StudentDashboard;

// ── Super Admin Controllers ───────────────────────────────────────────────────
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\ReligionController;
use App\Http\Controllers\SuperAdmin\DepartmentController;
use App\Http\Controllers\SuperAdmin\ProgrammeController;
use App\Http\Controllers\SuperAdmin\ProfileController as SuperAdminProfileController;

// ── Religious Admin Controllers ───────────────────────────────────────────────
use App\Http\Controllers\ReligiousAdmin\AnnouncementController;
use App\Http\Controllers\ReligiousAdmin\EventController;
use App\Http\Controllers\ReligiousAdmin\MemberController;
use App\Http\Controllers\ReligiousAdmin\FeedbackController;
use App\Http\Controllers\ReligiousAdmin\ProfileController as ReligiousAdminProfileController;

// ── Sub Admin Controllers ─────────────────────────────────────────────────────
use App\Http\Controllers\SubAdmin\AnnouncementController as SubAdminAnnouncementController;
use App\Http\Controllers\SubAdmin\EventController        as SubAdminEventController;
use App\Http\Controllers\SubAdmin\ProfileController      as SubAdminProfileController;

// ── Student Controllers ───────────────────────────────────────────────────────
use App\Http\Controllers\Student\AnnouncementController as StudentAnnouncementController;
use App\Http\Controllers\Student\EventController        as StudentEventController;
use App\Http\Controllers\Student\FeedbackController     as StudentFeedbackController;
use App\Http\Controllers\Student\ProfileController      as StudentProfileController;


// ══════════════════════════════════════════════════════════════════════════════
//  GUEST ONLY
// ══════════════════════════════════════════════════════════════════════════════
Route::middleware('guest')->group(function () {
    Route::get('/',       [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login',  [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});


// ══════════════════════════════════════════════════════════════════════════════
//  TEMP REGISTER (remove before go-live)
// ══════════════════════════════════════════════════════════════════════════════
Route::get('/register',  [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');


// ══════════════════════════════════════════════════════════════════════════════
//  AUTHENTICATED
// ══════════════════════════════════════════════════════════════════════════════
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Session ping (keep alive)
    Route::post('/session/ping', function () {
        session(['last_activity_time' => time()]);
        return response()->json(['alive' => true]);
    })->name('session.ping');

    // ── Dashboards ────────────────────────────────────────────────────────────
    Route::get('/super-admin/dashboard',     [SuperAdminDashboard::class,     'index'])->name('super_admin.dashboard');
    Route::get('/religious-admin/dashboard', [ReligiousAdminDashboard::class, 'index'])->name('religious_admin.dashboard');
    Route::get('/sub-admin/dashboard',       [SubAdminDashboard::class,       'index'])->name('sub_admin.dashboard');
    Route::get('/student/dashboard',         [StudentDashboard::class,        'index'])->name('student.dashboard');


    // ══════════════════════════════════════════════════════════════════════════
    //  SUPER ADMIN
    // ══════════════════════════════════════════════════════════════════════════
    Route::prefix('super-admin')->name('super_admin.')->group(function () {

        // Profile & Password
        Route::get('profile',          [SuperAdminProfileController::class, 'show'])->name('profile');
        Route::post('profile',         [SuperAdminProfileController::class, 'update'])->name('profile.update');
        Route::get('change-password',  [SuperAdminProfileController::class, 'changePasswordForm'])->name('password.form');
        Route::post('change-password', [SuperAdminProfileController::class, 'changePassword'])->name('password.change');

        // Users
        Route::resource('users', UserController::class)->except(['create', 'edit']);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])
             ->name('users.reset-password');

        // Religions
        Route::resource('religions', ReligionController::class)->except(['create', 'edit']);
        Route::post('religions/{religion}/toggle-status', [ReligionController::class, 'toggleStatus'])
             ->name('religions.toggle-status');

        // Management
        Route::prefix('management')->name('management.')->group(function () {
            Route::resource('departments', DepartmentController::class)->except(['create', 'edit']);
            Route::resource('programmes',  ProgrammeController::class)->except(['create', 'edit']);
        });

    });


    // ══════════════════════════════════════════════════════════════════════════
    //  RELIGIOUS ADMIN
    // ══════════════════════════════════════════════════════════════════════════
    Route::prefix('religious-admin')->name('religious_admin.')->group(function () {

        // Profile & Password
        Route::get('profile',          [ReligiousAdminProfileController::class, 'show'])->name('profile');
        Route::post('profile',         [ReligiousAdminProfileController::class, 'update'])->name('profile.update');
        Route::get('change-password',  [ReligiousAdminProfileController::class, 'changePasswordForm'])->name('password.form');   // ✅ fixed
        Route::post('change-password', [ReligiousAdminProfileController::class, 'changePassword'])->name('password.change');     // ✅ fixed

        // Announcements
        Route::resource('announcements', AnnouncementController::class)->except(['create', 'edit']);
        Route::post('announcements/{announcement}/toggle-publish', [AnnouncementController::class, 'togglePublish'])
             ->name('announcements.toggle-publish');

        // Events
        Route::resource('events', EventController::class)->except(['create', 'edit']);
        Route::post('events/{event}/toggle-status', [EventController::class, 'toggleStatus'])
             ->name('events.toggle-status');

        // Members
        Route::resource('members', MemberController::class)->except(['create', 'edit']);
        Route::post('members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])
             ->name('members.toggle-status');
        Route::post('members/{member}/reset-password', [MemberController::class, 'resetPassword'])
             ->name('members.reset-password');

        // Feedback
        Route::resource('feedback', FeedbackController::class)->except(['create', 'edit', 'update']);
        Route::post('feedback/{feedback}/update-status', [FeedbackController::class, 'updateStatus'])
             ->name('feedback.update-status');

    });


    // ══════════════════════════════════════════════════════════════════════════
    //  SUB ADMIN
    // ══════════════════════════════════════════════════════════════════════════
    Route::prefix('sub-admin')->name('sub_admin.')->group(function () {

        // Profile & Password
        Route::get('profile',          [SubAdminProfileController::class, 'show'])->name('profile');
        Route::post('profile',         [SubAdminProfileController::class, 'update'])->name('profile.update');
        Route::get('change-password',  [SubAdminProfileController::class, 'changePasswordForm'])->name('password.form');
        Route::post('change-password', [SubAdminProfileController::class, 'changePassword'])->name('password.change');

        // Announcements
        Route::resource('announcements', SubAdminAnnouncementController::class)->except(['create', 'edit']);
        Route::post('announcements/{announcement}/toggle-publish', [SubAdminAnnouncementController::class, 'togglePublish'])
             ->name('announcements.toggle-publish');

        // Events
        Route::resource('events', SubAdminEventController::class)->except(['create', 'edit']);
        Route::post('events/{event}/toggle-status', [SubAdminEventController::class, 'toggleStatus'])
             ->name('events.toggle-status');

    });


    // ══════════════════════════════════════════════════════════════════════════
    //  STUDENT
    // ══════════════════════════════════════════════════════════════════════════
    Route::prefix('student')->name('student.')->group(function () {

        // Profile & Password
        Route::get('profile',          [StudentProfileController::class, 'show'])->name('profile');
        Route::post('profile',         [StudentProfileController::class, 'update'])->name('profile.update');
        Route::get('change-password',  [StudentProfileController::class, 'changePasswordForm'])->name('password.form');
        Route::post('change-password', [StudentProfileController::class, 'changePassword'])->name('password.change');

        // Announcements (read only)
        Route::get('announcements',               [StudentAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('announcements/{announcement}', [StudentAnnouncementController::class, 'show'])->name('announcements.show');

        // Events
        Route::get('events',                      [StudentEventController::class, 'index'])->name('events.index');
        Route::get('events/{event}',              [StudentEventController::class, 'show'])->name('events.show');
        Route::post('events/{event}/register',    [StudentEventController::class, 'register'])->name('events.register');
        Route::post('events/{event}/unregister',  [StudentEventController::class, 'unregister'])->name('events.unregister');

        // Feedback
        Route::get('feedback',                [StudentFeedbackController::class, 'index'])->name('feedback.index');
        Route::post('feedback',               [StudentFeedbackController::class, 'store'])->name('feedback.store');
        Route::delete('feedback/{feedback}',  [StudentFeedbackController::class, 'destroy'])->name('feedback.destroy');

    });

});