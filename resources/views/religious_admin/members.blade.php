<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members – {{ $religion->name }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <style>
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,.07); }
        .card-header { border-radius: 12px 12px 0 0 !important; }
        .modal-header { background: linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white; border-radius: 12px 12px 0 0 !important; }
        .modal-header .btn-close { filter: brightness(0) invert(1); }
        .modal-content { border: none; border-radius: 12px; }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; }
        .info-label { font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; margin-bottom: 2px; }
        .avatar { width:36px; height:36px; border-radius:50%; display:flex; align-items:center;
                  justify-content:center; font-weight:700; font-size:.85rem; color:white; flex-shrink:0; }
        
        /* DataTables Custom Styles */
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
        .action-btn-view { background: #eef2ff; color: #3b82f6; }
        .action-btn-view:hover { background: #3b82f6; color: white; transform: translateY(-2px); }
        .action-btn-edit { background: #fef3c7; color: #f59e0b; }
        .action-btn-edit:hover { background: #f59e0b; color: white; transform: translateY(-2px); }
        .action-btn-toggle { background: #e2e8f0; color: #64748b; }
        .action-btn-toggle:hover { background: #64748b; color: white; transform: translateY(-2px); }
        .action-btn-delete { background: #fee2e2; color: #ef4444; }
        .action-btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); }
        
        /* Add Button */
        .btn-add-member {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border-radius: 14px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(26,60,94,0.2);
            border: none;
        }
        .btn-add-member:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,60,94,0.3); color: white; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.religious_admin_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Members
                            <span class="badge text-bg-warning" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
                            <li class="breadcrumb-item active">Members</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Page Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0">All Members</h5>
                        <small class="text-muted">Manage members of {{ $religion->name }}</small>
                    </div>
                    <button class="btn btn-add-member" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-person-plus me-2"></i>Add Member
                    </button>
                </div>

                {{-- Alerts --}}
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
                                <div style="width:40px;height:40px;border-radius:50%;background:#0d6efd;
                                            display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-people-fill"></i>
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
                                <div style="width:40px;height:40px;border-radius:50%;background:#198754;
                                            display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['active'] }}</div>
                                    <small class="text-muted">Active</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#dc3545;
                                            display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-person-fill-slash"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['inactive'] }}</div>
                                    <small class="text-muted">Inactive</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#6f42c1;
                                            display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['students'] }}</div>
                                    <small class="text-muted">Students</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table with DataTables --}}
                <div class="card">
                    <div class="card-header py-3 fw-bold">
                        <i class="bi bi-people me-2"></i>Members List
                        <span class="badge bg-primary ms-2">{{ $members->total() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="membersTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Name</th>
                                        <th>Student No.</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $member)
                                    @php
                                        $roleColors = [
                                            'sub_admin' => 'info',
                                            'student'   => 'primary',
                                        ];
                                        $rc = $roleColors[$member->role?->name] ?? 'secondary';
                                    @endphp
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}
                                        </td>

                                        {{-- Name + Email --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar"
                                                     style="background:{{ $member->gender === 'female' ? '#e91e8c' : '#1a3c5e' }}">
                                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $member->name }}</div>
                                                    <small class="text-muted">{{ $member->email }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Student No --}}
                                        <td><code>{{ $member->student_number }}</code></td>

                                        {{-- Role --}}
                                        <td>
                                            <span class="badge bg-{{ $rc }} bg-opacity-10 text-{{ $rc }}"
                                                  style="font-size:.75rem">
                                                {{ ucwords(str_replace('_', ' ', $member->role?->name ?? '–')) }}
                                            </span>
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="action-btn action-btn-view" title="View"
                                                        onclick="openViewModal({{ $member->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="action-btn action-btn-edit" title="Edit"
                                                        onclick="openEditModal({{ $member->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('religious_admin.members.toggle-status', $member) }}"
                                                      method="POST" style="display:inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="action-btn action-btn-toggle"
                                                            title="{{ $member->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i class="bi {{ $member->is_active ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                                                    </button>
                                                </form>
                                                <button class="action-btn action-btn-delete" title="Delete"
                                                        onclick="openDeleteModal({{ $member->id }}, '{{ addslashes($member->name) }}')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="bi bi-people fs-1 d-block mb-2 opacity-25"></i>
                                            No members found.
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


{{-- MODALS (Keep exactly as original) --}}
<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-person-plus me-2"></i>Add New Member
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('religious_admin.members.store') }}">
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
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $studentRoleId) == $role->id ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Region</label>
                            <select name="region_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Level</label>
                            <select name="level_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Year of Study</label>
                            <select name="year_of_study" class="form-select">
                                <option value="">-- None --</option>
                                @for($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}" {{ old('year_of_study') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Department</label>
                            <select name="department_id" id="create_department_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
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
                                <option value="0" {{ old('password_changed','0') == '0' ? 'selected':'' }}>Force change password on first login</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-person-check me-1"></i>Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-person me-2"></i>Member Profile</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody"><div class="text-center py-5"><div class="spinner-border text-primary"></div></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning fw-semibold" id="viewToEditBtn"><i class="bi bi-pencil me-1"></i>Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2"></i>Edit Member</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editModalBody"><div class="text-center py-5"><div class="spinner-border text-primary"></div></div></div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#c0392b,#e74c3c);">
                <h6 class="modal-title fw-bold text-white"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:brightness(0) invert(1)"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-person-fill-dash text-danger" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Are you sure you want to remove</p>
                <h5 class="fw-bold" id="deleteMemberName"></h5>
                <small class="text-muted">This action soft-deletes and can be recovered later.</small>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-semibold"><i class="bi bi-trash me-1"></i>Yes, Remove</button>
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
                <h6 class="modal-title fw-bold"><i class="bi bi-key me-2"></i>Reset Password</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-key-fill text-warning" style="font-size:3rem"></i>
                <p class="mt-3 mb-1">Reset password for</p>
                <h5 class="fw-bold" id="resetMemberName"></h5>
                <small class="text-muted">Password will be reset to <strong>must123</strong></small>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="resetForm" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning px-4 fw-semibold"><i class="bi bi-key me-1"></i>Yes, Reset</button>
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
// Data from Laravel
const csrfToken     = '{{ csrf_token() }}';
const allProgrammes = @json($programmes);
const allRoles      = @json($roles);
const allLevels     = @json($levels);
const allDepts      = @json($departments);
const allRegions    = @json($regions);
const studentRoleId = {{ $studentRoleId ?? 'null' }};

