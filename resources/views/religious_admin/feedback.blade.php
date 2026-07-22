<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback – {{ $religion->name }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='20' fill='%2342a5f5'/%3E%3Ctext x='50' y='54' font-size='36' text-anchor='middle' dominant-baseline='middle' fill='white' font-family='Arial Black,Arial' font-weight='900'%3ESR%3C/text%3E%3Ctext x='50' y='80' font-size='14' text-anchor='middle' fill='%23e3f2fd' font-family='Arial' letter-spacing='3'%3EIMS%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,.07); }
        .card-header { border-radius: 12px 12px 0 0 !important; }
        .modal-header { background: linear-gradient(135deg,#1a3c5e,#2d6a9f); color: white; border-radius: 12px 12px 0 0 !important; }
        .modal-header .btn-close { filter: brightness(0) invert(1); }
        .modal-content { border: none; border-radius: 12px; }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; }
        .info-label { font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; margin-bottom: 2px; }
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
                            Feedback
                            <span class="badge text-bg-info" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
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
                        <h5 class="fw-bold mb-0">Member Feedback</h5>
                        <small class="text-muted">Review and manage feedback from {{ $religion->name }} members</small>
                    </div>
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
                                <div style="width:40px;height:40px;border-radius:50%;background:#0d6efd;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-chat-left-text-fill"></i>
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
                                <div style="width:40px;height:40px;border-radius:50%;background:#ffc107;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['pending'] }}</div>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#0dcaf0;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-eye-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['reviewed'] }}</div>
                                    <small class="text-muted">Reviewed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:40px;height:40px;border-radius:50%;background:#198754;display:flex;align-items:center;justify-content:center;color:white;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $stats['resolved'] }}</div>
                                    <small class="text-muted">Resolved</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="card">
                    <div class="card-header py-3 fw-bold">
                        <i class="bi bi-chat-left-text me-2"></i>Feedback List
                        <span class="badge bg-primary ms-2">{{ $feedbacks->total() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">#</th>
                                        <th>Member</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Received</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($feedbacks as $fb)
                                    @php
                                        $statusColors = [
                                            'pending'  => 'warning',
                                            'reviewed' => 'info',
                                            'resolved' => 'success',
                                        ];
                                        $sc = $statusColors[$fb->status] ?? 'secondary';
                                    @endphp
                                    <tr>
                                        <td class="ps-3 text-muted small">
                                            {{ ($feedbacks->currentPage() - 1) * $feedbacks->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $fb->user?->name ?? 'Anonymous' }}</div>
                                            <small class="text-muted">{{ $fb->user?->email ?? '–' }}</small>
                                        </td>
                                        <td>{{ $fb->subject ?? '(No subject)' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $sc }}">
                                                {{ ucfirst($fb->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $fb->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-outline-info" title="View"
                                                        onclick="openViewModal({{ $fb->id }})">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Mark Resolved"
                                                        onclick="openStatusModal({{ $fb->id }}, '{{ addslashes($fb->subject ?? 'Feedback') }}', '{{ $fb->status }}')">
                                                    <i class="bi bi-check2-circle"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="openDeleteModal({{ $fb->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="bi bi-chat-left fs-1 d-block mb-2 opacity-25"></i>
                                            No feedback received yet.
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

{{-- ═══════════════════════════════════════════ --}}
{{--  MODAL 1 — VIEW                            --}}
{{-- ═══════════════════════════════════════════ --}}
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-chat-left-text me-2"></i>Feedback Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center py-5"><div class="spinner-border text-primary"></div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{--  MODAL 2 — UPDATE STATUS                   --}}
{{-- ═══════════════════════════════════════════ --}}
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-check2-circle me-2"></i>Update Status</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Update status for: <strong id="statusFeedbackTitle"></strong></p>
                <form id="statusForm" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-4">
                            <button type="submit" name="status" value="pending"
                                    class="btn btn-warning w-100 fw-semibold">
                                <i class="bi bi-hourglass-split me-1"></i>Pending
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="status" value="reviewed"
                                    class="btn btn-info w-100 fw-semibold text-white">
                                <i class="bi bi-eye me-1"></i>Reviewed
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="status" value="resolved"
                                    class="btn btn-success w-100 fw-semibold">
                                <i class="bi bi-check-circle me-1"></i>Resolved
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{--  MODAL 3 — DELETE                          --}}
{{-- ═══════════════════════════════════════════ --}}
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
                <i class="bi bi-chat-left text-danger" style="font-size:3rem"></i>
                <p class="mt-3">Are you sure you want to delete this feedback?</p>
                <small class="text-muted">This action cannot be undone.</small>
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

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>

const csrfToken = '{{ csrf_token() }}';
const routes = {
    show:         '{{ route('religious_admin.feedback.show',          '__ID__') }}',
    destroy:      '{{ route('religious_admin.feedback.destroy',       '__ID__') }}',
    updateStatus: '{{ route('religious_admin.feedback.update-status', '__ID__') }}',
};

function routeFor(name, id) {
    return routes[name].replace('__ID__', id);
}

document.addEventListener('DOMContentLoaded', function () {
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, {
            scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
        });
    }
});

// ── VIEW ─────────────────────────────────────────────────────────
function openViewModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewModal'));
    document.getElementById('viewModalBody').innerHTML =
        `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
    modal.show();

    fetch(routeFor('show', id), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(f => {
        const statusColors = { pending: 'warning', reviewed: 'info', resolved: 'success' };
        const sc = statusColors[f.status] ?? 'secondary';

        document.getElementById('viewModalBody').innerHTML = `
            <div class="mb-3 p-3 bg-light rounded-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-bold">${f.user_name}</div>
                        <small class="text-muted">${f.user_email}</small>
                    </div>
                    <span class="badge bg-${sc}">${f.status.charAt(0).toUpperCase() + f.status.slice(1)}</span>
                </div>
            </div>
            ${f.subject ? `
            <div class="mb-3">
                <div class="info-label">Subject</div>
                <div class="fw-semibold">${f.subject}</div>
            </div>` : ''}
            <div class="mb-3">
                <div class="info-label">Message</div>
                <div class="p-3 bg-light rounded" style="white-space:pre-wrap;">${f.message}</div>
            </div>
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="info-label">Received</div>
                    <div>${f.created_at}</div>
                </div>
                <div class="col-sm-6">
                    <div class="info-label">Last Updated</div>
                    <div>${f.updated_at}</div>
                </div>
            </div>`;
    })
    .catch(() => {
        document.getElementById('viewModalBody').innerHTML =
            `<div class="alert alert-danger">Failed to load data.</div>`;
    });
}

// ── STATUS ───────────────────────────────────────────────────────
function openStatusModal(id, subject, currentStatus) {
    document.getElementById('statusFeedbackTitle').textContent = subject;
    document.getElementById('statusForm').action = routeFor('updateStatus', id);
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}

// ── DELETE ───────────────────────────────────────────────────────
function openDeleteModal(id) {
    document.getElementById('deleteForm').action = routeFor('destroy', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

</script>
</body>
</html>