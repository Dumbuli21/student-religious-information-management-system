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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .card-header { border-radius:12px 12px 0 0 !important; background: linear-gradient(135deg, #1a3c5e, #2d6a9f); color: white; }
        .modal-header { background:linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white; border-radius:12px 12px 0 0 !important; }
        .modal-header .btn-close { filter:brightness(0) invert(1); }
        .modal-content { border:none; border-radius:12px; }
        .table th { font-size:.8rem; text-transform:uppercase; letter-spacing:.5px; color:#6c757d; }
        .info-label { font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; color:#6c757d; margin-bottom:2px; }
        .btn-primary {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2d6a9f, #1a3c5e);
        }
        .btn-outline-primary {
            color: #1a3c5e;
            border-color: #1a3c5e;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            border-color: transparent;
        }
        .badge.bg-primary {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            border-color: #1a3c5e;
        }
        .pagination .page-link {
            color: #1a3c5e;
        }
        .pagination .page-link:hover {
            color: #2d6a9f;
        }
        
        /* DataTables Custom Styles */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white !important;
            border-color: #1a3c5e;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 6px 12px;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 6px 12px;
        }
        
        /* Add Button */
        .btn-add-event {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border: none;
        }
        .btn-add-event:hover { 
            background: linear-gradient(135deg, #2d6a9f, #1a3c5e);
            color: white; 
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.sub_admin_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Events
                            <span class="badge text-bg-primary" style="font-size:.7rem; background: linear-gradient(135deg, #1a3c5e, #2d6a9f);">
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

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0">All Events</h5>
                        <small class="text-muted">Manage events for {{ $religion->name }}</small>
                    </div>
                    <button class="btn btn-add-event"
                            data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-2"></i>New Event
                    </button>
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
                    @foreach([
                        ['label'=>'Total',     'key'=>'total',     'color'=>'#0d6efd', 'icon'=>'bi-calendar-fill'],
                        ['label'=>'Upcoming',  'key'=>'upcoming',  'color'=>'#0dcaf0', 'icon'=>'bi-calendar-plus'],
                        ['label'=>'Ongoing',   'key'=>'ongoing',   'color'=>'#198754', 'icon'=>'bi-calendar-check'],
                        ['label'=>'Completed', 'key'=>'completed', 'color'=>'#6c757d', 'icon'=>'bi-calendar2-check'],
                        ['label'=>'Cancelled', 'key'=>'cancelled', 'color'=>'#dc3545', 'icon'=>'bi-calendar-x'],
                    ] as $stat)
                    <div class="col-6 col-md">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;border-radius:50%;background:{{ $stat['color'] }};
                                            display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi {{ $stat['icon'] }}"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats[$stat['key']] }}</div>
                                    <small class="text-muted">{{ $stat['label'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Table with DataTables --}}
                <div class="card">
                    <div class="card-header py-3 fw-bold">
                        <i class="bi bi-calendar-event me-2"></i>Events List
                        <span class="badge ms-2" style="background: white; color: #1a3c5e;">{{ $events->total() }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="eventsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $event)
                                    @php
                                        $statusColors = [
                                            'upcoming'  => 'primary',
                                            'ongoing'   => 'success',
                                            'completed' => 'secondary',
                                            'cancelled' => 'danger',
                                        ];
                                        $sc = $statusColors[$event->status] ?? 'secondary';
                                    @endphp
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($events->currentPage() - 1) * $events->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="fw-semibold">{{ $event->title }}</td>
                                        <td>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBD' }}
                                            </small>
                                        </td>
                                        <td>
                                            <small>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}</small>
                                        </td>
                                        <td>
                                            <small>{{ \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') }}</small>
                                        </td>
                                        <td>
                                            @if($event->status == 'upcoming')
                                                <span class="badge" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f);">Upcoming</span>
                                            @elseif($event->status == 'ongoing')
                                                <span class="badge bg-success">Ongoing</span>
                                            @elseif($event->status == 'completed')
                                                <span class="badge bg-secondary">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-outline-info" title="View"
                                                        onclick="openViewModal({{ $event->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Edit"
                                                        onclick="openEditModal({{ $event->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="openDeleteModal({{ $event->id }}, '{{ addslashes($event->title) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="bi bi-calendar-x fs-1 d-block mb-2 opacity-25"></i>
                                            No events yet.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</div>

{{-- CREATE --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>New Event</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('sub_admin.events.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Event title">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Description</label>
                            <textarea name="description" rows="3" class="form-control"
                                      placeholder="Optional description">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Start Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror"
                                   value="{{ old('start_date') }}">
                            @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">End Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_date"
                                   class="form-control @error('end_date') is-invalid @enderror"
                                   value="{{ old('end_date') }}">
                            @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Location</label>
                            <input type="text" name="location" class="form-control"
                                   value="{{ old('location') }}" placeholder="e.g. Main Hall">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Max Participants</label>
                            <input type="number" name="max_participants" class="form-control"
                                   value="{{ old('max_participants') }}" min="1" placeholder="Unlimited">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="upcoming"  {{ old('status','upcoming') == 'upcoming'  ? 'selected':'' }}>Upcoming</option>
                                <option value="ongoing"   {{ old('status') == 'ongoing'   ? 'selected':'' }}>Ongoing</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-add-event fw-semibold">
                        <i class="bi bi-calendar-plus me-1"></i>Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- VIEW --}}
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-calendar-event me-2"></i>Event Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning fw-semibold" id="viewToEditBtn">
                    <i class="bi bi-pencil me-1"></i>Edit
                </button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2"></i>Edit Event</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editModalBody">
                <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
            </div>
        </div>
    </div>
</div>

{{-- DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#c0392b,#e74c3c);">
                <h6 class="modal-title fw-bold text-white">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter:brightness(0) invert(1)"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-calendar-x text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to delete</p>
                <h5 class="fw-bold" id="deleteEventTitle"></h5>
                <small class="text-muted">This action soft-deletes and can be recovered later.</small>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-semibold">
                        <i class="bi bi-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
const csrfToken = '{{ csrf_token() }}';
const routes = {
    show:    '{{ route('sub_admin.events.show',   '__ID__') }}',
    update:  '{{ route('sub_admin.events.update', '__ID__') }}',
    destroy: '{{ route('sub_admin.events.destroy','__ID__') }}',
};
function routeFor(name, id) { return routes[name].replace('__ID__', id); }

// DataTable Initialization
$(document).ready(function() {
    $('#eventsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            paginate: {
                previous: "Previous",
                next: "Next"
            },
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries"
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    @if($errors->any())
        new bootstrap.Modal(document.getElementById('createModal')).show();
    @endif
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
    }
});

function openViewModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    document.getElementById('viewModalBody').innerHTML =
        `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
    modal.show();
    fetch(routeFor('show', id), { headers: { 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' } })
    .then(r => { if (!r.ok) throw new Error('HTTP '+r.status); return r.json(); })
    .then(e => {
        document.getElementById('viewModalBody').innerHTML = `
            <div class="mb-3"><div class="info-label">Title</div><h5 class="fw-bold">${e.title}</h5></div>
            ${e.description ? `<div class="mb-3"><div class="info-label">Description</div>
                <div class="p-3 bg-light rounded">${e.description}</div></div>` : ''}
            <div class="row g-3">
                <div class="col-sm-6"><div class="info-label">Start Date</div><div>${e.start_date_fmt}</div></div>
                <div class="col-sm-6"><div class="info-label">End Date</div><div>${e.end_date_fmt}</div></div>
                <div class="col-sm-6"><div class="info-label">Location</div><div>${e.location ?? 'TBD'}</div></div>
                <div class="col-sm-6"><div class="info-label">Max Participants</div><div>${e.max_participants ?? 'Unlimited'}</div></div>
                <div class="col-sm-6">
                    <div class="info-label">Status</div>
                    <span class="badge" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f);">${e.status.charAt(0).toUpperCase()+e.status.slice(1)}</span>
                </div>
                <div class="col-sm-6"><div class="info-label">Created By</div><div>${e.creator_name}</div></div>
                <div class="col-sm-6"><div class="info-label">Created</div><div>${e.created_at}</div></div>
            </div>`;
        document.getElementById('viewToEditBtn').onclick = () => {
            bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
            setTimeout(() => openEditModal(id), 350);
        };
    })
    .catch(err => {
        document.getElementById('viewModalBody').innerHTML =
            `<div class="alert alert-danger m-3"><i class="bi bi-x-circle me-2"></i>Failed to load. (${err.message})</div>`;
    });
}

function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editModalBody').innerHTML =
        `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
    modal.show();
    fetch(routeFor('show', id), { headers: { 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' } })
    .then(r => { if (!r.ok) throw new Error('HTTP '+r.status); return r.json(); })
    .then(e => {
        const statusOpts = ['upcoming','ongoing','completed','cancelled'].map(s =>
            `<option value="${s}" ${e.status===s?'selected':''}>${s.charAt(0).toUpperCase()+s.slice(1)}</option>`
        ).join('');
        document.getElementById('editModalBody').innerHTML = `
            <form method="POST" action="${routeFor('update', e.id)}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="${e.title}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Description</label>
                        <textarea name="description" rows="3" class="form-control">${e.description ?? ''}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Start Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_date" class="form-control"
                               value="${e.start_date_input}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">End Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_date" class="form-control"
                               value="${e.end_date_input}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Location</label>
                        <input type="text" name="location" class="form-control"
                               value="${e.location ?? ''}" placeholder="e.g. Main Hall">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Max Participants</label>
                        <input type="number" name="max_participants" class="form-control"
                               value="${e.max_participants ?? ''}" min="1" placeholder="Unlimited">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">${statusOpts}</select>
                    </div>
                </div>
                <hr class="my-3">
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-add-event fw-semibold">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>`;
    })
    .catch(err => {
        document.getElementById('editModalBody').innerHTML =
            `<div class="alert alert-danger m-3"><i class="bi bi-x-circle me-2"></i>Failed to load. (${err.message})</div>`;
    });
}

function openDeleteModal(id, title) {
    document.getElementById('deleteEventTitle').textContent = title;
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
</body>
</html>