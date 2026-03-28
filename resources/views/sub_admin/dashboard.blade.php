@extends('layouts.app')

@section('title', 'Sub Admin Dashboard')
@section('page-title', 'Sub Admin Dashboard')
@section('sidebar-section', 'Sub Admin')

@section('sidebar-links')
    <li class="nav-item">
        <a href="{{ route('sub_admin.dashboard') }}" class="nav-link active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-calendar-event"></i> Events
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-megaphone"></i> Announcements
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-person-check"></i> Attendance
        </a>
    </li>
@endsection

@section('content')
    <div class="row g-3">
        {{-- Upcoming Events --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold border-bottom py-3">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>Upcoming Events
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($upcoming_events as $event)
                            <li class="list-group-item py-3">
                                <div class="fw-semibold">{{ $event->title }}</div>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                    &nbsp;|&nbsp;
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">No upcoming events.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Latest Announcements --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold border-bottom py-3">
                    <i class="bi bi-megaphone me-2 text-success"></i>Latest Announcements
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($latest_announcements as $ann)
                            <li class="list-group-item py-3">
                                <div class="fw-semibold">{{ $ann->title }}</div>
                                <small class="text-muted">{{ $ann->published_at ? \Carbon\Carbon::parse($ann->published_at)->diffForHumans() : 'Not published' }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">No announcements yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection