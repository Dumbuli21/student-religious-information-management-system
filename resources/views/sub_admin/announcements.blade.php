<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements – {{ $religion->name }}</title>
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
        .btn-add-announcement {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border: none;
        }
        .btn-add-announcement:hover { 
            background: linear-gradient(135deg, #2d6a9f, #1a3c5e);
            color: white; 
        }
        
        /* Badge primary */
        .badge.bg-primary {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
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
                            Announcements
                            <span class="badge text-bg-primary" style="font-size:.7rem; background: linear-gradient(135deg, #1a3c5e, #2d6a9f);">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
                            <li class="breadcrumb-item active">Announcements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0">All Announcements</h5>
                        <small class="text-muted">Manage announcements for {{ $religion->name }}</small>
                    </div>
                    <button class="btn btn-add-announcement"
                            data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-2"></i>New Announcement
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
                    <div class="col-6 col-md-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#0d6efd;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-megaphone-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['total'] }}</div>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#198754;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['published'] }}</div>
                                    <small class="text-muted">Published</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#6c757d;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['drafts'] }}</div>
                                    <small class="text-muted">Drafts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table with DataTables --}}
                <div class="card">
                    <div class="card-header py-3 fw-bold">
                        <i class="bi bi-megaphone me-2"></i>Announcements List
                        <span class="badge ms-2" style="background: white; color: #1a3c5e;">{{ $announcements->total() }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="announcementsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Published At</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($announcements as $ann)
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($announcements->currentPage() - 1) * $announcements->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="fw-semibold">{{ $ann->title }}</td>
                                        <td>
                                            @if($ann->is_published)
                                                <span class="badge" style="background: linear-gradient(135deg, #1a3c5e, #2d6a9f);">Published</span>
                                            @else
                                                <span class="badge bg-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $ann->published_at ? $ann->published_at->format('d M Y') : '–' }}
                                            </small>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $ann->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-outline-info" title="View"
                                                        onclick="openViewModal({{ $ann->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Edit"
                                                        onclick="openEditModal({{ $ann->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('sub_admin.announcements.toggle-publish', $ann) }}"
                                                      method="POST" style="display:inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-sm {{ $ann->is_published ? 'btn-outline-secondary' : 'btn-outline-success' }}"
                                                            title="{{ $ann->is_published ? 'Unpublish' : 'Publish' }}">
                                                        <i class="bi {{ $ann->is_published ? 'bi-eye-slash' : 'bi-send-check' }}"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="openDeleteModal({{ $ann->id }}, '{{ addslashes($ann->title) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="bi bi-megaphone fs-1 d-block mb-2 opacity-25"></i>
                                            No announcements yet.
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
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>New Announcement</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('sub_admin.announcements.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="Announcement title">
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Content <span class="text-danger">*</span></label>
                            <textarea name="content" rows="6"
                                      class="form-control @error('content') is-invalid @enderror"
                                      placeholder="Write your announcement here...">{{ old('content') }}</textarea>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Status <span class="text-danger">*</span></label>
                            <select name="is_published" class="form-select">
                                <option value="0" {{ old('is_published','0') == '0' ? 'selected':'' }}>Save as Draft</option>
                                <option value="1" {{ old('is_published') == '1' ? 'selected':'' }}>Publish Now</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-add-announcement fw-semibold">
                        <i class="bi bi-send me-1"></i>Save Announcement
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
                <h6 class="modal-title fw-bold"><i class="bi bi-megaphone me-2"></i>Announcement Details</h6>
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
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2"></i>Edit Announcement</h6>
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
                <i class="bi bi-megaphone text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to delete</p>
                <h5 class="fw-bold" id="deleteAnnTitle"></h5>
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
    show:    '{{ route('sub_admin.announcements.show',   '__ID__') }}',
    update:  '{{ route('sub_admin.announcements.update', '__ID__') }}',
    destroy: '{{ route('sub_admin.announcements.destroy','__ID__') }}',
};
function routeFor(name, id) { return routes[name].replace('__ID__', id); }

// DataTable Initialization
$(document).ready(function() {
    $('#announcementsTable').DataTable({
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
    .then(a => {
        document.getElementById('viewModalBody').innerHTML = `
            <div class="mb-3"><div class="info-label">Title</div><h5 class="fw-bold">${a.title}</h5></div>
            <div class="mb-3">
                <div class="info-label">Content</div>
                <div class="p-3 bg-light rounded" style="white-space:pre-wrap;">${a.content}</div>
            </div>
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="info-label">Status</div>
                    <span class="badge ${a.is_published ? 'bg-success':'bg-secondary'}">
                        ${a.is_published ? 'Published':'Draft'}
                    </span>
                </div>
                <div class="col-sm-6"><div class="info-label">Published At</div><div>${a.published_at ?? '–'}</div></div>
                <div class="col-sm-6"><div class="info-label">Created By</div><div>${a.creator_name}</div></div>
                <div class="col-sm-6"><div class="info-label">Created</div><div>${a.created_at}</div></div>
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
    .then(a => {
        document.getElementById('editModalBody').innerHTML = `
            <form method="POST" action="${routeFor('update', a.id)}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="${a.title}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Content <span class="text-danger">*</span></label>
                        <textarea name="content" rows="6" class="form-control" required>${a.content}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Status <span class="text-danger">*</span></label>
                        <select name="is_published" class="form-select">
                            <option value="0" ${!a.is_published?'selected':''}>Save as Draft</option>
                            <option value="1" ${a.is_published?'selected':''}>Publish Now</option>
                        </select>
                    </div>
                </div>
                <hr class="my-3">
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-add-announcement fw-semibold">
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
    document.getElementById('deleteAnnTitle').textContent = title;
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
</body>
</html>