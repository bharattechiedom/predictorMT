<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="{{ asset('public/assets/images/predictorMt-Technologies.png') }}">

    <title>Predictormt - Dashboard</title>

    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/admin-style.css') }}" rel="stylesheet">
   

</head>

<body>

 
<!-- <div class="container-fluid admin-layout">
    <div class="row g-0">

 -->

        {{-- MAIN CONTENT --}}

            {{-- HEADER --}}
            <header class="admin-header">
                <div class="d-flex align-items-center gap-3">
                    <div>
                       {{-- Logo --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-brand">
                    <img src="{{ asset('public/assets/images/admin-logo.png') }}"
                         alt="PredictorMT"
                         class="sidebar-logo">
                    <!-- <span>
                        <strong>PredictorMT</strong>
                        <small>Industrial IoT Platform</small>
                    </span> -->
                </a>

                    </div>

                    {{-- Mobile Sidebar Toggle --}}
                    <button type="button"
                            class="header-icon-btn d-md-none"
                            id="sidebarToggle"
                            aria-label="Toggle sidebar"
                            aria-controls="adminSidebar"
                            aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    {{-- Desktop Sidebar Toggle --}}
                    <button type="button"
                            class="header-icon-btn d-none d-md-inline-flex border-0"
                            id="desktopSidebarToggle"
                            aria-label="Collapse sidebar">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>

                    
                </div>

                <div class="header-actions">

                    {{-- Notifications Dropdown --}}
                    <div class="dropdown">
                        <button type="button"
                                class="header-icon-btn notification-btn"
                                data-bs-toggle="dropdown"
                                data-bs-auto-close="outside"
                                aria-expanded="false"
                                aria-label="Notifications">
                            <i class="fa-regular fa-bell"></i>
                            <span class="notification-count">3</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="notification-heading">
                                <div>
                                    <h6 class="mb-1 fw-bold">Notifications</h6>
                                    <small class="text-secondary">Recent system updates</small>
                                </div>
                                <span class="badge bg-primary">3 New</span>
                            </div>

                            <div class="notification-item">
                                <span class="notification-icon bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">Machine Alert</p>
                                    <small class="text-secondary">
                                        A machine requires attention.
                                    </small>
                                    <div class="notification-time">Recently</div>
                                </div>
                            </div>

                            <div class="notification-item">
                                <span class="notification-icon bg-success-subtle text-success">
                                    <i class="fa-solid fa-user-plus"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">New User</p>
                                    <small class="text-secondary">
                                        A new user has registered.
                                    </small>
                                    <div class="notification-time">Recently</div>
                                </div>
                            </div>

                            <div class="notification-item">
                                <span class="notification-icon bg-warning-subtle text-warning-emphasis">
                                    <i class="fa-solid fa-gears"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">System Update</p>
                                    <small class="text-secondary">
                                        Configuration activity detected.
                                    </small>
                                    <div class="notification-time">Recently</div>
                                </div>
                            </div>

                            <a href="{{ route('admin.alerts.index') }}"
                               class="notification-footer">
                                View All Notifications
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>


                    {{-- Profile Dropdown --}}
                    <div class="dropdown">
                        <button type="button"
                                class="profile-dropdown-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                            <span class="profile-avatar">
                                <i class="fa-solid fa-user"></i>
                            </span>

                            <span class="profile-info d-none d-sm-block">
                                <strong>Rhot</strong><br>
                                <small>Administrator</small>
                            </span>

                            <i class="fa-solid fa-chevron-down profile-chevron"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end profile-menu">

                            <li class="profile-menu-heading">
                                <div class="profile-avatar profile-avatar-lg">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    <strong>Rhot</strong>
                                    <small>Administrator</small>
                                </div>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="{{ url('/admin/profile') }}">
                                    <i class="fa-regular fa-user me-2"></i>
                                    My Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ url('/admin/settings') }}">
                                    <i class="fa-solid fa-gear me-2"></i>
                                    Settings
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger"
                                   href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </header>

<!--           
        </div>
    </div> -->




{{-- Logout Form --}}
<form id="logout-form"
      action="{{ route('admin.logout') }}"
      method="POST"
      class="d-none">
    @csrf
</form>




{{-- SIDEBAR TOGGLE SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const layout = document.querySelector('body');
    const sidebar = document.getElementById('adminSidebar');
    const mobileToggle = document.getElementById('sidebarToggle');
    const desktopToggle = document.getElementById('desktopSidebarToggle');

    if (!layout || !sidebar) return;

    // Mobile sidebar
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
            sidebar.classList.toggle('d-none');

            const isExpanded = !sidebar.classList.contains('d-none');
            mobileToggle.setAttribute('aria-expanded', String(isExpanded));
        });
    }

    // Desktop sidebar collapse
    if (desktopToggle) {
        desktopToggle.addEventListener('click', function () {
            layout.classList.toggle('sidebar-collapsed');
        });
    }
});
</script>
