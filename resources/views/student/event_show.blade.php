<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .info-label { font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; color:#6c757d; margin-bottom:2px; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.student_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6"><h3 class="mb-0">Event Details</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('student.events.index') }}">Events</a>
                            </li>
                            <li class="breadcrumb-item active">{{ Str::limit($event->title, 30) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container" style="max-width:800px">

                <a href="{{ route('student.events.index') }}"
                   class="btn btn-outline-secondary btn-sm mb-4">
                    <i class="bi bi-arrow-left me-1"></i>Back to Events
                </a>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-2"></i> {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-x-circle me-2"></i> {!! session('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @php
                    $sc = [
                        'upcoming'  => 'primary',
                        'ongoing'   => 'success',
                        'completed' => 'secondary',
                        'cancelled' => 'danger',
                    ][$event->status] ?? 'secondary';
                    $isFull = $event->max_participants && $participantsCount >= $event->max_participants;
                @endphp

                <div class="card">
                    <div class="card-body p-4 p-md-5">

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-{{ $sc }} mb-2">{{ ucfirst($event->status) }}</span>
                                <h3 class="fw-bold mb-0">{{ $event->title }}</h3>
                            </div>
                            @if($registered)
                                <span class="badge bg-success bg-opacity-10 text-success fs-6 p-2">
                                    <i class="bi bi-check-circle me-1"></i>Registered
                                </span>
                            @endif
                        </div>

                        <hr>

                        {{-- Event Details --}}
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="info-label">Start Date & Time</div>
                                <div class="fw-semibold">
                                    <i class="bi bi-calendar me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-label">End Date & Time</div>
                                <div class="fw-semibold">
                                    <i class="bi bi-calendar-check me-1 text-success"></i>
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') }}
                                </div>
                            </div>
                            @if($event->location)
                            <div class="col-sm-6">
                                <div class="info-label">Location</div>
                                <div class="fw-semibold">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i>{{ $event->location }}
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6">
                                <div class="info-label">Participants</div>
                                <div class="fw-semibold">
                                    <i class="bi bi-people me-1 text-info"></i>
                                    {{ $participantsCount }}
                                    {{ $event->max_participants ? '/ ' . $event->max_participants : '(Unlimited)' }}
                                    @if($isFull)
                                        <span class="badge bg-danger ms-1">Full</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-label">Religion</div>
                                <div class="fw-semibold">
                                    <i class="bi bi-book me-1"></i>{{ $religion->name }}
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if($event->description)
                        <div class="mb-4">
                            <div class="info-label">Description</div>
                            <div class="p-3 bg-light rounded mt-1" style="white-space:pre-wrap;line-height:1.8;">
                                {{ $event->description }}
                            </div>
                        </div>
                        @endif

                        {{-- Register / Unregister --}}
                        @if($event->status === 'upcoming')
                            @if($registered)
                                <form action="{{ route('student.events.unregister', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger fw-semibold px-4"
                                            onclick="return confirm('Are you sure you want to unregister?')">
                                        <i class="bi bi-x-circle me-2"></i>Unregister from Event
                                    </button>
                                </form>
                            @elseif(!$isFull)
                                <form action="{{ route('student.events.register', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success fw-semibold px-4">
                                        <i class="bi bi-check-circle me-2"></i>Register for This Event
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary fw-semibold px-4" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Event is Full
                                </button>
                            @endif
                        @elseif($event->status === 'ongoing' && $registered)
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                You are registered for this ongoing event.
                            </div>
                        @elseif($event->status === 'completed')
                            <div class="alert alert-secondary">
                                <i class="bi bi-calendar2-check me-2"></i>
                                This event has been completed.
                            </div>
                        @elseif($event->status === 'cancelled')
                            <div class="alert alert-danger">
                                <i class="bi bi-x-circle me-2"></i>
                                This event has been cancelled.
                            </div>
                        @endif

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