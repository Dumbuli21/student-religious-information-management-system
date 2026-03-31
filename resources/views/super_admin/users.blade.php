<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRIMS | Super Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="color-scheme" content="light dark" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<style>
    /* ============================================
       GLOBAL STYLES
    ============================================ */
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
        white-space: nowrap;
    }
    
    .table td {
        white-space: nowrap;
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


    /* Add New User Button Style */
.btn-add-user {
    background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
    color: white;
    border-radius: 14px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(26,60,94,0.2);
    border: none;
}

.btn-add-user:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26,60,94,0.3);
    color: white;
    background: linear-gradient(135deg, #2d6a9f, #1a3c5e);
}

.btn-add-user:active {
    transform: translateY(0);
}
    
    /* Hide columns that are not needed in the main view */
    .hidden-column {
        display: none;
    }
    
    /* Table column width control */
    .table th:first-child,
    .table td:first-child {
        width: 50px;
    }
    
    .table th:nth-child(2),
    .table td:nth-child(2) {
        min-width: 200px;
        max-width: 250px;
    }
    
    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 120px;
    }
    
    .table th:nth-child(4),
    .table td:nth-child(4) {
        width: 110px;
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
         SIDEBAR NAVIGATION
    ============================================ -->
    <aside class="app-sidebar shadow" style="background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="#" class="brand-link d-flex align-items-center gap-2 py-3 px-3 text-white text-decoration-none">
                <i class="bi bi-shield-fill-check fs-4"></i>
                <div class="brand-text-wrapper">
                    <span class="brand-text fw-light fs-5">SRIMS</span>
                </div>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
                    <li class="nav-header text-white-50">SUPER ADMIN</li>
                    <li class="nav-item">
                        <a href="{{ route('super_admin.dashboard') }}" class="nav-link text-white-75">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p class="nav-text">Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white-75 active">
                            <i class="nav-icon bi bi-people"></i>
                            <p class="nav-text">Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white-75">
                            <i class="nav-icon bi bi-globe2"></i>
                            <p class="nav-text">Religions</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white-75">
                            <i class="nav-icon bi bi-box-seam-fill"></i>
                            <p class="nav-text">Management <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white-75">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="nav-text">Department</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white-75">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="nav-text">Programme</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white-75">
                            <i class="nav-icon bi bi-graph-up"></i>
                            <p class="nav-text">Reports</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white-75">
                            <i class="nav-icon bi bi-clock-history"></i>
                            <p class="nav-text">Activity Logs</p>
                        </a>
                    </li>
                    <li class="nav-header text-white-50 mt-3">ACCOUNT</li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent text-white-75">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p class="nav-text">Logout</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    
    <!-- ============================================
         MAIN CONTENT
    ============================================ -->
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="fw-bold mb-0">All Users</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Super Admin</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="app-content">
            <div class="container-fluid">
                
                <!-- Page Header -->
               <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Total users across all roles and departments</small>
    </div>
    <button class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="bi bi-person-plus me-2"></i>Add New User
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
                    <i class="bi bi-x-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <!-- Statistics Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-primary"><i class="bi bi-people-fill"></i></div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $users->total() }}</div>
                                    <small class="text-muted">Total Users</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-success"><i class="bi bi-mortarboard-fill"></i></div>
                                <div>
                                    <div class="fw-bold fs-5">
                                        {{ $users->getCollection()->filter(fn($u) => $u->role?->name === 'student')->count() }}
                                    </div>
                                    <small class="text-muted">Students</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-warning"><i class="bi bi-shield-fill"></i></div>
                                <div>
                                    <div class="fw-bold fs-5">
                                        {{ $users->getCollection()->filter(fn($u) => in_array($u->role?->name, ['super_admin','religious_admin','sub_admin']))->count() }}
                                    </div>
                                    <small class="text-muted">Admins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-danger"><i class="bi bi-person-fill-slash"></i></div>
                                <div>
                                    <div class="fw-bold fs-5">
                                        {{ $users->getCollection()->where('is_active', false)->count() }}
                                    </div>
                                    <small class="text-muted">Inactive</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Users Table -->
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="bi bi-people me-2"></i>Users List
                            <span class="badge bg-white text-primary ms-2">{{ $users->total() }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="usersTable" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 35%;">Name</th>
                                        <th style="width: 18%;">Student No.</th>
                                        <th style="width: 18%;">Role</th>
                                        <th class="hidden-column">Religion</th>
                                        <th class="hidden-column">Region</th>
                                        <th class="hidden-column">Academic Info</th>
                                        <th class="hidden-column">Status</th>
                                        <th class="hidden-column">Pwd</th>
                                        <th style="width: 24%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $u)
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar" style="background:{{ $u->gender === 'female' ? '#e91e8c' : '#1a3c5e' }}">
                                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $u->name }}</div>
                                                    <small class="text-muted">{{ $u->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><code>{{ $u->student_number }}</code></td>
                                        <td>
                                            @php
                                                $roleColors = [
                                                    'super_admin' => 'danger',
                                                    'religious_admin' => 'warning',
                                                    'sub_admin' => 'info',
                                                    'student' => 'primary',
                                                ];
                                                $color = $roleColors[$u->role?->name] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }}" style="font-size:.75rem;">
                                                {{ ucwords(str_replace('_', ' ', $u->role?->name ?? '–')) }}
                                            </span>
                                        </td>
                                        <td class="hidden-column">{{ $u->religion?->name ?? '–' }}</td>
                                        <td class="hidden-column">{{ $u->region?->name ?? '–' }}</td>
                                        <td class="hidden-column"><small class="text-muted">{{ $u->academicInfo() ?? '–' }}</small></td>
                                        <td class="hidden-column">
                                            @if($u->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="hidden-column text-center">
                                            @if($u->password_changed)
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                            @else
                                                <i class="bi bi-clock-fill text-warning"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-outline-info" title="View" onclick="openViewModal({{ $u->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Edit" onclick="openEditModal({{ $u->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="openDeleteModal({{ $u->id }}, '{{ addslashes($u->name) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="bi bi-people fs-1 d-block mb-2 opacity-25"></i>
                                            No users found.
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

<!-- ============================================
     MODALS (Same as original - kept for functionality)
============================================ -->

<!-- Create User Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-person-plus me-2"></i>Create New User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('super_admin.users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Amina Joseph">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Student Number <span class="text-danger">*</span></label>
                            <input type="text" name="student_number" class="form-control @error('student_number') is-invalid @enderror" value="{{ old('student_number') }}" placeholder="e.g. BT25001">
                            @error('student_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="e.g. amina@sris.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">-- Select --</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $role->name === 'student' ? $role->id : '') == $role->id ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Religion</label>
                            <select name="religion_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach($religions as $religion)
                                <option value="{{ $religion->id }}" {{ old('religion_id') == $religion->id ? 'selected' : '' }}>
                                    {{ $religion->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Region</label>
                            <select name="region_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Level of Study</label>
                            <select name="level_id" class="form-select">
                                <option value="">-- Select Level --</option>
                                @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Year of Study</label>
                            <select name="year_of_study" class="form-select">
                                <option value="">-- Select Year --</option>
                                @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ old('year_of_study', 1) == $i ? 'selected' : '' }}>
                                    Year {{ $i }}
                                </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Department</label>
                            <select name="department_id" id="create_department_id" class="form-select">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Programme</label>
                            <select name="programme_id" id="create_programme_id" class="form-select">
                                <option value="">-- Select Programme --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="07xxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Login Behaviour <span class="text-danger">*</span></label>
                            <select name="password_changed" class="form-select">
                                <option value="0" {{ old('password_changed', '0') == '0' ? 'selected' : '' }}>Force change password on first login</option>
                                <option value="1" {{ old('password_changed') == '1' ? 'selected' : '' }}>Go directly to dashboard</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-person-check me-2"></i>Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View User Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-person me-2"></i>User Profile
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
                    <i class="bi bi-pencil me-1"></i>Edit This User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-pencil me-2"></i>Edit User
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

<!-- Delete User Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#c0392b,#e74c3c);">
                <h6 class="modal-title fw-bold text-white">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:brightness(0) invert(1)"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-person-fill-dash text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to delete</p>
                <h5 class="fw-bold" id="deleteUserName"></h5>
                <small class="text-muted">This action soft-deletes the user and can be recovered later.</small>
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

<!-- Reset Password Modal -->
<div class="modal fade" id="resetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-key me-2"></i>Reset Password
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-key-fill text-warning" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Reset password for</p>
                <h5 class="fw-bold" id="resetUserName"></h5>
                <small class="text-muted">Password will be reset to <strong>must123</strong></small>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="resetForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning px-4 fw-semibold">
                        <i class="bi bi-key me-1"></i>Yes, Reset
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     SCRIPTS
============================================ -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
// ============================================
// DATA FROM LARAVEL
// ============================================
const allProgrammes = @json($programmes ?? []);
const allRoles = @json($roles ?? []);
const allReligions = @json($religions ?? []);
const allRegions = @json($regions ?? []);
const allLevels = @json($levels ?? []);
const allDepts = @json($departments ?? []);
const csrfToken = '{{ csrf_token() }}';

// ============================================
// ROUTES
// ============================================
const routes = {
    show: '{{ route('super_admin.users.show', '__ID__') }}',
    update: '{{ route('super_admin.users.update', '__ID__') }}',
    destroy: '{{ route('super_admin.users.destroy', '__ID__') }}',
    resetPassword: '{{ route('super_admin.users.reset-password', '__ID__') }}',
};

function routeFor(name, id) {
    return routes[name].replace('__ID__', id);
}

// ============================================
// CASCADING PROGRAMMES
// ============================================
function bindCascade(deptId, progId, selectedProgId = null) {
    const deptEl = document.getElementById(deptId);
    const progEl = document.getElementById(progId);
    if (!deptEl || !progEl) return;
    
    function filter() {
        const val = deptEl.value;
        progEl.innerHTML = '<option value="">-- Select Programme --</option>';
        if (!val) return;
        if (allProgrammes && allProgrammes.length > 0) {
            allProgrammes
                .filter(p => p.department_id == val)
                .forEach(p => {
                    const o = document.createElement('option');
                    o.value = p.id;
                    o.textContent = p.name;
                    if (selectedProgId && p.id == selectedProgId) o.selected = true;
                    progEl.appendChild(o);
                });
        }
    }
    deptEl.addEventListener('change', filter);
    filter();
}

// ============================================
// DATATABLES INITIALIZATION
// ============================================
$(document).ready(function() {
    $('#usersTable').DataTable({
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
            { targets: 0, width: "5%", orderable: true },
            { targets: 1, width: "35%", orderable: true },
            { targets: 2, width: "18%", orderable: true },
            { targets: 3, width: "18%", orderable: true },
            { targets: 9, width: "24%", orderable: false },
            { targets: [4, 5, 6, 7, 8], visible: false }
        ],
        scrollX: false,
        responsive: true
    });
    
    // Auto-hide alerts
    setTimeout(() => {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) successAlert.remove();
        let errorAlert = document.getElementById('error-alert');
        if (errorAlert) errorAlert.remove();
    }, 3000);
    
    // Cascade for create modal
    if (document.getElementById('create_department_id')) {
        bindCascade('create_department_id', 'create_programme_id');
    }
    
    @if($errors->any())
    new bootstrap.Modal(document.getElementById('createModal')).show();
    @endif
});

// ============================================
// VIEW MODAL FUNCTIONS
// ============================================
function openViewModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    document.getElementById('viewModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    
    fetch(routeFor('show', id), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(u => {
        document.getElementById('viewModalBody').innerHTML = buildViewHTML(u);
        document.getElementById('viewToEditBtn').onclick = () => {
            bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide();
            setTimeout(() => openEditModal(id), 350);
        };
    })
    .catch(() => {
        document.getElementById('viewModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load user data.</div>';
    });
}

function buildViewHTML(u) {
    const genderColor = u.gender === 'female' ? '#e91e8c' : '#1a3c5e';
    return `
        <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3">
            <div style="width:64px;height:64px;border-radius:50%;background:${genderColor};display:flex;align-items:center;justify-content:center;font-size:1.6rem;font-weight:700;color:white;flex-shrink:0;">
                ${u.name.charAt(0).toUpperCase()}
            </div>
            <div>
                <h5 class="mb-0 fw-bold">${u.name}</h5>
                <small class="text-muted">${u.email}</small><br>
                <span class="badge bg-primary bg-opacity-10 text-primary mt-1">${u.role_name ?? '–'}</span>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-sm-6"><div class="info-label">Student Number</div><code>${u.student_number}</code></div>
            <div class="col-sm-6"><div class="info-label">Phone</div><div>${u.phone ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Gender</div><div>${u.gender ? u.gender.charAt(0).toUpperCase() + u.gender.slice(1) : '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Region</div><div>${u.region_name ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Religion</div><div>${u.religion_name ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Account Status</div><span class="badge ${u.is_active ? 'bg-success' : 'bg-danger'}">${u.is_active ? 'Active' : 'Inactive'}</span></div>
            <div class="col-sm-6"><div class="info-label">Level</div><div>${u.level_name ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Department</div><div>${u.department_name ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Programme</div><div>${u.programme_name ?? '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Year of Study</div><div>${u.year_of_study ? 'Year ' + u.year_of_study : '–'}</div></div>
            <div class="col-sm-6"><div class="info-label">Password Changed</div><span class="badge ${u.password_changed ? 'bg-success' : 'bg-warning text-dark'}">${u.password_changed ? 'Yes' : 'Not yet'}</span></div>
            <div class="col-sm-6"><div class="info-label">Created By</div><div>${u.creator_name ?? 'System'}</div></div>
            <div class="col-sm-6"><div class="info-label">Joined</div><div>${u.created_at}</div></div>
            <div class="col-sm-6"><div class="info-label">Last Updated</div><div>${u.updated_at}</div></div>
        </div>`;
}

// ============================================
// EDIT MODAL FUNCTIONS
// ============================================
function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    
    fetch(routeFor('show', id), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(u => {
        document.getElementById('editModalBody').innerHTML = buildEditHTML(u);
        if (document.getElementById('edit_department_id')) {
            bindCascade('edit_department_id', 'edit_programme_id', u.programme_id);
        }
        const resetBtn = document.getElementById('editResetBtn');
        if (resetBtn) {
            resetBtn.onclick = () => {
                bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                setTimeout(() => openResetModal(u.id, u.name), 350);
            };
        }
    })
    .catch(() => {
        document.getElementById('editModalBody').innerHTML = '<div class="alert alert-danger m-3">Failed to load user data.</div>';
    });
}

function buildEditHTML(u) {
    function formatRole(name) {
        return name ? name.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase()) : name;
    }
    
    const roleOptionsFormatted = allRoles.map(r => `<option value="${r.id}" ${r.id == u.role_id ? 'selected' : ''}>${formatRole(r.name)}</option>`).join('');
    const religionOptions = `<option value="">-- None --</option>` + allReligions.map(r => `<option value="${r.id}" ${r.id == u.religion_id ? 'selected' : ''}>${r.name}</option>`).join('');
    const regionOptions = `<option value="">-- None --</option>` + allRegions.map(r => `<option value="${r.id}" ${r.id == u.region_id ? 'selected' : ''}>${r.name}</option>`).join('');
    const levelOptions = `<option value="">-- None --</option>` + allLevels.map(l => `<option value="${l.id}" ${l.id == u.level_id ? 'selected' : ''}>${l.name}</option>`).join('');
    const deptOptions = `<option value="">-- None --</option>` + allDepts.map(d => `<option value="${d.id}" ${d.id == u.department_id ? 'selected' : ''}>${d.name}</option>`).join('');
    const yearOptions = `<option value="">-- None --</option>` + [1,2,3,4].map(i => `<option value="${i}" ${u.year_of_study == i ? 'selected' : ''}>Year ${i}</option>`).join('');
    
    return `
        <form method="POST" action="${routeFor('update', u.id)}" id="editForm">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="${csrfToken}">
            <div class="row g-3">
                <div class="col-12"><label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="${u.name}" required></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Student Number <span class="text-danger">*</span></label><input type="text" name="student_number" class="form-control" value="${u.student_number}" required></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label><input type="email" name="email" class="form-control" value="${u.email}" required></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Gender <span class="text-danger">*</span></label><select name="gender" class="form-select" required><option value="male" ${u.gender === 'male' ? 'selected' : ''}>Male</option><option value="female" ${u.gender === 'female' ? 'selected' : ''}>Female</option></select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Role <span class="text-danger">*</span></label><select name="role_id" class="form-select" required>${roleOptionsFormatted}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Religion</label><select name="religion_id" class="form-select">${religionOptions}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Region</label><select name="region_id" class="form-select">${regionOptions}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Level of Study</label><select name="level_id" class="form-select">${levelOptions}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Year of Study</label><select name="year_of_study" class="form-select">${yearOptions}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Department</label><select name="department_id" id="edit_department_id" class="form-select">${deptOptions}</select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Programme</label><select name="programme_id" id="edit_programme_id" class="form-select"><option value="">-- Select Programme --</option></select></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Phone</label><input type="text" name="phone" class="form-control" value="${u.phone ?? ''}" placeholder="07xxxxxxxx"></div>
                <div class="col-md-6"><label class="form-label fw-semibold small">Account Status <span class="text-danger">*</span></label><select name="is_active" class="form-select"><option value="1" ${u.is_active ? 'selected' : ''}>Active</option><option value="0" ${!u.is_active ? 'selected' : ''}>Inactive</option></select></div>
            </div>
            <hr class="my-3">
            <div class="d-flex justify-content-between align-items-center">
                <button type="button" id="editResetBtn" class="btn btn-outline-secondary"><i class="bi bi-key me-1"></i>Reset Password</button>
                <div class="d-flex gap-2"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save me-1"></i>Save Changes</button></div>
            </div>
        </form>`;
}

// ============================================
// DELETE MODAL FUNCTION
// ============================================
function openDeleteModal(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// ============================================
// RESET PASSWORD MODAL FUNCTION
// ============================================
function openResetModal(id, name) {
    document.getElementById('resetUserName').textContent = name;
    document.getElementById('resetForm').action = routeFor('resetPassword', id);
    new bootstrap.Modal(document.getElementById('resetModal')).show();
}
</script>
</body>
</html>