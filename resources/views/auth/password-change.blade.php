<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRIS - Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { max-width: 450px; margin: 80px auto; }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark text-center">
            <h5><i class="fas fa-key"></i> First Time Login - Change Password</h5>
        </div>
        <div class="card-body p-4">

            <div class="alert alert-info">
                <strong>Welcome!</strong><br>
                You are logging in for the first time.<br>
                Please create a new secure password.
            </div>

            <form method="POST" action="{{ route('password.change') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           required minlength="6">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-control" 
                           required>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2">
                    <i class="fas fa-save"></i> Change Password & Continue
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>