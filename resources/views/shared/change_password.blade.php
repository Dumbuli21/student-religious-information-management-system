<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password – SRIMS</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .strength-bar { height:6px; border-radius:3px; transition:.3s; width:0; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
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
                    <div class="col-sm-6"><h3 class="mb-0">Change Password</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route(Auth::user()->role?->name . '.profile') }}">Profile</a>
                            </li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(!$user->password_changed)
                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        You are using the default password <strong>must123</strong>.
                        Please change it now for your account security.
                    </div>
                @endif

                <div class="card">
                    <div class="card-header fw-semibold"
                         style="background:linear-gradient(135deg,#1a3c5e,#2d6a9f);color:white;border-radius:12px 12px 0 0;">
                        <i class="bi bi-key me-2"></i>Change Your Password
                    </div>
                    <div class="card-body p-4">
                        <form method="POST"
                              action="{{ route(Auth::user()->role?->name . '.password.change') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold small">
                                        Current Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" id="current_password"
                                               class="form-control @error('current_password') is-invalid @enderror"
                                               placeholder="Enter current password">
                                        <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePwd('current_password', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold small">
                                        New Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="new_password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Minimum 8 characters"
                                               oninput="checkStrength(this.value)">
                                        <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePwd('new_password', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <div class="bg-light rounded" style="height:6px;">
                                            <div class="strength-bar" id="strengthBar"></div>
                                        </div>
                                        <small id="strengthText" class="text-muted"></small>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label fw-semibold small">
                                        Confirm New Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                               class="form-control"
                                               placeholder="Repeat new password"
                                               oninput="checkMatch()">
                                        <button type="button" class="btn btn-outline-secondary"
                                                onclick="togglePwd('confirm_password', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <small id="matchText"></small>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary fw-semibold px-4" style="width: auto;">
                                            <i class="bi bi-shield-check me-2"></i>Change Password
                                        </button>
                                        <a href="{{ route(Auth::user()->role?->name . '.profile') }}"
                                           class="btn btn-outline-secondary">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
function togglePwd(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');
    input.type  = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}

function checkStrength(val) {
    const bar  = document.getElementById('strengthBar');
    const text = document.getElementById('strengthText');
    let s = 0;
    if (val.length >= 8)           s++;
    if (/[A-Z]/.test(val))         s++;
    if (/[0-9]/.test(val))         s++;
    if (/[^A-Za-z0-9]/.test(val)) s++;
    const levels = [
        { color:'#dc3545', label:'Weak',   width:'25%' },
        { color:'#fd7e14', label:'Fair',   width:'50%' },
        { color:'#ffc107', label:'Good',   width:'75%' },
        { color:'#198754', label:'Strong', width:'100%' },
    ];
    const lvl = levels[Math.max(0, s - 1)];
    bar.style.background = val.length ? lvl.color : 'transparent';
    bar.style.width      = val.length ? lvl.width : '0%';
    text.textContent     = val.length ? lvl.label : '';
    text.style.color     = lvl.color;
    checkMatch();
}

function checkMatch() {
    const pw   = document.getElementById('new_password').value;
    const conf = document.getElementById('confirm_password').value;
    const text = document.getElementById('matchText');
    if (!conf) { text.textContent = ''; return; }
    if (pw === conf) {
        text.textContent  = '✓ Passwords match';
        text.style.color  = '#198754';
    } else {
        text.textContent  = '✗ Passwords do not match';
        text.style.color  = '#dc3545';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
    }
});
</script>
</body>
</html>