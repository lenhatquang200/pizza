<!-- resources/views/admin/sidebar.blade.php -->
<aside class="sidebar border-end" id="adminSidebar">
    <div class="sidebar-content" id="sidebarMenu">
        <button class="btn-close-sidebar" id="closeSidebar" aria-label="Close Sidebar">
            <i class="icon-close"></i>
        </button>
        {{-- <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/uploadsphoto') }}" class="nav-link {{ request()->is('admin/uploadsphoto') ? 'active' : '' }}">
                    Uploads
                </a>
            </li>
        </ul> --}}
    </div>
</aside>

<button class="sidebar-toggle-btn" id="sidebarToggle" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle sidebar">
    <i class="icon-menu"></i>
</button>
