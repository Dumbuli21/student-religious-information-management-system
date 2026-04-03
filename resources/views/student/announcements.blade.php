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
        .ann-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }
        .ann-card:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,.12) !important; }
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
                            Announcements
                            <span class="badge text-bg-primary" style="font-size:.7rem;">
                                {{ $religion->name }}
                            </span>
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
                    <small class="text-muted">Stay updated with the latest from {{ $religion->name }}</small>
                </div>

                {{-- Announcements as cards --}}
                @forelse($announcements as $ann)
                <a href="{{ route('student.announcements.show', $ann) }}" class="text-decoration-none">
                    <div class="card ann-card mb-3 p-0">
                        <div class="card-body py-3 px-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1 text-dark">{{ $ann->title }}</h6>
                                    <p class="text-muted small mb-0" style="line-height:1.5;">
                                        {{ Str::limit(strip_tags($ann->content), 150) }}
                                    </p>
                                </div>
                                <div class="ms-3 text-end flex-shrink-0">
                                    <small class="text-muted d-block">
                                        {{ $ann->published_at?->format('d M Y') ?? $ann->created_at->format('d M Y') }}
                                    </small>
                                    <small class="text-muted">
                                        {{ $ann->published_at?->diffForHumans() ?? $ann->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="card p-5 text-center text-muted">
                    <i class="bi bi-megaphone fs-1 d-block mb-2 opacity-25"></i>
                    No announcements available yet.
                </div>
                @endforelse

                @if($announcements->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $announcements->links() }}
                </div>
                @endif

            </div>
        </div>
    </main>

    @include('includes.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sw = document.querySelector('.sidebar-wrapper');
        if (sw && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sw, { scrollbars: { theme:'os-theme-light', autoHide:'leave', clickScroll:true } });
        }
    });
</script>
</body>
</html>