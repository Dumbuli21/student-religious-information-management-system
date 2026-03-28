@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Student Dashboard')
@section('sidebar-section', 'Student')

@section('sidebar-links')
    <li class="nav-item">
        <a href="{{ route('student.dashboard') }}" class="nav-link active">
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
            <i class="bi bi-bell"></i> Notifications
            @if($unread_notifications > 0)
                <span class="badge bg-danger ms-1">{{ $unread_notifications }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-chat-left-text"></i> Feedback
        </a>
    </li>
@endsection

@section('content')
    {{-- Welcome banner --}}
    <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white;">
        <div class="card-body py-4 px-4">
            <h5 class="fw-bold mb-1">Welcome back, {{ Auth::user()->name }}! 👋</h5>
            <p class="mb-0 opacity-75">
                {{ Auth::user()->religion?->name ?? 'SRIMS' }} &nbsp;|&nbsp;
                {{ Auth::user()->course ?? 'Student' }}
                @if(Auth::user()->year_of_study)
                    &nbsp;– Year {{ Auth::user()->year_of_study }}
                @endif
            </p>
        </div>
    </div>

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
                            <li class="list-group-item py-3 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ $event->title }}</div>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                        &nbsp;|&nbsp;
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </small>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">Register</a>
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
                                <small class="text-muted">{{ $ann->published_at ? \Carbon\Carbon::parse($ann->published_at)->diffForHumans() : '' }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">No announcements yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- My Event Registrations --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold border-bottom py-3">
                    <i class="bi bi-ticket-perforated me-2 text-warning"></i>My Event Registrations
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Registered At</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($my_registrations as $reg)
                                    <tr>
                                        <td>{{ $reg->event?->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reg->registered_at)->format('d M Y, H:i') }}</td>
                                        <td>
                                            @if(is_null($reg->attended))
                                                <span class="badge bg-secondary">Pending</span>
                                            @elseif($reg->attended)
                                                <span class="badge bg-success">Attended</span>
                                            @else
                                                <span class="badge bg-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-4">No registrations yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection