
<aside class="sidenav-menu show" id="userSidebar">

    {{-- Brand Logo --}}
    

    {{-- Close Sidebar --}}
    <button type="button" class="button-close-fullsidebar" aria-label="Close sidebar">
        <i class="fa-solid fa-xmark"></i>
    </button>

          @php

          $currentRoute = Request::route()->getName();

          @endphp
    {{-- Sidebar Navigation --}}
    <ul class="side-nav">

    

        <li class="side-nav-item">
             <a href="{{ route('user.dashboard') }}" class="side-nav-link {{ $currentRoute == 'user.dashboard' ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="side-nav-title">MACHINES & SENSORS</li>

        <li class="side-nav-item">
            <a href="{{ route('user.machines.index') }}"
               class="side-nav-link {{ str_contains($currentRoute, 'machines') ? 'active' : '' }}">
                <i class="fa-solid fa-gears"></i>
                <span>Machine Management</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.sensors.index') }}"
               class="side-nav-link {{ str_contains($currentRoute, 'sensors') ? 'active' : '' }}">
                <i class="fa-solid fa-microchip"></i>
                <span>Sensor Management</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.simulation.index') }}"
               class="side-nav-link {{ str_contains($currentRoute, 'simulation') ? 'active' : '' }}">
                <i class="fa-solid fa-flask"></i>
                <span>Simulation</span>
            </a>
        </li>

        <li class="side-nav-title">PREDICTIONS & MAINTENANCE</li>

        <li class="side-nav-item">
            <a href="{{ route('user.maintenance-tasks.index') }}"
               class="side-nav-link {{ str_contains($currentRoute, 'maintenance') ? 'active' : '' }}">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span>Fault & Maintenance</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.predictions.index') }}"
               class="side-nav-link {{ str_contains($currentRoute, 'predictions') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Predictions</span>
            </a>
        </li>

        @if(Route::has('user.alerts.index'))
            <li class="side-nav-item">
                <a href="{{ route('user.alerts.index') }}"
                   class="side-nav-link {{ str_contains($currentRoute, 'alerts') ? 'active' : '' }}">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Alerts</span>
                </a>
            </li>
        @endif

        @if(Route::has('user.reports.index'))
            <li class="side-nav-item">
                <a href="{{ route('user.reports.index') }}"
                   class="side-nav-link {{ str_contains($currentRoute, 'reports') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Data & Reports</span>
                </a>
            </li>
        @endif

        <li class="side-nav-title">ACCOUNT</li>

        <li class="side-nav-item">
            <a href="{{ route('user.profile') }}"
               class="side-nav-link {{ $currentRoute == 'user.profile' ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        </li>

        <li class="side-nav-item">
            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit" class="side-nav-link logout-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>

    </ul>
</aside>
