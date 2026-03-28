<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SRIS - Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Welcome, Super Admin</h1>
            
            <div class="card">
                <div class="card-body">
                    <h5>You are logged in as <strong>Super Administrator</strong></h5>
                    <hr>
                    <a href="{{ route('register.student') }}" class="btn btn-primary btn-lg mb-2">
                        <i class="fas fa-user-plus"></i> Register New Student
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>