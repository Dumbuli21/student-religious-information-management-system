<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events – {{ $religion->name }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .event-card { transition:.2s; cursor:pointer; }
        .event-card:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,0,0,.12) !important; }
        .modal-header { background:linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white; border-radius:12px 12px 0 0 !important; }
        .modal-header .btn-close { filter:brightness(0) invert(1); }
        .modal-content { border:none; border-radius:12px; }
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
                    <div class="col-sm-6">
                        <h3 class="mb-0">Events
                            <span class="badge text-bg-success" style="font-size:.7rem;">{{ $religion->name }}</span>
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
                    <small class="text-muted">Click any event to view details and register</small>
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
                                <div style="width:40px;height:40px;border-radius:50%;background:#0d6efd;display:flex;align-items:center;justify-content:center;color:white;"><i class="bi bi-calendar-fill"></i></div>
                                <div><div class="fw-bold fs-5">{{ $stats['total'] }}</div><small class="text-muted">Total</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#0dcaf0;display:flex;align-items:center;justify-content:center;color:white;"><i class="bi bi-calendar-plus"></i></div>
                                <div><div class="fw-bold fs-5">{{ $stats['upcoming'] }}</div><small class="text-muted">Upcoming</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#198754;display:flex;align-items:center;justify-content:center;color:white;"><i class="bi bi-calendar-check"></i></div>
                                <div><div class="fw-bold fs-5">{{ $stats['ongoing'] }}</div><small class="text-muted">Ongoing</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#6f42c1;display:flex;align-items:center;justify-content:center;color:white;"><i class="bi bi-check2-circle"></i></div>
                                <div><div class="fw-bold fs-5">{{ $stats['my_count'] }}</div><small class="text-muted">Registered</small></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Events Grid --}}
                <div class="row g-3">
                    @forelse($events as $event)
                    @php
                        $isRegistered = in_array($event->id, $registeredEventIds);
                        $sc = ['upcoming'=>'primary','ongoing'=>'success'][$event->status] ?? 'secondary';
                        $isFull = $event->max_participants &&
                                  \App\Models\EventRegistration::where('event_id',$event->id)->count() >= $event->max_participants;
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card event-card h-100" onclick="openEventModal({{ $event->id }})">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-{{ $sc }}">{{ ucfirst($event->status) }}</span>
                                    @if($isRegistered)
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-check-circle me-1"></i>Registered
                                        </span>
                                    @elseif($isFull)
                                        <span class="badge bg-danger bg-opacity-10 text-danger">Full</span>
                                    @endif
                                </div>
                                <h6 class="fw-bold mb-2">{{ $event->title }}</h6>
                                @if($event->description)
                                <p class="text-muted small mb-3">{{ Str::limit($event->description, 80) }}</p>
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
                                    <div class="small text-muted">
                                        <i class="bi bi-people me-1"></i>
                                        {{ \App\Models\EventRegistration::where('event_id',$event->id)->count() }}
                                        / {{ $event->max_participants }}
                                    </div>
                                    @endif
                                    <div class="mt-2">
                                        <small class="text-primary"><i class="bi bi-eye me-1"></i>Click to view & register</small>
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

{{-- Event Modal --}}
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-calendar-event me-2"></i>Event Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="eventModalBody">
                <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
const csrfToken       = '{{ csrf_token() }}';
const registeredIds   = @json($registeredEventIds);
const eventShowRoute  = '{{ route('student.events.show', '__ID__') }}';
const registerRoute   = '{{ route('student.events.register', '__ID__') }}';
const unregisterRoute = '{{ route('student.events.unregister', '__ID__') }}';

function routeFor(base, id) { return base.replace('__ID__', id); }

function openEventModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    document.getElementById('eventModalBody').innerHTML =
        `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
    modal.show();

    fetch(routeFor(eventShowRoute, id), {
        headers: { 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
    })
    .then(r => { if (!r.ok) throw new Error('HTTP '+r.status); return r.json(); })
    .then(e => {
        const isRegistered = registeredIds.includes(e.id);
        const isFull       = e.max_participants && e.participants_count >= e.max_participants;
        const sc           = { upcoming:'primary', ongoing:'success', completed:'secondary', cancelled:'danger' }[e.status] ?? 'secondary';

        let actionBtn = '';
        if (e.status === 'upcoming') {
            if (isRegistered) {
                actionBtn = `
                    <form method="POST" action="${routeFor(unregisterRoute, e.id)}">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <button type="submit" class="btn btn-danger fw-semibold px-4"
                                onclick="return confirm('Unregister from this event?')">
                            <i class="bi bi-x-circle me-2"></i>Unregister
                        </button>
                    </form>`;
            } else if (!isFull) {
                actionBtn = `
                    <form method="POST" action="${routeFor(registerRoute, e.id)}">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <button type="submit" class="btn btn-success fw-semibold px-4">
                            <i class="bi bi-check-circle me-2"></i>Register for Event
                        </button>
                    </form>`;
            } else {
                actionBtn = `<button class="btn btn-secondary px-4" disabled><i class="bi bi-x-circle me-2"></i>Event is Full</button>`;
            }
        } else if (e.status === 'cancelled') {
            actionBtn = `<div class="alert alert-danger mb-0"><i class="bi bi-x-circle me-2"></i>This event has been cancelled.</div>`;
        } else if (e.status === 'completed') {
            actionBtn = `<div class="alert alert-secondary mb-0"><i class="bi bi-calendar2-check me-2"></i>This event has been completed.</div>`;
        } else if (e.status === 'ongoing' && isRegistered) {
            actionBtn = `<div class="alert alert-success mb-0"><i class="bi bi-check-circle me-2"></i>You are registered for this ongoing event.</div>`;
        }

        document.getElementById('eventModalBody').innerHTML = `
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="badge bg-${sc} mb-2">${e.status.charAt(0).toUpperCase()+e.status.slice(1)}</span>
                    <h5 class="fw-bold mb-0">${e.title}</h5>
                </div>
                ${isRegistered ? '<span class="badge bg-success bg-opacity-10 text-success p-2"><i class="bi bi-check-circle me-1"></i>Registered</span>' : ''}
            </div>
            <hr>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <div class="info-label">Start Date</div>
                    <div><i class="bi bi-calendar me-1 text-primary"></i>${e.start_date_fmt}</div>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">End Date</div>
                    <div><i class="bi bi-calendar-check me-1 text-success"></i>${e.end_date_fmt}</div>
                </div>
                ${e.location ? `
                <div class="col-sm-6">
                    <div class="info-label">Location</div>
                    <div><i class="bi bi-geo-alt me-1 text-danger"></i>${e.location}</div>
                </div>` : ''}
                <div class="col-sm-6">
                    <div class="info-label">Participants</div>
                    <div>
                        <i class="bi bi-people me-1 text-info"></i>
                        ${e.participants_count} ${e.max_participants ? '/ '+e.max_participants : '(Unlimited)'}
                        ${isFull ? '<span class="badge bg-danger ms-1">Full</span>' : ''}
                    </div>
                </div>
            </div>
            ${e.description ? `
            <div class="mb-3">
                <div class="info-label">Description</div>
                <div class="p-3 bg-light rounded mt-1" style="white-space:pre-wrap;">${e.description}</div>
            </div>` : ''}
            <hr>
            ${actionBtn}`;
    })
    .catch(err => {
        document.getElementById('eventModalBody').innerHTML =
            `<div class="alert alert-danger m-3"><i class="bi bi-x-circle me-2"></i>Failed to load. (${err.message})</div>`;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
    }
});
</script>
</body>
</html>