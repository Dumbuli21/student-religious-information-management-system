<aside class="app-sidebar shadow"
       style="background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);"
       data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('super_admin.dashboard') }}"
           class="brand-link d-flex align-items-center gap-2 py-3 px-3 text-white text-decoration-none">
            <i class="bi bi-shield-fill-check fs-4"></i>
            <div>
                <div class="fw-light fs-6 lh-1">SRIMS</div>
                <div style="font-size:.7rem;opacity:.7;">Super Admin</div>
            </div>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview" role="navigation" data-accordion="false">

                <li class="nav-header text-white-50">SUPER ADMIN</li>

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('super_admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p class="nav-text">Dashboard</p>
                    </a>
                </li>

                {{-- Users --}}
                <li class="nav-item">
                    <a href="{{ route('super_admin.users.index') }}"
                       class="nav-link {{ request()->routeIs('super_admin.users*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-people"></i>
                        <p class="nav-text">Users</p>
                    </a>
                </li>

                {{-- Religions --}}
                <li class="nav-item">
                    <a href="{{ route('super_admin.religions.index') }}"
                       class="nav-link {{ request()->routeIs('super_admin.religions*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-book"></i>
                        <p class="nav-text">Religions</p>
                    </a>
                </li>

                {{-- Management --}}
                <li class="nav-item has-treeview {{ request()->routeIs('super_admin.management*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('super_admin.management*') ? 'active' : '' }}"
                       style="color:rgba(255,255,255,.75) !important;">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p class="nav-text">
                            Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('super_admin.management.departments.index') }}"
                               class="nav-link {{ request()->routeIs('super_admin.management.departments*') ? 'active' : '' }}"
                               style="color:rgba(255,255,255,.75) !important;">
                                <i class="nav-icon bi bi-building"></i>
                                <p class="nav-text">Departments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('super_admin.management.programmes.index') }}"
                               class="nav-link {{ request()->routeIs('super_admin.management.programmes*') ? 'active' : '' }}"
                               style="color:rgba(255,255,255,.75) !important;">
                                <i class="nav-icon bi bi-journal-bookmark-fill"></i>
                                <p class="nav-text">Programmes</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>