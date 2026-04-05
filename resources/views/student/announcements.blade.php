<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements – {{ $religion->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}"/>
    <style>
        .card { border:none; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
        .ann-card { transition:.2s; cursor:pointer; }
        .ann-card:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,0,0,.12) !important; }
        .modal-header { background:linear-gradient(135deg,#1a3c5e,#2d6a9f); color:white; border-radius:12px 12px 0 0 !important; }
        .modal-header .btn-close { filter:brightness(0) invert(1); }
        .modal-content { border:none; border-radius:12px; }
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
                        <h3 class="mb-0">Announcements
                            <span class="badge text-bg-primary" style="font-size:.7rem;">{{ $religion->name }}</span>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">{{ $religion->name }}</li>
                            <li class="breadcrumb-item active">Announcements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="mb-4">
                    <h5 class="fw-bold mb-0">All Announcements</h5>
                    <small class="text-muted">Click any announcement to read it in full</small>
                </div>

                <div class="row g-3">
                    @forelse($announcements as $ann)
                    <div class="col-md-6 col-lg-4">
                        <div class="card ann-card h-100"
                             onclick="openAnnouncementModal(
                                 {{ $ann->id }},
                                 '{{ addslashes($ann->title) }}',
                                 `{{ addslashes($ann->content) }}`,
                                 '{{ $ann->published_at?->format('d M Y, H:i') ?? $ann->created_at->format('d M Y, H:i') }}'
                             )">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-megaphone me-1"></i>Announcement
                                    </span>
                                    <small class="text-muted">
                                        {{ $ann->published_at?->diffForHumans() ?? $ann->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <h6 class="fw-bold mb-2">{{ $ann->title }}</h6>
                                <p class="text-muted small mb-0 flex-grow-1">
                                    {{ Str::limit(strip_tags($ann->content), 100) }}
                                </p>
                                <div class="mt-3">
                                    <small class="text-primary">
                                        <i class="bi bi-eye me-1"></i>Click to read more
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card p-5 text-center text-muted">
                            <i class="bi bi-megaphone fs-1 d-block mb-2 opacity-25"></i>
                            No announcements available yet.
                        </div>
                    </div>
                    @endforelse
                </div>

                @if($announcements->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $announcements->links() }}
                </div>
                @endif

            </div>
        </div>
    </main>
    @include('includes.footer')
</div>

{{-- Announcement Modal --}}
<div class="modal fade" id="announcementModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-megaphone me-2"></i>Announcement</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="announcementModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
function openAnnouncementModal(id, title, content, date) {
    document.getElementById('announcementModalBody').innerHTML = `
        <h5 class="fw-bold mb-2">${title}</h5>
        <small class="text-muted d-block mb-4">
            <i class="bi bi-calendar me-1"></i>${date}
        </small>
        <hr>
        <div style="white-space:pre-wrap;line-height:1.8;">${content}</div>`;
    new bootstrap.Modal(document.getElementById('announcementModal')).show();
}

document.addEventListener('DOMContentLoaded', function () {
    const sw = document.querySelector('.sidebar-wrapper');
    if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
    }
});
</script>
</body>
</html>