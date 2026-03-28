<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS – @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            color: white;
        }
        .sidebar .brand { padding: 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .65rem 1.25rem;
            border-radius: 8px;
            margin: 2px 8px;
            transition: all .2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,.15);
            color: white;
        }
        .sidebar .nav-link i { width: 22px; }
        .main-content { margin-left: 250px; }
        .topbar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: .75rem 1.5rem;
            position: sticky; top: 0; z-index: 99;
        }
        .content-area { padding: 1.75rem; }
        .badge-role { font-size: .7rem; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .3s; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <nav class="sidebar d-flex flex-column">
        <div class="brand">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-shield-fill-check fs-4"></i>
                <div>
                    <div class="fw-bold">SRIMS</div>
                    <small class="opacity-75" style="font-size:.72rem">Management System</small>
                </div>
            </div>
        </div>

        <div class="p-3">
            <small class="text-uppercase opacity-50 fw-bold" style="font-size:.68rem; letter-spacing:1px">
                @yield('sidebar-section', 'Navigation')
            </small>
        </div>

        <ul class="nav flex-column px-1">
            @yield('sidebar-links')
        </ul>

        {{-- User info at bottom --}}
        <div class="mt-auto p-3 border-top" style="border-color: rgba(255,255,255,.15) !important;">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                     style="width:38px;height:38px;min-width:38px">
                    <i class="bi bi-person"></i>
                </div>
                <div style="min-width:0">
                    <div class="fw-semibold text-truncate" style="font-size:.88rem">{{ Auth::user()->name }}</div>
                    <small class="opacity-75" style="font-size:.72rem">{{ Auth::user()->student_number }}</small>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <div class="main-content">
        {{-- Topbar --}}
        <div class="topbar d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h6 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h6>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-primary badge-role">
                    {{ ucwords(str_replace('_', ' ', Auth::user()->role?->name)) }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Flash messages --}}
        <div class="content-area pb-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-x-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        {{-- Page content --}}
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('open');
        });
    </script>
    @stack('scripts')
</body>
</html>