<aside class="app-sidebar shadow"
       style="background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);"
       data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('student.dashboard') }}"
           class="brand-link d-flex align-items-center gap-2 py-3 px-3 text-white text-decoration-none">
            @if(auth()->user()->religion?->logo)
                <img src="{{ asset('storage/' . auth()->user()->religion->logo) }}"
                     style="width:32px;height:32px;object-fit:contain;border-radius:6px;
                            background:rgba(255,255,255,.1);padding:3px;">
            @else
                <i class="bi bi-mortarboard-fill fs-4"></i>
            @endif
            <div>
                <div class="fw-light fs-6 lh-1">SRIMS</div>
                <div style="font-size:.7rem;opacity:.7;">
                    {{ auth()->user()->religion?->name ?? 'Student' }}
                </div>
            </div>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview" role="navigation" data-accordion="false">

                <li class="nav-header text-white-50">STUDENT PANEL</li>

                <li class="nav-item">
                    <a href="{{ route('student.dashboard') }}"
                       class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p class="nav-text">Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student.announcements.index') }}"
                       class="nav-link {{ request()->routeIs('student.announcements*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-megaphone"></i>
                        <p class="nav-text">Announcements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student.events.index') }}"
                       class="nav-link {{ request()->routeIs('student.events*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-calendar-event"></i>
                        <p class="nav-text">Events</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student.feedback.index') }}"
                       class="nav-link {{ request()->routeIs('student.feedback*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-chat-left-text"></i>
                        <p class="nav-text">Feedback</p>
                    </a>
                </li>

                <li class="nav-header text-white-50">ACCOUNT</li>

                <li class="nav-item">
                    <a href="{{ route('student.profile') }}"
                       class="nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p class="nav-text">My Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student.password.form') }}"
                       class="nav-link {{ request()->routeIs('student.password*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-key"></i>
                        <p class="nav-text">Change Password</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>