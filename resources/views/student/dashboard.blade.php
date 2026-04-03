<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS | Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex;
                     align-items:center; justify-content:center; font-size:1.3rem; color:white; }
        .avatar-lg { width:64px; height:64px; border-radius:50%; display:flex;
                     align-items:center; justify-content:center; font-weight:700;
                     font-size:1.6rem; color:white; flex-shrink:0; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.student_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Dashboard
                            <span class="badge text-bg-primary" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">Student</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-1"></i> {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-x-circle me-1"></i> {!! session('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Student Profile Card --}}
                <div class="card mb-4"
                     style="border:none;border-radius:16px;background:linear-gradient(135deg,#1a3c5e,#2d6a9f);color:white;">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div class="avatar-lg"
                                 style="background:{{ $user->gender === 'female' ? '#e91e8c' : 'rgba(255,255,255,.2)' }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="mb-0 fw-bold">{{ $user->name }}</h4>
                                <p class="mb-1 opacity-75 small">{{ $user->email }}</p>
                                <div class="d-flex gap-2 flex-wrap mt-1">
                                    <span class="badge bg-white text-primary">
                                        <i class="bi bi-mortarboard me-1"></i>
                                        {{ $user->academicInfo() }}
                                    </span>
                                    @if($religion)
                                        <span class="badge" style="background:rgba(255,255,255,.2)">
                                            <i class="bi bi-book me-1"></i>
                                            {{ $religion->name }}
                                        </span>
                                    @endif
                                    @if($user->region)
                                        <span class="badge" style="background:rgba(255,255,255,.2)">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $user->region->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex gap-4 text-center">
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['my_registrations'] }}</div>
                                    <small class="opacity-75">My Events</small>
                                </div>
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['upcoming_events'] }}</div>
                                    <small class="opacity-75">Upcoming</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#0d6efd;">
                                    <i class="bi bi-megaphone-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['announcements'] }}</div>
                                    <small class="text-muted">Announcements</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#198754;">
                                    <i class="bi bi-calendar-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['events'] }}</div>
                                    <small class="text-muted">Total Events</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#ffc107;">
                                    <i class="bi bi-calendar2-event"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['upcoming_events'] }}</div>
                                    <small class="text-muted">Upcoming</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#6f42c1;">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['my_registrations'] }}</div>
                                    <small class="text-muted">Registered</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    {{-- Recent Announcements --}}
                    <div class="col-lg-6">
                        <div class="card h-100"
                             style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center"
                                 style="border-radius:12px 12px 0 0;">
                                <span>
                                    <i class="bi bi-megaphone me-2 text-primary"></i>
                                    Recent Announcements
                                </span>
                                <a href="{{ route('student.announcements.index') }}"
                                   class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($recent_announcements as $ann)
                                        <li class="list-group-item py-3">
                                            <a href="{{ route('student.announcements.show', $ann) }}"
                                               class="text-decoration-none">
                                                <div class="fw-semibold text-dark">{{ $ann->title }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $ann->published_at?->diffForHumans() ?? $ann->created_at->diffForHumans() }}
                                                </small>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted py-4">
                                            <i class="bi bi-megaphone fs-3 d-block mb-2 opacity-25"></i>
                                            No announcements yet.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Upcoming Events --}}
                    <div class="col-lg-6">
                        <div class="card h-100"
                             style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center"
                                 style="border-radius:12px 12px 0 0;">
                                <span>
                                    <i class="bi bi-calendar-event me-2 text-success"></i>
                                    Upcoming Events
                                </span>
                                <a href="{{ route('student.events.index') }}"
                                   class="btn btn-sm btn-outline-success">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($upcoming_events as $event)
                                        <li class="list-group-item py-3">
                                            <a href="{{ route('student.events.show', $event) }}"
                                               class="text-decoration-none">
                                                <div class="fw-semibold text-dark">{{ $event->title }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt me-1"></i>
                                                    {{ $event->location ?? 'TBD' }}
                                                    &nbsp;|&nbsp;
                                                    <i class="bi bi-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                                </small>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted py-4">
                                            <i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-25"></i>
                                            No upcoming events.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- My Registered Events --}}
                    @if($my_events->count() > 0)
                    <div class="col-12">
                        <div class="card"
                             style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center"
                                 style="border-radius:12px 12px 0 0;">
                                <span>
                                    <i class="bi bi-check2-circle me-2 text-purple"></i>
                                    My Registered Events
                                </span>
                                <a href="{{ route('student.events.index') }}"
                                   class="btn btn-sm btn-outline-secondary">View All Events</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">Event</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Registered At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($my_events as $event)
                                            @php
                                                $sc = [
                                                    'upcoming'  => 'primary',
                                                    'ongoing'   => 'success',
                                                    'completed' => 'secondary',
                                                    'cancelled' => 'danger',
                                                ][$event->status] ?? 'secondary';
                                            @endphp
                                            <tr>
                                                <td class="ps-3">
                                                    <a href="{{ route('student.events.show', $event) }}"
                                                       class="fw-semibold text-decoration-none">
                                                        {{ $event->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <small>
                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $event->location ?? 'TBD' }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $sc }}">
                                                        {{ ucfirst($event->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $event->registrations->first()?->registered_at
                                                            ? \Carbon\Carbon::parse($event->registrations->first()->registered_at)->format('d M Y')
                                                            : '–' }}
                                                    </small>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sw = document.querySelector('.sidebar-wrapper');
        if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sw, {
                scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
            });
        }
    });
</script>
</body>
</html>