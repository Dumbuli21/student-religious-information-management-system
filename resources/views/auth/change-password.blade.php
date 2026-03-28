<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS – Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a3c5e 0%, #2d6a9f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 470px;
            width: 100%;
        }
        .card-header {
            background: linear-gradient(135deg, #d4580a, #e8750e);
            color: white;
            border-radius: 16px 16px 0 0 !important;
            padding: 1.75rem 2rem;
        }
        .card-body { padding: 2rem; }
        .btn-change {
            background: linear-gradient(135deg, #d4580a, #e8750e);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            transition: opacity .2s;
        }
        .btn-change:hover { opacity: 0.9; color: white; }
        .strength-bar { height: 6px; border-radius: 3px; transition: all .3s; }
        .requirement { font-size: .82rem; }
        .requirement.met { color: #198754; }
        .requirement.unmet { color: #6c757d; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            <i class="bi bi-key-fill fs-1 mb-1"></i>
            <h5 class="mb-0 fw-bold">Change Your Password</h5>
            <small class="opacity-75">Your account requires a password change before you can continue.</small>
        </div>

        <div class="card-body">

            @if (session('warning'))
                <div class="alert alert-warning py-2">
                    <i class="bi bi-exclamation-triangle me-1"></i> {{ session('warning') }}
                </div>
            @endif

            {{-- General validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="text-muted mb-3">
                Hello, <strong>{{ Auth::user()->name }}</strong>. Please create a new secure password.
            </p>

            <form method="POST" action="{{ route('password.change') }}" id="changeForm">
                @csrf

                {{-- Current password --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Password (Default)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            placeholder="Enter current / default password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- New password --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" id="newPassword"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Create a strong password"
                            oninput="checkStrength(this.value)">
                        <button class="btn btn-outline-secondary" type="button" onclick="toggle('newPassword', 'eye1')">
                            <i class="bi bi-eye" id="eye1"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Strength bar --}}
                    <div class="progress mt-2" style="height:6px">
                        <div class="progress-bar strength-bar" id="strengthBar" style="width:0%"></div>
                    </div>
                    {{-- Requirements --}}
                    <div class="mt-2">
                        <div class="requirement unmet" id="req-length"><i class="bi bi-x-circle me-1"></i>At least 8 characters</div>
                        <div class="requirement unmet" id="req-upper"><i class="bi bi-x-circle me-1"></i>At least one uppercase letter</div>
                        <div class="requirement unmet" id="req-lower"><i class="bi bi-x-circle me-1"></i>At least one lowercase letter</div>
                        <div class="requirement unmet" id="req-number"><i class="bi bi-x-circle me-1"></i>At least one number</div>
                    </div>
                </div>

                {{-- Confirm password --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" id="confirmPassword"
                            class="form-control"
                            placeholder="Repeat new password">
                        <button class="btn btn-outline-secondary" type="button" onclick="toggle('confirmPassword', 'eye2')">
                            <i class="bi bi-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-change w-100">
                    <i class="bi bi-check-circle me-2"></i>Change Password & Continue
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-3 text-center">
                @csrf
                <button type="submit" class="btn btn-link text-muted p-0">
                    <i class="bi bi-box-arrow-left me-1"></i>Logout and go back
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggle(inputId, iconId) {
            const inp  = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            inp.type = inp.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }

        function checkStrength(value) {
            const bar    = document.getElementById('strengthBar');
            const checks = {
                'req-length': value.length >= 8,
                'req-upper':  /[A-Z]/.test(value),
                'req-lower':  /[a-z]/.test(value),
                'req-number': /[0-9]/.test(value),
            };

            let passed = Object.values(checks).filter(Boolean).length;

            // Update requirement icons
            for (const [id, ok] of Object.entries(checks)) {
                const el = document.getElementById(id);
                el.classList.toggle('met', ok);
                el.classList.toggle('unmet', !ok);
                el.querySelector('i').className = ok
                    ? 'bi bi-check-circle-fill me-1'
                    : 'bi bi-x-circle me-1';
            }

            // Update bar
            const pct    = (passed / 4) * 100;
            const colors = ['#dc3545', '#fd7e14', '#ffc107', '#198754'];
            bar.style.width = pct + '%';
            bar.style.background = colors[passed - 1] || '#dee2e6';
        }
    </script>
</body>
</html>