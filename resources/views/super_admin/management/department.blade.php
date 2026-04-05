<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments – SRIMS | Super Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <style>
        /* ============================================
           GLOBAL STYLES - SAME AS USERS PAGE
        ============================================ */
        body {
            background: #f5f7fb;
            font-family: 'Source Sans 3', sans-serif;
        }
        
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
            color: white;
            flex-shrink: 0;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }
        
        .card-header {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }
        
        .table th {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6c757d;
            background: #f8fafc;
            padding: 1rem 0.75rem;
            white-space: nowrap;
        }
        
        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: #fefce8;
        }
        
        .bg-opacity-10 {
            --bs-bg-opacity: 0.1;
        }
        
        .info-label {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6c757d;
            margin-bottom: 2px;
        }
        
        /* ============================================
           MODAL STYLES
        ============================================ */
        .modal-header {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        .modal-content {
            border: none;
            border-radius: 12px;
        }
        
        /* ============================================
           DATATABLES CUSTOM STYLES
        ============================================ */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin-left: 0;
            border-radius: 0.375rem;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #1a3c5e;
            color: white !important;
            border-color: #1a3c5e;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 8px 12px;
        }
        
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 8px 12px;
        }
        
        /* Add New Department Button Style */
        .btn-add-department {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 14px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(26,60,94,0.2);
            border: none;
        }
        
        .btn-add-department:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26,60,94,0.3);
            color: white;
            background: linear-gradient(135deg, #2d6a9f, #1a3c5e);
        }
        
        /* Action Buttons */
        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
        }
        
        .action-btn-view {
            background: #eef2ff;
            color: #3b82f6;
        }
        
        .action-btn-view:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
        }
        
        .action-btn-edit {
            background: #fef3c7;
            color: #f59e0b;
        }
        
        .action-btn-edit:hover {
            background: #f59e0b;
            color: white;
            transform: translateY(-2px);
        }
        
        .action-btn-delete {
            background: #fee2e2;
            color: #ef4444;
        }
        
        .action-btn-delete:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Badge Styles */
        .badge {
            padding: 0.35rem 0.75rem;
            font-weight: 600;
            font-size: 0.7rem;
            letter-spacing: 0.3px;
            border-radius: 30px;
        }
        
        .badge-programmes {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .badge-users {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.25rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        }
        
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 600;
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        /* Form Styles */
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #2d6a9f;
            box-shadow: 0 0 0 3px rgba(45,106,159,0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26,60,94,0.3);
        }
        
        /* Table column widths */
        .table th:first-child,
        .table td:first-child {
            width: 60px;
        }
        
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 300px;
        }
        
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 120px;
        }
        
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 100px;
        }
        
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 110px;
        }

    /* Hide notification icon on this page only */
    .navbar-nav .bi-bell,
    .navbar-nav .dropdown-toggle .bi-bell,
    .nav-item.dropdown .bi-bell {
        display: none !important;
    }
    
    /* Also hide any badge associated with notifications */
    .navbar-nav .badge {
        display: none !important;
    }
        
        .table th:last-child,
        .table td:last-child {
            width: 110px;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    
    @include('includes.header')
    
    <!-- ============================================
         SIDEBAR NAVIGATION - SAME AS USERS PAGE
    ============================================ -->
    @include('includes.super_admin_sidebar')
    
    <!-- ============================================
         MAIN CONTENT
    ============================================ -->
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="fw-bold mb-0">Departments</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Super Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Management</a></li>
                            <li class="breadcrumb-item active">Departments</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="app-content">
            <div class="container-fluid">
                
                <!-- Page Header - Same style as users page -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Manage all academic departments and their programmes</small>
                    </div>
                    <button class="btn btn-add-department" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Department
                    </button>
                </div>
                
                <!-- Alerts -->
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
                
                <!-- Statistics Cards - Same style as users page -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(26,60,94,0.1), rgba(45,106,159,0.1)); color: #1a3c5e;">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div>
                                    <div class="stat-value">{{ $departments->total() }}</div>
                                    <div class="stat-label">Total Departments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(5,150,105,0.05)); color: #10b981;">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                                <div>
                                    <div class="stat-value">
                                        {{ $departments->getCollection()->sum('programmes_count') }}
                                    </div>
                                    <div class="stat-label">Total Programmes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(111,66,193,0.1), rgba(111,66,193,0.05)); color: #6f42c1;">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div>
                                    <div class="stat-value">
                                        {{ $departments->getCollection()->sum('users_count') }}
                                    </div>
                                    <div class="stat-label">Total Users</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(32,201,151,0.1), rgba(32,201,151,0.05)); color: #20c997;">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div>
                                    <div class="stat-value">
                                        {{ $departments->count() > 0 ? round($departments->getCollection()->avg('programmes_count')) : 0 }}
                                    </div>
                                    <div class="stat-label">Avg Programmes/Dept</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Departments Table -->
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="bi bi-building me-2"></i>Departments List
                            <span class="badge bg-white text-primary ms-2 rounded-pill">{{ $departments->total() }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="departmentsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 45%;">Department Name</th>
                                        <th style="width: 15%;">Programmes</th>
                                        <th style="width: 12%;">Users</th>
                                        <th style="width: 10%;">Created</th>
                                        <th style="width: 13%;">Actions</th>
                                    </thead>
                                <tbody>
                                    @forelse($departments as $dept)
                                    <tr>
                                        <td class="ps-3 text-muted small fw-semibold">
                                            {{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="fw-semibold" style="color: #1e293b;">{{ $dept->name }}</td>
                                        <td>
                                            <span class="badge badge-programmes">
                                                <i class="bi bi-journal-bookmark me-1"></i>{{ $dept->programmes_count }} programme(s)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-users">
                                                <i class="bi bi-people me-1"></i>{{ $dept->users_count }} user(s)
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $dept->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="action-btn action-btn-view" title="View"
                                                        onclick="openViewModal({{ $dept->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="action-btn action-btn-edit" title="Edit"
                                                        onclick="openEditModal({{ $dept->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="action-btn action-btn-delete" title="Delete"
                                                        onclick="openDeleteModal({{ $dept->id }}, '{{ addslashes($dept->name) }}', {{ $dept->users_count }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="bi bi-building fs-1 d-block mb-2 opacity-25"></i>
                                            No departments found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($departments->hasPages())
                        <div class="d-flex justify-content-center py-4">
                            {{ $departments->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('includes.footer')
</div>

<!-- ============================================
     MODALS
============================================ -->

<!-- Create Department Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Add New Department
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            {{-- ✅ NEW --}}
                <form method="POST" action="{{ route('super_admin.management.departments.store') }}">       
                @csrf
                <div class="modal-body">
                    <label class="form-label">
                        Department Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="e.g. College of ICT, College of Engineering">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-check-circle me-1"></i>Create Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Department Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-building me-2"></i>Department Details
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                </div>
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

<!-- Edit Department Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-pencil me-2"></i>Edit Department
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Department Modal -->
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
                <i class="bi bi-building text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to delete</p>
                <h5 class="fw-bold text-danger" id="deleteDeptName"></h5>
                <div id="deleteWarning"></div>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-4"
                        data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-semibold" id="deleteSubmitBtn">
                        <i class="bi bi-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
const csrfToken = '{{ csrf_token() }}';
// ✅ NEW
const routes = {
    show:    '{{ route('super_admin.management.departments.show',   '__ID__') }}',
    update:  '{{ route('super_admin.management.departments.update', '__ID__') }}',
    destroy: '{{ route('super_admin.management.departments.destroy','__ID__') }}',
};

function routeFor(name, id) {
    return routes[name].replace('__ID__', id);
}

// DataTable Initialization
$(document).ready(function() {
    $('#departmentsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        autoWidth: false,
        language: {
            paginate: {
                first: "« First",
                previous: "‹ Prev",
                next: "Next ›",
                last: "Last »"
            },
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)"
        },
        columnDefs: [
            { targets: 0, orderable: true },
            { targets: 1, orderable: true },
            { targets: 2, orderable: true },
            { targets: 3, orderable: true },
            { targets: 4, orderable: true },
            { targets: 5, orderable: false }
        ]
    });
    
    @if($errors->any())
    new bootstrap.Modal(document.getElementById('createModal')).show();
    @endif
});

// View Modal
function openViewModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    document.getElementById('viewModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    
    fetch(routeFor('show', id), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(d => {
        document.getElementById('viewModalBody').innerHTML = `
            <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3">
                <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#1a3c5e,#2d6a9f);display:flex;align-items:center;justify-content:center;font-size:1.6rem;font-weight:700;color:white;">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold" style="color: #1e293b;">${d.name}</h5>
                    <span class="badge badge-programmes mt-1">${d.programmes_count} programmes</span>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="info-label">Department Name</div>
                    <div class="fw-semibold fs-5">${d.name}</div>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">Programmes</div>
                    <span class="badge badge-programmes">${d.programmes_count} programme(s)</span>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">Users</div>
                    <span class="badge badge-users">${d.users_count} user(s)</span>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">Created</div>
                    <div>${d.created_at}</div>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">Last Updated</div>
                    <div>${d.updated_at}</div>
                </div>
            </div>`;
        
        document.getElementById('viewToEditBtn').onclick = () => {
            bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
            setTimeout(() => openEditModal(id), 350);
        };
    })
    .catch(() => {
        document.getElementById('viewModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load data.</div>';
    });
}

// Edit Modal
function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    
    fetch(routeFor('show', id), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(d => {
        document.getElementById('editModalBody').innerHTML = `
            <form method="POST" action="${routeFor('update', d.id)}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="mb-3">
                    <label class="form-label">Department Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="${d.name.replace(/"/g, '&quot;')}" required>
                </div>
                <hr class="my-3">
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save me-1"></i>Save Changes</button>
                </div>
            </form>`;
    })
    .catch(() => {
        document.getElementById('editModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load data.</div>';
    });
}

// Delete Modal
function openDeleteModal(id, name, usersCount) {
    document.getElementById('deleteDeptName').textContent = name;
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    
    const warning = document.getElementById('deleteWarning');
    const submitBtn = document.getElementById('deleteSubmitBtn');
    
    if (usersCount > 0) {
        warning.innerHTML = `
            <div class="alert alert-warning mt-2 mb-0 py-2 rounded-3">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Has <strong>${usersCount} assigned user(s)</strong> — cannot be deleted.
            </div>`;
        submitBtn.disabled = true;
    } else {
        warning.innerHTML = `<small class="text-muted">This will soft-delete and can be recovered later.</small>`;
        submitBtn.disabled = false;
    }
    
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Auto-hide alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.transition = "opacity 0.5s ease";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>
</body>
</html>