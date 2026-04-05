<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SRIMS | Super Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <style>
        .avatar-sm {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .85rem; color: white; flex-shrink: 0;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.07);
        }
        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,.08);
            border-radius: 12px 12px 0 0 !important;
        }
        .stat-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.07);
            position: relative;
            display: block;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .stat-box:hover {
            transform: translateY(-5px);
        }
        .stat-box .inner {
            padding: 20px;
        }
        .stat-box h3 {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 0 0 5px 0;
            white-space: nowrap;
            padding: 0;
            color: #1a3c5e;
        }
        .stat-box p {
            font-size: 1rem;
            margin: 0;
            color: #6c757d;
        }
        .stat-box .stat-icon {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .stat-box .stat-footer {
            display: block;
            padding: 8px 0;
            text-align: center;
            background: #f8f9fa;
            border-radius: 0 0 12px 12px;
            transition: background 0.3s ease;
            color: #1a3c5e;
            text-decoration: none;
        }
        .stat-box .stat-footer:hover {
            background: #e9ecef;
            color: #0d6efd;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')

    @include('includes.super_admin_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0 d-flex align-items-center gap-2">
                            Dashboard
                            <span class="badge text-bg-primary" style="font-size:.7rem;font-weight:500;">
                                Super Admin
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">Super Admin</li>
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

                {{-- Stats Boxes --}}
                <div class="row g-3 mb-4">
                    <div class="col-lg-3 col-6">
                        <div class="stat-box">
                            <div class="inner">
                                <h3>{{ $stats['total_users'] }}</h3>
                                <p>Total Users</p>
                            </div>
                            <i class="stat-icon bi bi-people-fill" style="color: #0d6efd;"></i>
                            <a href="{{ route('super_admin.users.index') }}" class="stat-footer">
                                More info <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-box">
                            <div class="inner">
                                <h3>{{ $stats['total_religions'] }}</h3>
                                <p>Religions</p>
                            </div>
                            <i class="stat-icon bi bi-globe2" style="color: #198754;"></i>
                            <a href="{{ route('super_admin.religions.index') }}" class="stat-footer">
                                More info <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-box">
                            <div class="inner">
                                <h3>{{ $stats['total_events'] }}</h3>
                                <p>Total Events</p>
                            </div>
                            <i class="stat-icon bi bi-calendar-event" style="color: #ffc107;"></i>
                            <a href="#" class="stat-footer">
                                More info <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-box">
                            <div class="inner">
                                <h3>{{ $stats['total_announcements'] }}</h3>
                                <p>Announcements</p>
                            </div>
                            <i class="stat-icon bi bi-megaphone" style="color: #dc3545;"></i>
                            <a href="#" class="stat-footer">
                                More info <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Recent Users Table --}}
                <div class="card">
                    <div class="card-header fw-semibold d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-people me-2 text-primary"></i>Recent Users</span>
                        <a href="{{ route('super_admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Name</th>
                                        <th>Student No.</th>
                                        <th>Role</th>
                                        <th>Religion</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recent_users as $index => $u)
                                        <tr>
                                            <td class="ps-3 text-muted small">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar-sm" style="background:{{ $u->gender === 'female' ? '#e91e8c' : '#1a3c5e' }}">
                                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $u->name }}</div>
                                                        <small class="text-muted">{{ $u->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><code>{{ $u->student_number }}</code></td>
                                            <td>
                                                @php
                                                    $roleColors = [
                                                        'super_admin'     => 'danger',
                                                        'religious_admin' => 'warning',
                                                        'sub_admin'       => 'info',
                                                        'student'         => 'primary',
                                                    ];
                                                    $rc = $roleColors[$u->role?->name] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $rc }} bg-opacity-10 text-{{ $rc }}" style="font-size:.75rem">
                                                    {{ ucwords(str_replace('_', ' ', $u->role?->name ?? '–')) }}
                                                </span>
                                            </td>
                                            <td>{{ $u->religion?->name ?? '–' }}</td>
                                            <td>
                                                @if($u->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-people fs-2 d-block mb-2 opacity-25"></i>
                                                No users found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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