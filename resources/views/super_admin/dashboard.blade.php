@extends('layouts.app')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')
@section('sidebar-section', 'Super Admin')

@section('sidebar-links')
    <li class="nav-item">
        <a href="{{ route('super_admin.dashboard') }}" class="nav-link active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-people"></i> Users
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-globe2"></i> Religions
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-graph-up"></i> Reports
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-clock-history"></i> Activity Logs
        </a>
    </li>
@endsection

@section('content')
    {{-- Stats cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e8f0fe">
                        <i class="bi bi-people-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_users'] }}</div>
                        <div class="text-muted small">Total Users</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e6f4ea">
                        <i class="bi bi-globe2 text-success fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_religions'] }}</div>
                        <div class="text-muted small">Religions</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fef3e2">
                        <i class="bi bi-calendar-event text-warning fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_events'] }}</div>
                        <div class="text-muted small">Total Events</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fce8e6">
                        <i class="bi bi-megaphone text-danger fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_announcements'] }}</div>
                        <div class="text-muted small">Announcements</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-semibold border-bottom py-3">
            <i class="bi bi-people me-2 text-primary"></i>Recent Users
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Student No.</th>
                            <th>Role</th>
                            <th>Religion</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recent_users as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td><code>{{ $u->student_number }}</code></td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ ucwords(str_replace('_', ' ', $u->role?->name)) }}
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
                            <tr><td colspan="5" class="text-center text-muted py-4">No users found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection