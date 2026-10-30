
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($page_title) ? ucfirst($page_title) : 'PredictorMT' }}</title>

    <meta name="description" content="PredictorMT industrial monitoring and predictive maintenance platform">

    <link rel="icon" href="{{ asset('public/assets/images/predictorMt-Technologies.png') }}">

    {{-- Bootstrap / App CSS --}}
    <link href="{{ asset('public/assets/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">

        <link href="{{ asset('public/assets/css/user-style.css') }}" rel="stylesheet">
</head>

<body>

@php
    $currentRoute = request()->route()?->getName();
@endphp

<header class="header_top position-fixed w-100 rounded-0 border-bottom z-2 bg-white">
    <nav class="navbar px-3 py-2">
        <div class="container-fluid">
          <a href="{{ route('user.dashboard') }}" class="navbar-brand">
        <img src="{{ asset('public/assets/images/admin-logo.png') }}"
             alt="PredictorMT"
             class="img-fluid">
    </a>

            {{-- Sidebar Toggle --}}
            <button type="button"
                    class="btn border-0"
                    id="userSidebarToggle"
                    aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="d-flex align-items-center gap-3 ms-auto">

                {{-- Notifications --}}
                <div class="dropdown">
                    <button type="button"
                            class="btn position-relative"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Notifications">
                        <i class="fa-regular fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            5
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                        style="width:300px; max-width:90vw;">

                        <li>
                            <h6 class="dropdown-header">Notifications</h6>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fa-solid fa-temperature-high text-danger me-2"></i>
                                <strong>High Temperature</strong>
                                <small class="d-block text-muted ms-4">
                                    Motor 01 reached 68°C · 2 min ago
                                </small>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fa-solid fa-gauge-high text-warning me-2"></i>
                                <strong>Pressure Drop</strong>
                                <small class="d-block text-muted ms-4">
                                    Pump 02 pressure below threshold
                                </small>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>
                                <strong>Machine Fault</strong>
                                <small class="d-block text-muted ms-4">
                                    Conveyor stopped unexpectedly
                                </small>
                            </a>
                        </li>

                        @if(Route::has('user.alerts.index'))
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('user.alerts.index') }}"
                                   class="dropdown-item text-center text-primary">
                                    View All Alerts
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                {{-- User Menu --}}
                <div class="dropdown">
                    <button type="button"
                            class="btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa-regular fa-user me-1"></i>
                        {{ auth()->user()->name ?? 'User' }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                <i class="fa-solid fa-gauge-high me-2"></i>
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('user.profile') }}">
                                <i class="fa-solid fa-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
</header>

<script>
  
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('userSidebarToggle');
    const sidebar = document.getElementById('userSidebar');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }

    const close = sidebar?.querySelector('.button-close-fullsidebar');

    if (close && sidebar) {
        close.addEventListener('click', function () {
            sidebar.classList.remove('show');
        });
    }
});

</script>
{{-- Sidebar include --}}
<!-- @include('user.include.sidebar-nav') -->
