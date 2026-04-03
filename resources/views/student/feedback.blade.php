<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback – {{ $religion->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .modal-header { background:linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white; border-radius:12px 12px 0 0 !important; }
        .modal-header .btn-close { filter:brightness(0) invert(1); }
        .modal-content { border:none; border-radius:12px; }
        .table th { font-size:.8rem; text-transform:uppercase; letter-spacing:.5px; color:#6c757d; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('includes.header')
    @include('includes.student_sidebar')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">
                            Feedback
                            <span class="badge text-bg-info" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">Student</li>
                            <li class="breadcrumb-item active">Feedback</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0">My Feedback</h5>
                        <small class="text-muted">Submit and track your feedback to {{ $religion->name }}</small>
                    </div>
                    <button class="btn btn-primary fw-semibold"
                            data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-circle me-2"></i>Submit Feedback
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

                {{-- Feedback List --}}
                <div class="card">
                    <div class="card-header py-3 fw-bold">
                        <i class="bi bi-chat-left-text me-2"></i>My Submissions
                        <span class="badge bg-primary ms-2">{{ $feedbacks->total() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($feedbacks as $fb)
                                    @php
                                        $sc = [
                                            'pending'  => 'warning',
                                            'reviewed' => 'info',
                                            'resolved' => 'success',
                                        ][$fb->status] ?? 'secondary';
                                    @endphp
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($feedbacks->currentPage() - 1) * $feedbacks->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="fw-semibold">{{ $fb->subject ?? '(No subject)' }}</td>
                                        <td>
                                            <small class="text-muted">
                                                {{ Str::limit($fb->message, 60) }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $sc }}">
                                                {{ ucfirst($fb->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $fb->created_at->format('d M Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($fb->status === 'pending')
                                                <form action="{{ route('student.feedback.destroy', $fb) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Delete this feedback?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small">–</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="bi bi-chat-left fs-1 d-block mb-2 opacity-25"></i>
                                            You haven't submitted any feedback yet.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($feedbacks->hasPages())
                        <div class="d-flex justify-content-center py-3">
                            {{ $feedbacks->links() }}
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </main>
    @include('includes.footer')
</div>

{{-- SUBMIT FEEDBACK MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">
                    <i class="bi bi-chat-left-text me-2"></i>Submit Feedback
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('student.feedback.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="alert alert-info py-2 small">
                        <i class="bi bi-info-circle me-1"></i>
                        Your feedback will be reviewed by the {{ $religion->name }} admin.
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Subject</label>
                            <input type="text" name="subject"
                                   class="form-control @error('subject') is-invalid @enderror"
                                   value="{{ old('subject') }}"
                                   placeholder="Brief subject (optional)">
                            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Message <span class="text-danger">*</span>
                            </label>
                            <textarea name="message" rows="5"
                                      class="form-control @error('message') is-invalid @enderror"
                                      placeholder="Write your feedback here...">{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-send me-1"></i>Submit Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->any())
            new bootstrap.Modal(document.getElementById('createModal')).show();
        @endif
        const sw = document.querySelector('.sidebar-wrapper');
        if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
        }
    });
</script>
</body>
</html>