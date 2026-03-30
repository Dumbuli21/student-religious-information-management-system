<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <!-- Simple CSS Dropdown (Works without Bootstrap JS) -->
            <li class="nav-item" style="position: relative;">
                <a class="nav-link dropdown-toggle" href="#" id="simpleDropdown" style="cursor: pointer;">
                    {{ Auth::user()->name ?? 'User' }}
                </a>
                <ul class="dropdown-menu-custom" style="display: none; position: absolute; top: 100%; right: 0; background: white; border: 1px solid #ddd; border-radius: 5px; padding: 5px 0; min-width: 180px; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <li><a class="dropdown-item-custom" href="#" style="display: block; padding: 8px 20px; text-decoration: none; color: #333;">My Profile</a></li>
                    <li><a class="dropdown-item-custom" href="#" style="display: block; padding: 8px 20px; text-decoration: none; color: #333;">Change Password</a></li>
                    <li style="height: 1px; background: #eee; margin: 5px 0;"></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent" style="padding: 8px 20px; cursor: pointer;">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p style="display: inline; margin: 0;">Logout</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    // Simple JavaScript for dropdown
    document.getElementById('simpleDropdown')?.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var menu = this.nextElementSibling;
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    });
    
    // Close dropdown when clicking elsewhere
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#simpleDropdown')) {
            var menu = document.querySelector('.dropdown-menu-custom');
            if (menu) menu.style.display = 'none';
        }
    });
    
    // Alert for testing
    document.querySelectorAll('.dropdown-item-custom, button[type="submit"]').forEach(item => {
        if (!item.closest('form')) {
            item.addEventListener('click', function(e) {
                if (!this.closest('form')) {
                    e.preventDefault();
                    alert('This feature is coming soon!');
                }
            });
        }
    });
</script>