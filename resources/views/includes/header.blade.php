<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ Auth::user() ? route(Auth::user()->dashboardRoute()) : '#' }}"
                   class="nav-link">
                    <i class="bi bi-house me-1"></i>Home
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">

            {{-- ── Resolve profile & password URLs safely ── --}}
            @php
                $roleRouteMap = [
                    'super_admin'     => [
                        'profile'  => 'super_admin.profile',
                        'password' => 'super_admin.password.form',
                    ],
                    'religious_admin' => [
                        'profile'  => 'religious_admin.profile',
                        'password' => 'religious_admin.password.form',
                    ],
                    'sub_admin'       => [
                        'profile'  => 'sub_admin.profile',
                        'password' => 'sub_admin.password.form',
                    ],
                    'student'         => [
                        'profile'  => 'student.profile',
                        'password' => 'student.password.form',
                    ],
                ];

                $currentRole  = Auth::user()?->role?->name;
                $profileUrl   = isset($roleRouteMap[$currentRole])
                                ? route($roleRouteMap[$currentRole]['profile'])
                                : '#';
                $passwordUrl  = isset($roleRouteMap[$currentRole])
                                ? route($roleRouteMap[$currentRole]['password'])
                                : '#';
            @endphp

            {{-- Notifications --}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button">
                    <i class="bi bi-bell-fill"></i>
                    @php
                        $notifCount = Auth::user()
                            ? \App\Models\Notification::where('user_id', Auth::id())
                                                      ->where('is_read', false)
                                                      ->count()
                            : 0;
                    @endphp
                    @if($notifCount > 0)
                        <span class="navbar-badge badge text-bg-warning">{{ $notifCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="min-width:300px;border-radius:12px;">
                    <div class="dropdown-header fw-bold px-3 py-2 border-bottom">
                        <i class="bi bi-bell me-2"></i>Notifications
                        @if($notifCount > 0)
                            <span class="badge bg-warning text-dark ms-1">{{ $notifCount }}</span>
                        @endif
                    </div>
                    @php
                        $notifications = \App\Models\Notification::where('user_id', Auth::id())
                                                                  ->latest()
                                                                  ->take(5)
                                                                  ->get();
                    @endphp
                    @forelse($notifications as $notif)
                        <a href="#" class="dropdown-item py-2 {{ !$notif->is_read ? 'bg-light' : '' }}">
                            <div class="fw-semibold small">{{ $notif->title }}</div>
                            <small class="text-muted">{{ $notif->message }}</small>
                            <div>
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="dropdown-item text-center text-muted py-3">
                            <i class="bi bi-bell-slash d-block fs-4 mb-1 opacity-25"></i>
                            No notifications
                        </div>
                    @endforelse
                    @if($notifications->count() > 0)
                        <div class="dropdown-divider"></div>
                        <div class="text-center py-1">
                            <small class="text-muted">
                                Latest {{ $notifications->count() }} notifications
                            </small>
                        </div>
                    @endif
                </div>
            </li>

            {{-- Fullscreen --}}
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                </a>
            </li>

            {{-- User Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                   href="#" data-bs-toggle="dropdown" role="button">

                    {{-- Avatar --}}
                    <div style="width:32px;height:32px;border-radius:50%;
                                background:{{ Auth::user()?->gender === 'female' ? '#e91e8c' : '#1a3c5e' }};
                                display:flex;align-items:center;justify-content:center;
                                font-weight:700;font-size:.85rem;color:white;flex-shrink:0;">
                        {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
                    </div>

                    <div class="d-none d-md-block text-start lh-1">
                        <div class="fw-semibold small">{{ Auth::user()?->name }}</div>
                        <div class="text-muted" style="font-size:.7rem;">
                            {{ ucwords(str_replace('_', ' ', Auth::user()?->role?->name ?? '')) }}
                        </div>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow"
                    style="min-width:220px;border-radius:12px;border:none;padding:8px;">

                    {{-- User Info Header --}}
                    <li class="px-3 py-2 mb-1" style="background:#f8f9fa;border-radius:8px;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:40px;height:40px;border-radius:50%;
                                        background:{{ Auth::user()?->gender === 'female' ? '#e91e8c' : '#1a3c5e' }};
                                        display:flex;align-items:center;justify-content:center;
                                        font-weight:700;color:white;flex-shrink:0;">
                                {{ strtoupper(substr(Auth::user()?->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold small">{{ Auth::user()?->name }}</div>
                                <div class="text-muted" style="font-size:.72rem;">
                                    {{ Auth::user()?->email }}
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary"
                                      style="font-size:.65rem;">
                                    {{ ucwords(str_replace('_', ' ', Auth::user()?->role?->name ?? '')) }}
                                </span>
                            </div>
                        </div>
                    </li>

                    <li><hr class="dropdown-divider my-1"></li>

                    {{-- My Profile --}}
                    <li>
                        <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2"
                           href="{{ $profileUrl }}">
                            <i class="bi bi-person-circle text-primary"></i>
                            <span>My Profile</span>
                        </a>
                    </li>

                    {{-- Change Password --}}
                    <li>
                        <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2"
                           href="{{ $passwordUrl }}">
                            <i class="bi bi-key text-warning"></i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    {{-- Default password warning --}}
                    @if(Auth::user() && !Auth::user()->password_changed)
                    <li>
                        <div class="px-2 py-1">
                            <div class="alert alert-warning py-1 px-2 mb-0 small d-flex align-items-center gap-1">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Default password in use!</span>
                            </div>
                        </div>
                    </li>
                    @endif

                    <li><hr class="dropdown-divider my-1"></li>

                    {{-- Logout --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="dropdown-item rounded-2 d-flex align-items-center gap-2 py-2 text-danger w-100 border-0 bg-transparent">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</nav>