// Routes
const routes = {
    show:          '{{ route('religious_admin.members.show', '__ID__') }}',
    update:        '{{ route('religious_admin.members.update', '__ID__') }}',
    destroy:       '{{ route('religious_admin.members.destroy', '__ID__') }}',
    resetPassword: '{{ route('religious_admin.members.reset-password','__ID__') }}',
};

function routeFor(name, id) {
    return routes[name].replace('__ID__', id);
}

// DataTable Initialization
$(document).ready(function() {
    if ($('#membersTable tbody tr').length > 0) {
        $('#membersTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            pageLength: 15,
            lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"]],
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
                { targets: 4, orderable: false }
            ]
        });
    }
});

// Cascading Programmes
function bindCascade(deptSelectId, progSelectId, selectedProgId = null) {
    const deptEl = document.getElementById(deptSelectId);
    const progEl = document.getElementById(progSelectId);
    if (!deptEl || !progEl) return;

    function filter() {
        const val = deptEl.value;
        progEl.innerHTML = '<option value="">-- Select Programme --</option>';
        if (!val) return;
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
    deptEl.addEventListener('change', filter);
    filter();
}

// On Page Load
document.addEventListener('DOMContentLoaded', function () {
    bindCascade('create_department_id', 'create_programme_id');
    @if($errors->any()) new bootstrap.Modal(document.getElementById('createModal')).show(); @endif
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, {
            scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
        });
    }
});

// View Modal
function openViewModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    document.getElementById('viewModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    fetch(routeFor('show', id), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
        .then(r => r.json())
        .then(m => {
            const genderColor = m.gender === 'female' ? '#e91e8c' : '#1a3c5e';
            document.getElementById('viewModalBody').innerHTML = `
                <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3">
                    <div style="width:60px;height:60px;border-radius:50%;background:${genderColor};display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;color:white;flex-shrink:0;">${m.name.charAt(0).toUpperCase()}</div>
                    <div><h5 class="mb-0 fw-bold">${m.name}</h5><small class="text-muted">${m.email}</small><br><span class="badge bg-primary bg-opacity-10 text-primary mt-1">${m.role_name ?? '–'}</span><span class="badge ${m.is_active ? 'bg-success' : 'bg-danger'} ms-1">${m.is_active ? 'Active' : 'Inactive'}</span></div>
                </div>
                <div class="row g-3">
                    <div class="col-sm-6"><div class="info-label">Student Number</div><code>${m.student_number}</code></div>
                    <div class="col-sm-6"><div class="info-label">Phone</div><div>${m.phone ?? '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Gender</div><div>${m.gender ? m.gender.charAt(0).toUpperCase() + m.gender.slice(1) : '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Region</div><div>${m.region_name ?? '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Level</div><div>${m.level_name ?? '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Year of Study</div><div>${m.year_of_study ? 'Year ' + m.year_of_study : '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Department</div><div>${m.department_name ?? '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Programme</div><div>${m.programme_name ?? '–'}</div></div>
                    <div class="col-sm-6"><div class="info-label">Password Changed</div><span class="badge ${m.password_changed ? 'bg-success' : 'bg-warning text-dark'}">${m.password_changed ? 'Yes' : 'Not yet'}</span></div>
                    <div class="col-sm-6"><div class="info-label">Created By</div><div>${m.creator_name}</div></div>
                    <div class="col-sm-6"><div class="info-label">Joined</div><div>${m.created_at}</div></div>
                    <div class="col-sm-6"><div class="info-label">Last Updated</div><div>${m.updated_at}</div></div>
                </div>`;
            document.getElementById('viewToEditBtn').onclick = () => { bootstrap.Modal.getInstance(document.getElementById('viewModal')).hide(); setTimeout(() => openEditModal(id), 350); };
        })
        .catch(err => { document.getElementById('viewModalBody').innerHTML = `<div class="alert alert-danger m-3">Failed to load member data.</div>`; });
}

