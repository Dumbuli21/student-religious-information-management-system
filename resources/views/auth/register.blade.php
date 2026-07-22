<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIS – Quick Register (Temp)</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,.08); }
        .card-header { background: linear-gradient(135deg,#1a3c5e,#2d6a9f); color: white; border-radius: 12px 12px 0 0 !important; }
        .badge-temp { background: #dc3545; color: white; font-size: .7rem; padding: 3px 8px; border-radius: 20px; }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; }
    </style>
</head>
<body>
<div class="container py-4">

    {{-- Warning banner --}}
    <div class="alert alert-warning d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <div>
            <strong>Temporary development page</strong> — Remove this route from <code>routes/web.php</code> before going live.
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i> {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- Register Form --}}
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 fw-bold">
                            <i class="bi bi-person-plus me-2"></i>Create New User
                        </h6>
                        <span class="badge-temp">TEMP</span>
                    </div>
                    <small class="opacity-75">Default password is always: <strong>must123</strong></small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="e.g. Amina Joseph">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Student Number --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Student Number <span class="text-danger">*</span></label>
                            <input type="text" name="student_number" class="form-control @error('student_number') is-invalid @enderror"
                                   value="{{ old('student_number') }}" placeholder="e.g. BT25001">
                            @error('student_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="e.g. amina@sris.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">-- Select Gender --</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Role - Default: Student --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" 
                                        {{ old('role_id', $role->name === 'student' ? $role->id : '') == $role->id ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Religion --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Religion <small class="text-muted">(optional for super admin)</small></label>
                            <select name="religion_id" class="form-select @error('religion_id') is-invalid @enderror">
                                <option value="">-- None --</option>
                                @foreach($religions as $religion)
                                    <option value="{{ $religion->id }}" {{ old('religion_id') == $religion->id ? 'selected' : '' }}>
                                        {{ $religion->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('religion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Academic Information --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Level of Study</label>
                            <select name="level_id" id="level_id" class="form-select @error('level_id') is-invalid @enderror">
                                <option value="">-- Select Level --</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Department</label>
                            <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Programme</label>
                            <select name="programme_id" id="programme_id" class="form-select @error('programme_id') is-invalid @enderror">
                                <option value="">-- Select Programme --</option>
                            </select>
                            @error('programme_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Year of Study - Default: Year 1 --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Year of Study</label>
                            <select name="year_of_study" class="form-select @error('year_of_study') is-invalid @enderror">
                                <option value="">-- Select Year --</option>
                                @for($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}" 
                                        {{ old('year_of_study', 1) == $i ? 'selected' : '' }}>
                                        Year {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('year_of_study')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Phone + Region --}}
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold small">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="07xxxxxxxx">
                            </div>
                              <div class="col-6">
            {{-- ✅ Was a free-text input, now a dropdown --}}
        <label class="form-label fw-semibold small">Region</label>
        <select name="region_id" class="form-select @error('region_id') is-invalid @enderror">
            <option value="">-- Select Region --</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}"
                    {{ old('region_id') == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
        @error('region_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

                        {{-- Password Behaviour --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Login Behaviour <span class="text-danger">*</span></label>
                            <select name="password_changed" class="form-select">
                                <option value="0" {{ old('password_changed', '0') == '0' ? 'selected' : '' }}>
                                    Force change password on first login
                                </option>
                                <option value="1" {{ old('password_changed') == '1' ? 'selected' : '' }}>
                                    Go directly to dashboard
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                            <i class="bi bi-person-check me-2"></i>Create User
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="bi bi-people me-2"></i>All Users ({{ $users->count() }})
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Name</th>
                                    <th>Student No.</th>
                                    <th>Role</th>
                                    <th>Religion</th>
                                    <th>Academic Info</th>
                                    <th>Pwd Changed</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                <tr>
                                    <td class="ps-3">
                                        <div class="fw-semibold">{{ $u->name }}</div>
                                        <small class="text-muted">{{ $u->email }}</small>
                                    </td>
                                    <td><code>{{ $u->student_number }}</code></td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:.75rem">
                                            {{ ucwords(str_replace('_', ' ', $u->role?->name)) }}
                                        </span>
                                    </td>
                                    <td>{{ $u->religion?->name ?? '–' }}</td>
                                    <td><small class="text-muted">{{ $u->academicInfo() ?? '–' }}</small></td>
                                    <td>
                                        @if($u->password_changed)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-warning text-dark">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($u->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No users yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Cascading Dropdown Script for Programme -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departmentSelect = document.getElementById('department_id');
        const programmeSelect = document.getElementById('programme_id');
        const allProgrammes = @json($programmes);

        function filterProgrammes() {
            const selectedDeptId = departmentSelect.value;
            programmeSelect.innerHTML = '<option value="">-- Select Programme --</option>';

            if (!selectedDeptId) return;

            const filtered = allProgrammes.filter(prog => prog.department_id == selectedDeptId);

            filtered.forEach(prog => {
                const option = document.createElement('option');
                option.value = prog.id;
                option.textContent = prog.name;
                if (prog.id == '{{ old('programme_id') }}') {
                    option.selected = true;
                }
                programmeSelect.appendChild(option);
            });
        }

        departmentSelect.addEventListener('change', filterProgrammes);
        filterProgrammes(); // Initial load
    });
</script>

</body>
</html>