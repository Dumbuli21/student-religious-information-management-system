<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS | Student Dashboard</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; color:white; }
        .avatar-lg { width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.6rem; color:white; flex-shrink:0; }
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .ann-item { transition:.2s; }
        .ann-item:hover { background:#f8f9fa; }
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
                        <h3 class="mb-0">Dashboard
                            <span class="badge text-bg-primary" style="font-size:.7rem;">{{ $religion->name }}</span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">Student</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-1"></i> {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-x-circle me-1"></i> {!! session('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Student Profile Card --}}
                <div class="card mb-4"
                     style="border:none;border-radius:16px;background:linear-gradient(135deg,#1a3c5e,#2d6a9f);color:white;">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div class="avatar-lg"
                                 style="background:{{ $user->gender === 'female' ? '#e91e8c' : 'rgba(255,255,255,.2)' }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="mb-0 fw-bold">{{ $user->name }}</h4>
                                <p class="mb-1 opacity-75 small">{{ $user->email }}</p>
                                <div class="d-flex gap-2 flex-wrap mt-1">
                                    <span class="badge bg-white text-primary">
                                        <i class="bi bi-mortarboard me-1"></i>{{ $user->academicInfo() }}
                                    </span>
                                    <span class="badge" style="background:rgba(255,255,255,.2)">
                                        <i class="bi bi-book me-1"></i>{{ $religion->name }}
                                    </span>
                                    @if($user->region)
                                    <span class="badge" style="background:rgba(255,255,255,.2)">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $user->region->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex gap-4 text-center">
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['my_registrations'] }}</div>
                                    <small class="opacity-75">My Events</small>
                                </div>
                                <div>
                                    <div class="fw-bold fs-4">{{ $stats['upcoming_events'] }}</div>
                                    <small class="opacity-75">Upcoming</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#0d6efd;"><i class="bi bi-megaphone-fill"></i></div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['announcements'] }}</div>
                                    <small class="text-muted">Announcements</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#198754;"><i class="bi bi-calendar-fill"></i></div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['events'] }}</div>
                                    <small class="text-muted">Total Events</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#ffc107;"><i class="bi bi-calendar2-event"></i></div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['upcoming_events'] }}</div>
                                    <small class="text-muted">Upcoming</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background:#6f42c1;"><i class="bi bi-check2-circle"></i></div>
                                <div>
                                    <div class="fw-bold fs-3 lh-1">{{ $stats['my_registrations'] }}</div>
                                    <small class="text-muted">Registered</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">

                    {{-- Announcements --}}
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-megaphone me-2 text-primary"></i>Announcements</span>
                                <a href="{{ route('student.announcements.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($recent_announcements as $ann)
                                    <li class="list-group-item ann-item py-3" style="cursor:pointer"
                                        onclick="openAnnouncementModal({{ $ann->id }}, '{{ addslashes($ann->title) }}', `{{ addslashes($ann->content) }}`, '{{ $ann->published_at?->format('d M Y, H:i') ?? $ann->created_at->format('d M Y, H:i') }}')">
                                        <div class="fw-semibold">{{ $ann->title }}</div>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $ann->published_at?->diffForHumans() ?? $ann->created_at->diffForHumans() }}
                                        </small>
                                        <p class="text-muted small mb-0 mt-1">{{ Str::limit(strip_tags($ann->content), 80) }}</p>
                                    </li>
                                    @empty
                                    <li class="list-group-item text-center text-muted py-4">
                                        <i class="bi bi-megaphone fs-3 d-block mb-2 opacity-25"></i>
                                        No announcements yet.
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Upcoming Events --}}
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-calendar-event me-2 text-success"></i>Upcoming Events</span>
                                <a href="{{ route('student.events.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($upcoming_events as $event)
                                    @php
                                        $isReg = in_array($event->id, $registeredEventIds);
                                    @endphp
                                    <li class="list-group-item ann-item py-3" style="cursor:pointer"
                                        onclick="openEventModal({{ $event->id }})">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-semibold">{{ $event->title }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                                    &nbsp;|&nbsp;
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                                </small>
                                            </div>
                                            @if($isReg)
                                                <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </li>
                                    @empty
                                    <li class="list-group-item text-center text-muted py-4">
                                        <i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-25"></i>
                                        No upcoming events.
                                    </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- My Registered Events --}}
                    @if($my_events->count() > 0)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-check2-circle me-2 text-success"></i>My Registered Events</span>
                                <a href="{{ route('student.events.index') }}" class="btn btn-sm btn-outline-secondary">All Events</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">Event</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($my_events as $event)
                                            @php $sc = ['upcoming'=>'primary','ongoing'=>'success','completed'=>'secondary','cancelled'=>'danger'][$event->status]??'secondary'; @endphp
                                            <tr style="cursor:pointer" onclick="openEventModal({{ $event->id }})">
                                                <td class="ps-3 fw-semibold">{{ $event->title }}</td>
                                                <td><small>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</small></td>
                                                <td><small class="text-muted">{{ $event->location ?? 'TBD' }}</small></td>
                                                <td><span class="badge bg-{{ $sc }}">{{ ucfirst($event->status) }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</div>

{{-- Announcement View Modal --}}
<div class="modal fade" id="announcementModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-megaphone me-2"></i>Announcement</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="announcementModalBody">
                <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Event View + Register Modal --}}
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
const csrfToken        = '{{ csrf_token() }}';
const registeredIds    = @json($registeredEventIds);
const eventShowRoute   = '{{ route('student.events.show', '__ID__') }}';
const registerRoute    = '{{ route('student.events.register', '__ID__') }}';
const unregisterRoute  = '{{ route('student.events.unregister', '__ID__') }}';

function routeFor(base, id) { return base.replace('__ID__', id); }

// ── Announcement Modal ───────────────────────────────────────────
function openAnnouncementModal(id, title, content, date) {
    const modal = new bootstrap.Modal(document.getElementById('announcementModal'));
    document.getElementById('announcementModalBody').innerHTML = `
        <h5 class="fw-bold mb-2">${title}</h5>
        <small class="text-muted d-block mb-4"><i class="bi bi-calendar me-1"></i>${date}</small>
        <hr>
        <div style="white-space:pre-wrap;line-height:1.8;">${content}</div>`;
    modal.show();
}

// ── Event Modal ──────────────────────────────────────────────────
function openEventModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    document.getElementById('eventModalBody').innerHTML =
        `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
    modal.show();

    fetch(routeFor(eventShowRoute, id), {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(r => { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
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
                actionBtn = `<button class="btn btn-secondary px-4" disabled>Event is Full</button>`;
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
                        ${e.participants_count} ${e.max_participants ? '/ ' + e.max_participants : '(Unlimited)'}
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