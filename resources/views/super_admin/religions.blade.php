<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religions – SRIMS | Super Admin Dashboard</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <style>
        /* ============================================
           GLOBAL STYLES
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
        
        /* Add New Religion Button Style */
        .btn-add-religion {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 14px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(26,60,94,0.2);
            border: none;
        }
        
        .btn-add-religion:hover {
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
        
        .action-btn-toggle {
            background: #e2e8f0;
            color: #64748b;
        }
        
        .action-btn-toggle:hover {
            background: #64748b;
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
        
        /* Religion Logo */
        .religion-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
            padding: 4px;
            border: 1px solid #dee2e6;
        }
        
        .religion-logo-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 1.4rem;
        }
        
        /* Badge Styles */
        .badge {
            padding: 0.35rem 0.75rem;
            font-weight: 600;
            font-size: 0.7rem;
            letter-spacing: 0.3px;
            border-radius: 30px;
        }
        
        .badge-status-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .badge-status-inactive {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        
        .badge-members {
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
        
        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
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
            width: 80px;
        }
        
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 180px;
        }
        
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 280px;
        }
        
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 100px;
        }
        
        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 100px;
        }
        
        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 110px;
        }
        
        .table th:last-child,
        .table td:last-child {
            width: 140px;
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
                        <h3 class="fw-bold mb-0">Religions</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Super Admin</a></li>
                            <li class="breadcrumb-item active">Religions</li>
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
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Manage all religions in the system</small>
                    </div>
                    <button class="btn btn-add-religion" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-2"></i>Add Religion
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
                                    <i class="bi bi-book-fill"></i>
                                </div>
                                <div>
                                    <div class="stat-value">{{ $religions->total() }}</div>
                                    <div class="stat-label">Total Religions</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(5,150,105,0.05)); color: #10b981;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div>
                                    <div class="stat-value">
                                        {{ $religions->getCollection()->where('status','active')->count() }}
                                    </div>
                                    <div class="stat-label">Active</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon" style="background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(220,38,38,0.05)); color: #ef4444;">
                                    <i class="bi bi-x-circle-fill"></i>
                                </div>
                                <div>
                                    <div class="stat-value">
                                        {{ $religions->getCollection()->where('status','inactive')->count() }}
                                    </div>
                                    <div class="stat-label">Inactive</div>
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
                                        {{ $religions->getCollection()->sum('users_count') }}
                                    </div>
                                    <div class="stat-label">Total Members</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Religions Table -->
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="bi bi-book me-2"></i>Religions List
                            <span class="badge bg-white text-primary ms-2 rounded-pill">{{ $religions->total() }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="religionsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 8%;">Logo</th>
                                        <th style="width: 20%;">Name</th>
                                        <th style="width: 35%;">Description</th>
                                        <th style="width: 12%;">Members</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">Created</th>
                                        <th style="width: 10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($religions as $religion)
                                    <tr>
                                        <td class="ps-3 text-muted small fw-semibold">
                                            {{ ($religions->currentPage() - 1) * $religions->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            @if($religion->logo)
                                                <img src="{{ asset('storage/' . $religion->logo) }}"
                                                     alt="{{ $religion->name }}" class="religion-logo">
                                            @else
                                                <div class="religion-logo-placeholder">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-semibold" style="color: #1e293b;">{{ $religion->name }}</td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $religion->description
                                                    ? Str::limit($religion->description, 80)
                                                    : '–' }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-members">
                                                {{ $religion->users_count }} users
                                            </span>
                                        </td>
                                        <td>
                                            @if($religion->status === 'active')
                                                <span class="badge badge-status-active">Active</span>
                                            @else
                                                <span class="badge badge-status-inactive">Inactive</span>
                                            @endif
                                        </td>
                                        <td><small class="text-muted">{{ $religion->created_at->format('d M Y') }}</small></td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="action-btn action-btn-view" title="View"
                                                        onclick="openViewModal({{ $religion->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="action-btn action-btn-edit" title="Edit"
                                                        onclick="openEditModal({{ $religion->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('super_admin.religions.toggle-status', $religion) }}"
                                                      method="POST" style="display:inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="action-btn action-btn-toggle"
                                                            title="{{ $religion->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                                        <i class="bi {{ $religion->status === 'active' ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                                                    </button>
                                                </form>
                                                <button class="action-btn action-btn-delete" title="Delete"
                                                        onclick="openDeleteModal({{ $religion->id }}, '{{ addslashes($religion->name) }}', {{ $religion->users_count }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="bi bi-book fs-1 d-block mb-2 opacity-25"></i>
                                            No religions found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($religions->hasPages())
                        <div class="d-flex justify-content-center py-4">
                            {{ $religions->links() }}
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

<!-- Create Religion Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Add New Religion
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('super_admin.religions.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Religion Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="e.g., Islam, Christianity">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Brief description (optional)">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Logo / Icon</label>
                            <input type="file" name="logo" accept="image/*"
                                   class="form-control @error('logo') is-invalid @enderror"
                                   onchange="previewImage(this, 'createLogoPreview')">
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="mt-2" id="createLogoPreview"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="active"   {{ old('status', 'active') == 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-check-circle me-1"></i>Create Religion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Religion Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-book me-2"></i>Religion Details
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

<!-- Edit Religion Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-pencil me-2"></i>Edit Religion
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

<!-- Delete Religion Modal -->
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
                <i class="bi bi-book text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to delete</p>
                <h5 class="fw-bold text-danger" id="deleteReligionName"></h5>
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
const routes = {
    show: '{{ route('super_admin.religions.show', '__ID__') }}',
    update: '{{ route('super_admin.religions.update', '__ID__') }}',
    destroy: '{{ route('super_admin.religions.destroy', '__ID__') }}',
};

function routeFor(name, id) {
    return routes[name].replace('__ID__', id);
}

// Logo Preview
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `
                <img src="${e.target.result}"
                     style="width:80px;height:80px;object-fit:contain;border-radius:8px;
                            border:1px solid #dee2e6;background:#f8f9fa;padding:4px;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// DataTable Initialization
$(document).ready(function() {
    $('#religionsTable').DataTable({
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
            { targets: 1, orderable: false },
            { targets: 2, orderable: true },
            { targets: 3, orderable: false },
            { targets: 4, orderable: true },
            { targets: 5, orderable: true },
            { targets: 6, orderable: true },
            { targets: 7, orderable: false }
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
    
    fetch(routeFor('show', id), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(r => {
        document.getElementById('viewModalBody').innerHTML = buildViewHTML(r);
        document.getElementById('viewToEditBtn').onclick = () => {
            bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
            setTimeout(() => openEditModal(id), 350);
        };
    })
    .catch(() => {
        document.getElementById('viewModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load religion data.</div>';
    });
}

function buildViewHTML(r) {
    const logoHTML = r.logo
        ? `<img src="${r.logo}" style="width:80px;height:80px;object-fit:contain;border-radius:10px;border:1px solid #dee2e6;background:#f8f9fa;padding:6px;">`
        : `<div style="width:80px;height:80px;border-radius:10px;background:#e9ecef;display:flex;align-items:center;justify-content:center;color:#adb5bd;font-size:2rem;"><i class="bi bi-book"></i></div>`;
    
    const statusBadge = r.status === 'active'
        ? `<span class="badge badge-status-active">Active</span>`
        : `<span class="badge badge-status-inactive">Inactive</span>`;
    
    return `
        <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3">
            ${logoHTML}
            <div>
                <h5 class="mb-0 fw-bold" style="color: #1e293b;">${r.name}</h5>
                <div class="mt-1">${statusBadge}</div>
                <small class="text-muted">${r.users_count} member(s)</small>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <div class="info-label">Description</div>
                <div>${r.description ?? '–'}</div>
            </div>
            <div class="col-sm-6">
                <div class="info-label">Status</div>
                ${statusBadge}
            </div>
            <div class="col-sm-6">
                <div class="info-label">Total Members</div>
                <div>${r.users_count} users</div>
            </div>
            <div class="col-sm-6">
                <div class="info-label">Created</div>
                <div>${r.created_at}</div>
            </div>
            <div class="col-sm-6">
                <div class="info-label">Last Updated</div>
                <div>${r.updated_at}</div>
            </div>
        </div>`;
}

// Edit Modal
function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    
    fetch(routeFor('show', id), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(r => {
        document.getElementById('editModalBody').innerHTML = buildEditHTML(r);
    })
    .catch(() => {
        document.getElementById('editModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load religion data.</div>';
    });
}

function buildEditHTML(r) {
    const logoPreview = r.logo
        ? `<div class="mt-2"><small class="text-muted d-block mb-1">Current logo:</small><img src="${r.logo}" id="editLogoPreview" style="width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid #dee2e6;background:#f8f9fa;padding:4px;"></div>`
        : `<div class="mt-2" id="editLogoPreviewWrap"></div>`;
    
    return `
        <form method="POST" action="${routeFor('update', r.id)}" id="editForm" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="${csrfToken}">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Religion Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="${r.name}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Brief description (optional)">${r.description ?? ''}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Logo / Icon</label>
                    <input type="file" name="logo" accept="image/*" class="form-control" onchange="previewEditLogo(this)">
                    <small class="text-muted">Leave empty to keep current logo.</small>
                    ${logoPreview}
                </div>
                <div class="col-12">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select">
                        <option value="active" ${r.status === 'active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${r.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                    </select>
                </div>
            </div>
            <hr class="my-3">
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save me-1"></i>Save Changes</button>
            </div>
        </form>`;
}

function previewEditLogo(input) {
    const existing = document.getElementById('editLogoPreview');
    const wrap = document.getElementById('editLogoPreviewWrap');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const imgHTML = `<img src="${e.target.result}" style="width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid #dee2e6;background:#f8f9fa;padding:4px;margin-top:8px;">`;
            if (existing) existing.outerHTML = imgHTML;
            else if (wrap) wrap.innerHTML = imgHTML;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Delete Modal
function openDeleteModal(id, name, usersCount) {
    document.getElementById('deleteReligionName').textContent = name;
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    
    const warning = document.getElementById('deleteWarning');
    const submitBtn = document.getElementById('deleteSubmitBtn');
    
    if (usersCount > 0) {
        warning.innerHTML = `<div class="alert alert-warning mt-2 mb-0 py-2 rounded-3"><i class="bi bi-exclamation-triangle me-1"></i>This religion has <strong>${usersCount} assigned user(s)</strong> and cannot be deleted.</div>`;
        submitBtn.disabled = true;
    } else {
        warning.innerHTML = `<small class="text-muted">This action will soft-delete and can be recovered later.</small>`;
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