<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS | Sub Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex;
                     align-items:center; justify-content:center; font-size:1.3rem; color:white; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.sub_admin_sidebar')

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
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
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
                        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Religion Banner --}}
                <div class="card mb-4"
                     style="border:none;border-radius:16px;background:linear-gradient(135deg,#1a3c5e,#2d6a9f);color:white;">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            @if($religion->logo)
                                <img src="{{ asset('storage/' . $religion->logo) }}"
                                     style="width:64px;height:64px;object-fit:contain;
                                            border-radius:12px;background:rgba(255,255,255,.15);padding:8px;">
                            @else
                                <div style="width:64px;height:64px;border-radius:12px;
                                            background:rgba(255,255,255,.15);display:flex;
                                            align-items:center;justify-content:center;font-size:1.8rem;">
                                    <i class="bi bi-book"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h4 class="mb-0 fw-bold">{{ $religion->name }}</h4>
                                <p class="mb-1 opacity-75 small">
                                    {{ $religion->description ?? 'No description available.' }}
                                </p>
                                <span class="badge bg-white text-primary small">Sub Admin Panel</span>
                            </div>
                            <div class="d-flex gap-4 text-center">
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['members'] }}</div>
                                    <small class="opacity-75">Members</small>
                                </div>
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['events'] }}</div>
                                    <small class="opacity-75">Events</small>
                                </div>
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['announcements'] }}</div>
                                    <small class="opacity-75">Announcements</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#198754;">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['events'] }}</div>
                                    <small class="text-muted">Total Events</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#ffc107;">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['members'] }}</div>
                                    <small class="text-muted">Members</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="card p-3" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#dc3545;">
                                    <i class="bi bi-calendar2-event"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['upcoming'] }}</div>
                                    <small class="text-muted">Upcoming Events</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Row --}}
                <div class="row g-3">
                    {{-- Recent Announcements --}}
                    <div class="col-lg-6">
                        <div class="card h-100" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center"
                                 style="border-radius:12px 12px 0 0;">
                                <span>
                                    <i class="bi bi-megaphone me-2 text-primary"></i>Recent Announcements
                                </span>
                                <a href="{{ route('sub_admin.announcements.index') }}"
                                   class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($recent_announcements as $ann)
                                        <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                            <div>
                                                <div class="fw-semibold">{{ $ann->title }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $ann->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            @if($ann->is_published)
                                                <span class="badge text-bg-success">Published</span>
                                            @else
                                                <span class="badge text-bg-secondary">Draft</span>
                                            @endif
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
                        <div class="card h-100" style="border:none;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.07);">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center"
                                 style="border-radius:12px 12px 0 0;">
                                <span>
                                    <i class="bi bi-calendar-event me-2 text-success"></i>Upcoming Events
                                </span>
                                <a href="{{ route('sub_admin.events.index') }}"
                                   class="btn btn-sm btn-outline-success">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($upcoming_events as $event)
                                        <li class="list-group-item py-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <div class="fw-semibold">{{ $event->title }}</div>
                                                    <small class="text-muted">
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{ $event->location ?? 'TBD' }}
                                                        &nbsp;|&nbsp;
                                                        <i class="bi bi-calendar me-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                                    </small>
                                                </div>
                                                <span class="badge text-bg-primary">Upcoming</span>
                                            </div>
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