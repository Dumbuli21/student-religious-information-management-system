<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events – {{ $religion->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .event-card { transition: transform .2s, box-shadow .2s; }
        .event-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,.12) !important; }
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
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Events
                            <span class="badge text-bg-success" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="mb-4">
                    <h5 class="fw-bold mb-0">Upcoming & Ongoing Events</h5>
                    <small class="text-muted">Register for events in {{ $religion->name }}</small>
                </div>

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

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#0d6efd;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-calendar-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['total'] }}</div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#0dcaf0;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-calendar-plus"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['upcoming'] }}</div>
                                    <small class="text-muted">Upcoming</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#198754;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['ongoing'] }}</div>
                                    <small class="text-muted">Ongoing</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#6f42c1;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['my_count'] }}</div>
                                    <small class="text-muted">Registered</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Events Grid --}}
                <div class="row g-3">
                    @forelse($events as $event)
                    @php
                        $isRegistered = in_array($event->id, $registeredEventIds);
                        $sc = [
                            'upcoming' => 'primary',
                            'ongoing'  => 'success',
                        ][$event->status] ?? 'secondary';
                        $isFull = $event->max_participants &&
                                  \App\Models\EventRegistration::where('event_id', $event->id)->count() >= $event->max_participants;
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card event-card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-{{ $sc }}">{{ ucfirst($event->status) }}</span>
                                    @if($isRegistered)
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-check-circle me-1"></i>Registered
                                        </span>
                                    @endif
                                </div>

                                <h6 class="fw-bold mb-2">{{ $event->title }}</h6>

                                @if($event->description)
                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($event->description, 80) }}
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <div class="small text-muted mb-1">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                    </div>
                                    @if($event->location)
                                    <div class="small text-muted mb-2">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                    </div>
                                    @endif
                                    @if($event->max_participants)
                                    <div class="small text-muted mb-3">
                                        <i class="bi bi-people me-1"></i>
                                        {{ \App\Models\EventRegistration::where('event_id',$event->id)->count() }}
                                        / {{ $event->max_participants }} participants
                                        @if($isFull)
                                            <span class="badge bg-danger ms-1">Full</span>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('student.events.show', $event) }}"
                                           class="btn btn-sm btn-outline-primary flex-grow-1">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        @if($isRegistered)
                                            <form action="{{ route('student.events.unregister', $event) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Unregister from this event?')">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>
                                        @elseif(!$isFull && $event->status === 'upcoming')
                                            <form action="{{ route('student.events.register', $event) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-circle me-1"></i>Register
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card p-5 text-center text-muted">
                            <i class="bi bi-calendar-x fs-1 d-block mb-2 opacity-25"></i>
                            No events available at the moment.
                        </div>
                    </div>
                    @endforelse
                </div>

                @if($events->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->links() }}
                </div>
                @endif

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