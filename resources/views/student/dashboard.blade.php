<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SRIMS | Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')

    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="#" class="brand-link">
                <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="SRIMS" class="brand-image opacity-75 shadow" />
                <span class="brand-text fw-light">SRIMS</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
                    <li class="nav-header">STUDENT</li>
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-calendar-event"></i>
                            <p>Events</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-megaphone"></i>
                            <p>Announcements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-bell"></i>
                            <p>
                                Notifications
                                @if($unread_notifications > 0)
                                    <span class="nav-badge badge text-bg-danger">{{ $unread_notifications }}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-chat-left-text"></i>
                            <p>Feedback</p>
                        </a>
                    </li>
                    <li class="nav-header">ACCOUNT</li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Logout</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
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

                {{-- Welcome banner --}}
                <div class="callout callout-info mb-4">
                    <h5>Welcome back, {{ Auth::user()->name }}!</h5>
                    <p class="mb-0">
                        {{ Auth::user()->religion?->name ?? 'SRIMS' }} &nbsp;|&nbsp;
                        {{ Auth::user()->course ?? 'Student' }}
                        @if(Auth::user()->year_of_study)
                            &nbsp;– Year {{ Auth::user()->year_of_study }}
                        @endif
                    </p>
                </div>

                <div class="row g-3">
                    {{-- Upcoming Events --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-calendar-event me-2 text-primary"></i>Upcoming Events
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse ($upcoming_events as $event)
                                        <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                            <div>
                                                <div class="fw-semibold">{{ $event->title }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                                    &nbsp;|&nbsp;
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                                </small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Register</a>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted py-4">No upcoming events.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Latest Announcements --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-megaphone me-2 text-success"></i>Latest Announcements
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse ($latest_announcements as $ann)
                                        <li class="list-group-item py-3">
                                            <div class="fw-semibold">{{ $ann->title }}</div>
                                            <small class="text-muted">{{ $ann->published_at ? \Carbon\Carbon::parse($ann->published_at)->diffForHumans() : '' }}</small>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted py-4">No announcements yet.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- My Registrations --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-ticket-perforated me-2 text-warning"></i>My Event Registrations
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Event</th>
                                                <th>Registered At</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($my_registrations as $reg)
                                                <tr>
                                                    <td>{{ $reg->event?->title }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($reg->registered_at)->format('d M Y, H:i') }}</td>
                                                    <td>
                                                        @if(is_null($reg->attended))
                                                            <span class="badge text-bg-secondary">Pending</span>
                                                        @elseif($reg->attended)
                                                            <span class="badge text-bg-success">Attended</span>
                                                        @else
                                                            <span class="badge text-bg-danger">Absent</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="text-center text-muted py-4">No registrations yet.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
            });
        }
    });
</script>
</body>
</html>