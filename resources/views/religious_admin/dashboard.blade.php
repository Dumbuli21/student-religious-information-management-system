@extends('layouts.app')

@section('title', 'Religious Admin Dashboard')
@section('page-title', 'Religious Admin Dashboard')
@section('sidebar-section', 'Religious Admin')

@section('sidebar-links')
    <li class="nav-item">
        <a href="{{ route('religious_admin.dashboard') }}" class="nav-link active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-megaphone"></i> Announcements
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-calendar-event"></i> Events
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-people"></i> Members
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-chat-left-text"></i> Feedback
        </a>
    </li>
@endsection

@section('content')
    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e8f0fe">
                        <i class="bi bi-megaphone-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['my_announcements'] }}</div>
                        <div class="text-muted small">Announcements</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e6f4ea">
                        <i class="bi bi-calendar-check text-success fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['my_events'] }}</div>
                        <div class="text-muted small">Total Events</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fef3e2">
                        <i class="bi bi-people-fill text-warning fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['members'] }}</div>
                        <div class="text-muted small">Members</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fce8e6">
                        <i class="bi bi-calendar2-event text-danger fs-4"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['upcoming_events'] }}</div>
                        <div class="text-muted small">Upcoming Events</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Recent Announcements --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white fw-semibold border-bottom py-3">
                    <i class="bi bi-megaphone me-2 text-primary"></i>Recent Announcements
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($recent_announcements as $ann)
                            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div>
                                    <div class="fw-semibold">{{ $ann->title }}</div>
                                    <small class="text-muted">{{ $ann->created_at->diffForHumans() }}</small>
                                </div>
                                @if($ann->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">No announcements yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Upcoming Events --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white fw-semibold border-bottom py-3">
                    <i class="bi bi-calendar-event me-2 text-success"></i>Upcoming Events
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($upcoming_events as $event)
                            <li class="list-group-item py-3">
                                <div class="fw-semibold">{{ $event->title }}</div>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                    &nbsp;|&nbsp;
                                    <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">No upcoming events.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection