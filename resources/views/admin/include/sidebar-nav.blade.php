
        <aside class="col-md-3 col-lg-2 admin-sidebar d-none d-md-block"
               id="adminSidebar">

            <div class="sidebar-inner">

                
                
                <nav class="sidebar-nav">

                    <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-table-columns"></i>
                        <span>Dashboard</span>
                    </a>

                    <div class="sidebar-section">CORE DATA</div>

                    <a class="sidebar-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}"
                       href="{{ route('admin.companies.index') }}">
                        <i class="fa-solid fa-building"></i>
                        <span>Companies</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}"
                       href="{{ route('admin.plans.index') }}">
                        <i class="fa-solid fa-tags"></i>
                        <span>Plans</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                       href="{{ route('admin.users.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>
                    </a>

                    <div class="sidebar-section">MACHINES &amp; SENSORS</div>

                    <a class="sidebar-link {{ request()->routeIs('admin.machines.*') ? 'active' : '' }}"
                       href="{{ route('admin.machines.index') }}">
                        <i class="fa-solid fa-gears"></i>
                        <span>Machines</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.sensors.*') ? 'active' : '' }}"
                       href="{{ route('admin.sensors.index') }}">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Sensors</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.sensor-readings.*') ? 'active' : '' }}"
                       href="{{ route('admin.sensor-readings.index') }}">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Sensor Readings</span>
                    </a>

                    <div class="sidebar-section">PREDICTIONS &amp; ALERTS</div>

                    <a class="sidebar-link {{ request()->routeIs('admin.predictions.*') ? 'active' : '' }}"
                       href="{{ route('admin.predictions.index') }}">
                        <i class="fa-solid fa-brain"></i>
                        <span>Predictions</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.alerts.*') ? 'active' : '' }}"
                       href="{{ route('admin.alerts.index') }}">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Alerts</span>
                    </a>

                    <div class="sidebar-section">MAINTENANCE</div>

                    <a class="sidebar-link {{ request()->routeIs('admin.maintenance-tasks.*') ? 'active' : '' }}"
                       href="{{ route('admin.maintenance-tasks.index') }}">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <span>Maintenance Tasks</span>
                    </a>

                    <div class="sidebar-section">BILLING &amp; SUPPORT</div>

                    <a class="sidebar-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}"
                       href="{{ route('admin.subscriptions.index') }}">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>Subscriptions</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}"
                       href="{{ route('admin.invoices.index') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Invoices</span>
                    </a>

                    <a class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}"
                       href="{{ route('admin.tickets.index') }}">
                        <i class="fa-solid fa-headset"></i>
                        <span>Support Tickets</span>
                    </a>

                    <div class="sidebar-section">ACCOUNT</div>

                   

                    <a class="sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}"
                       href="{{ url('/admin/settings') }}">
                        <i class="fa-solid fa-sliders"></i>
                        <span>Settings</span>
                    </a>

                   
                    <a href="{{ route('admin.logout') }}"
                       class="sidebar-link sidebar-logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>

                </nav>
            </div>
        </aside>
