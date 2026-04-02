<aside class="app-sidebar shadow"
       style="background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);"
       data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('religious_admin.dashboard') }}"
           class="brand-link d-flex align-items-center gap-2 py-3 px-3 text-white text-decoration-none">
            @if(auth()->user()->religion?->logo)
                <img src="{{ asset('storage/' . auth()->user()->religion->logo) }}"
                     style="width:32px;height:32px;object-fit:contain;border-radius:6px;
                            background:rgba(255,255,255,.1);padding:3px;">
            @else
                <i class="bi bi-shield-fill-check fs-4"></i>
            @endif
            <div>
                <div class="fw-light fs-6 lh-1">SRIMS</div>
                <div style="font-size:.7rem;opacity:.7;">
                    {{ auth()->user()->religion?->name ?? 'Religious Admin' }}
                </div>
            </div>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview" role="navigation" data-accordion="false">

                <li class="nav-header text-white-50">
                    {{ auth()->user()->religion?->name ?? 'Religious Admin' }}
                </li>

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('religious_admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('religious_admin.dashboard') ? 'active' : '' }}"
                       style="color: rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p class="nav-text">Dashboard</p>
                    </a>
                </li>

                {{-- Announcements --}}
                <li class="nav-item">
                    <a href="{{ route('religious_admin.announcements.index') }}"
                       class="nav-link {{ request()->routeIs('religious_admin.announcements*') ? 'active' : '' }}"
                       style="color: rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-megaphone"></i>
                        <p class="nav-text">Announcements</p>
                    </a>
                </li>

                {{-- Events --}}
                <li class="nav-item">
                    <a href="{{ route('religious_admin.events.index') }}"
                       class="nav-link {{ request()->routeIs('religious_admin.events*') ? 'active' : '' }}"
                       style="color: rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-calendar-event"></i>
                        <p class="nav-text">Events</p>
                    </a>
                </li>

               {{-- Members --}}
<li class="nav-item">
    <a href="{{ route('religious_admin.members.index') }}"
       class="nav-link {{ request()->routeIs('religious_admin.members*') ? 'active' : '' }}"
       style="color: rgba(255,255,255,.75) !important;">
        <i class="nav-icon bi bi-people"></i>
        <p class="nav-text">Members</p>
    </a>
</li>

{{-- Feedback --}}
<li class="nav-item">
    <a href="{{ route('religious_admin.feedback.index') }}"
       class="nav-link {{ request()->routeIs('religious_admin.feedback*') ? 'active' : '' }}"
       style="color: rgba(255,255,255,.75) !important;">
        <i class="nav-icon bi bi-chat-left-text"></i>
        <p class="nav-text">
            Feedback
            @php $pendingCount = \App\Models\Feedback::where('religion_id', auth()->user()->religion_id)->where('status','pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="badge bg-warning text-dark ms-1">{{ $pendingCount }}</span>
            @endif
        </p>
    </a>
</li>

            </ul>
        </nav>
    </div>
</aside>