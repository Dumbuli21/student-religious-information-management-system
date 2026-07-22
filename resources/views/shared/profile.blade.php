<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – SRIMS</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .info-label { font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; color:#6c757d; margin-bottom:2px; }
        .avatar-xl { width:90px; height:90px; border-radius:50%; display:flex; align-items:center;
                     justify-content:center; font-weight:700; font-size:2rem; color:white; flex-shrink:0; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    {{-- ✅ NEW — use a match/switch to be safe --}}
@php
    $sidebarMap = [
        'super_admin'     => 'includes.super_admin_sidebar',
        'religious_admin' => 'includes.religious_admin_sidebar',
        'sub_admin'       => 'includes.sub_admin_sidebar',
        'student'         => 'includes.student_sidebar',
    ];
    $sidebarView = $sidebarMap[Auth::user()->role?->name] ?? 'includes.student_sidebar';
@endphp
@include($sidebarView)

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">My Profile</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container" style="max-width:800px">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Profile Header Card --}}
                <div class="card mb-4"
                     style="background:linear-gradient(135deg,#1a3c5e,#2d6a9f);color:white;border-radius:16px;">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div class="avatar-xl"
                                 style="background:{{ $user->gender === 'female' ? '#e91e8c' : 'rgba(255,255,255,.2)' }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="mb-0 fw-bold">{{ $user->name }}</h4>
                                <p class="mb-1 opacity-75">{{ $user->email }}</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-white text-primary">
                                        <i class="bi bi-shield me-1"></i>
                                        {{ ucwords(str_replace('_',' ',$user->role?->name)) }}
                                    </span>
                                    @if($religion)
                                    <span class="badge" style="background:rgba(255,255,255,.2)">
                                        <i class="bi bi-book me-1"></i>{{ $religion->name }}
                                    </span>
                                    @endif
                                    @if(!$user->password_changed)
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Default password in use
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    {{-- Academic / Role Info --}}
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-person-badge me-2 text-primary"></i>Account Information
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="info-label">Student / Staff Number</div>
                                        <code class="fs-6">{{ $user->student_number }}</code>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-label">Role</div>
                                        <div>{{ ucwords(str_replace('_',' ',$user->role?->name ?? '–')) }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-label">Status</div>
                                        @if($user->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </div>
                                    @if($user->level)
                                    <div class="col-6">
                                        <div class="info-label">Level</div>
                                        <div>{{ $user->level->name }}</div>
                                    </div>
                                    @endif
                                    @if($user->year_of_study)
                                    <div class="col-6">
                                        <div class="info-label">Year of Study</div>
                                        <div>Year {{ $user->year_of_study }}</div>
                                    </div>
                                    @endif
                                    @if($user->department)
                                    <div class="col-12">
                                        <div class="info-label">Department</div>
                                        <div>{{ $user->department->name }}</div>
                                    </div>
                                    @endif
                                    @if($user->programme)
                                    <div class="col-12">
                                        <div class="info-label">Programme</div>
                                        <div>{{ $user->programme->name }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Info --}}
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-person me-2 text-success"></i>Personal Information
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="info-label">Gender</div>
                                        <div>{{ ucfirst($user->gender ?? '–') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-label">Religion</div>
                                        <div>{{ $religion?->name ?? '–' }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-label">Region</div>
                                        <div>{{ $user->region?->name ?? '–' }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-label">Phone</div>
                                        <div>{{ $user->phone ?? '–' }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-label">Member Since</div>
                                        <div>{{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-label">Password Changed</div>
                                        @if($user->password_changed)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Not yet</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Editable Fields --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header fw-semibold">
                                <i class="bi bi-pencil me-2 text-warning"></i>Update Contact Info
                            </div>
                            <div class="card-body">
                                <form method="POST"
                                      action="{{ route(Auth::user()->role?->name . '.profile.update') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Phone Number</label>
                                            <input type="text" name="phone" class="form-control"
                                                   value="{{ old('phone', $user->phone) }}"
                                                   placeholder="07xxxxxxxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">Region</label>
                                            <select name="region_id" class="form-select">
                                                <option value="">-- Select Region --</option>
                                                @foreach($regions as $region)
                                                    <option value="{{ $region->id }}"
                                                        {{ old('region_id', $user->region_id) == $region->id ? 'selected' : '' }}>
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary fw-semibold">
                                                <i class="bi bi-save me-2"></i>Save Changes
                                            </button>
                                            <a href="{{ route(Auth::user()->role?->name . '.password.form') }}"
                                               class="btn btn-outline-warning ms-2">
                                                <i class="bi bi-key me-2"></i>Change Password
                                            </a>
                                        </div>
                                    </div>
                                </form>
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
            OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
        }
    });
</script>
</body>
</html>