// Edit Modal
function openEditModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
    modal.show();
    fetch(routeFor('show', id), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
        .then(r => r.json())
        .then(m => {
            const roleOpts = allRoles.map(r => `<option value="${r.id}" ${r.id == m.role_id ? 'selected' : ''}>${r.name.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase())}</option>`).join('');
            const levelOpts = `<option value="">-- None --</option>` + allLevels.map(l => `<option value="${l.id}" ${l.id == m.level_id ? 'selected':''}>${l.name}</option>`).join('');
            const regionOpts = `<option value="">-- None --</option>` + allRegions.map(r => `<option value="${r.id}" ${r.id == m.region_id ? 'selected':''}>${r.name}</option>`).join('');
            const deptOpts = `<option value="">-- None --</option>` + allDepts.map(d => `<option value="${d.id}" ${d.id == m.department_id ? 'selected':''}>${d.name}</option>`).join('');
            const yearOpts = `<option value="">-- None --</option>` + [1,2,3,4].map(i => `<option value="${i}" ${m.year_of_study == i ? 'selected':''}>Year ${i}</option>`).join('');
            document.getElementById('editModalBody').innerHTML = `<form method="POST" action="${routeFor('update', m.id)}"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="_token" value="${csrfToken}"><div class="row g-3"><div class="col-12"><label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="${m.name}" required></div><div class="col-md-6"><label class="form-label fw-semibold small">Student Number <span class="text-danger">*</span></label><input type="text" name="student_number" class="form-control" value="${m.student_number}" required></div><div class="col-md-6"><label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label><input type="email" name="email" class="form-control" value="${m.email}" required></div><div class="col-md-6"><label class="form-label fw-semibold small">Gender <span class="text-danger">*</span></label><select name="gender" class="form-select" required><option value="male" ${m.gender==='male'?'selected':''}>Male</option><option value="female" ${m.gender==='female'?'selected':''}>Female</option></select></div><div class="col-md-6"><label class="form-label fw-semibold small">Role <span class="text-danger">*</span></label><select name="role_id" class="form-select" required>${roleOpts}</select></div><div class="col-md-6"><label class="form-label fw-semibold small">Region</label><select name="region_id" class="form-select">${regionOpts}</select></div><div class="col-md-6"><label class="form-label fw-semibold small">Level</label><select name="level_id" class="form-select">${levelOpts}</select></div><div class="col-md-6"><label class="form-label fw-semibold small">Year of Study</label><select name="year_of_study" class="form-select">${yearOpts}</select></div><div class="col-md-6"><label class="form-label fw-semibold small">Department</label><select name="department_id" id="edit_department_id" class="form-select">${deptOpts}</select></div><div class="col-md-6"><label class="form-label fw-semibold small">Programme</label><select name="programme_id" id="edit_programme_id" class="form-select"><option value="">-- Select Programme --</option></select></div><div class="col-md-6"><label class="form-label fw-semibold small">Phone</label><input type="text" name="phone" class="form-control" value="${m.phone ?? ''}" placeholder="07xxxxxxxx"></div><div class="col-md-6"><label class="form-label fw-semibold small">Account Status <span class="text-danger">*</span></label><select name="is_active" class="form-select"><option value="1" ${m.is_active ?'selected':''}>Active</option><option value="0" ${!m.is_active ?'selected':''}>Inactive</option></select></div></div><hr class="my-3"><div class="d-flex justify-content-between align-items-center"><button type="button" class="btn btn-outline-secondary" onclick="openResetModal(${m.id}, '${m.name.replace(/'/g,"\\'")}')"><i class="bi bi-key me-1"></i>Reset Password</button><div class="d-flex gap-2"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save me-1"></i>Save Changes</button></div></div></form>`;
            bindCascade('edit_department_id', 'edit_programme_id', m.programme_id);
        })
        .catch(err => { document.getElementById('editModalBody').innerHTML = `<div class="alert alert-danger m-3">Failed to load member data.</div>`; });
}

// Delete Modal
function openDeleteModal(id, name) { document.getElementById('deleteMemberName').textContent = name; document.getElementById('deleteForm').action = routeFor('destroy', id); new bootstrap.Modal(document.getElementById('deleteModal')).show(); }

// Reset Password Modal
function openResetModal(id, name) { const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal')); if (editModal) editModal.hide(); setTimeout(() => { document.getElementById('resetMemberName').textContent = name; document.getElementById('resetForm').action = routeFor('resetPassword', id); new bootstrap.Modal(document.getElementById('resetModal')).show(); }, 350); }
</script>
</body>
</html>