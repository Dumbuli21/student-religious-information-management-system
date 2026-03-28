<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIMS – Login</title>
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
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .login-header h4 {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .login-body { padding: 2rem; }
        .btn-login {
            background: linear-gradient(135deg, #1a3c5e, #2d6a9f);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: opacity .2s;
        }
        .btn-login:hover { opacity: 0.9; color: white; }
        .form-control:focus { border-color: #2d6a9f; box-shadow: 0 0 0 .2rem rgba(45,106,159,.25); }
        .input-group-text { background: #f8f9fa; border-right: none; }
        .form-control { border-left: none; }
    </style>
</head>
<body>
    <div class="login-card card">
        {{-- Header --}}
        <div class="login-header">
            <i class="bi bi-shield-lock-fill fs-1 mb-2"></i>
            <h4>SRIMS</h4>
            <small class="opacity-75">Student Religious Information Management System</small>
        </div>

        {{-- Body --}}
        <div class="login-body">

            {{-- Flash messages --}}
            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show py-2" role="alert">
                    <i class="bi bi-info-circle me-1"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <p class="text-muted text-center mb-4">Sign in with your Student Number</p>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                {{-- Student Number --}}
                <div class="mb-3">
                    <label for="student_number" class="form-label fw-semibold">Student Number</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input
                            type="text"
                            id="student_number"
                            name="student_number"
                            class="form-control @error('student_number') is-invalid @enderror"
                            value="{{ old('student_number') }}"
                            placeholder="e.g. BT12"
                            autofocus
                            autocomplete="username"
                        >
                        @error('student_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>

            <p class="text-center text-muted mt-4 mb-0">
                <small>&copy; {{ date('Y') }} SRIMS. All rights reserved.</small>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const pwd  = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>