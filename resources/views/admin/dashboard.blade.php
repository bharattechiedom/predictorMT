@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
                
        <div class="row">
           @include('admin.include.sidebar-nav')
            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

    

    <div class="main-content p-3 p-lg-4">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Page Heading --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1 fs-4">Welcome back, {{ $admin->name }}!</h2>
                <p class="text-secondary mb-0">
                    Monitor your PredictorMT industrial monitoring system.
                </p>
            </div>

            <span class="badge rounded-pill text-bg-light border px-3 py-2">
                <i class="fas fa-calendar-day text-primary me-2"></i>
                {{ now()->format('d M Y') }}
            </span>
        </div>

        {{-- Statistics Cards --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-stat stat-blue h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Total Users</p>
                                <h3 class="stat-number">1,234</h3>
                                <small><i class="fas fa-users me-1"></i> Registered users</small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-stat stat-green h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Active Machines</p>
                                <h3 class="stat-number">86</h3>
                                <small><i class="fas fa-circle-check me-1"></i> Running status</small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-gears"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-stat stat-orange h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Active Alerts</p>
                                <h3 class="stat-number">12</h3>
                                <small><i class="fas fa-bell me-1"></i> Requires attention</small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-triangle-exclamation"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-stat stat-purple h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Maintenance</p>
                                <h3 class="stat-number">8</h3>
                                <small><i class="fas fa-screwdriver-wrench me-1"></i> Machines scheduled</small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-toolbox"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Machine Health + User Roles --}}
        <div class="row g-4 mb-4">

            {{-- Machine Health Overview --}}
            <div class="col-12 col-xl-7">
                <div class="card dashboard-panel h-100">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-heart-pulse text-primary me-2"></i>
                            Machine Health Overview
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="row align-items-center g-4">

                            <div class="col-12 col-md-5 text-center">
                                <div class="health-chart mx-auto">
                                    <div class="health-chart-center">
                                        <h3 class="fw-bold mb-0">86</h3>
                                        <small class="text-secondary fs-12">Total Machines</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-7">

                                <div class="health-item">
                                    <span class="health-dot bg-success"></span>
                                    <span class="flex-grow-1">Running</span>
                                    <strong>52</strong>
                                    <small class="text-secondary ms-2">60%</small>
                                </div>

                                <div class="health-item">
                                    <span class="health-dot bg-primary"></span>
                                    <span class="flex-grow-1">Idle</span>
                                    <strong>18</strong>
                                    <small class="text-secondary ms-2">21%</small>
                                </div>

                                <div class="health-item">
                                    <span class="health-dot bg-danger"></span>
                                    <span class="flex-grow-1">Fault</span>
                                    <strong>8</strong>
                                    <small class="text-secondary ms-2">9%</small>
                                </div>

                                <div class="health-item">
                                    <span class="health-dot bg-warning"></span>
                                    <span class="flex-grow-1">Maintenance</span>
                                    <strong>8</strong>
                                    <small class="text-secondary ms-2">9%</small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User Roles --}}
            <div class="col-12 col-xl-5">
                <div class="card dashboard-panel h-100">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-shield text-primary me-2"></i>
                            User Roles
                        </h5>

                        <a href="{{ url('/admin/users') }}"
                            class="btn btn-sm theme-btn">
                            <i class="fas fa-users-gear me-1"></i>
                            Manage Users
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="role-item">
                            <div class="role-icon role-viewer">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Viewer</h6>
                                <small class="text-secondary">Read-only monitoring access</small>
                            </div>
                            <i class="fas fa-chevron-right text-secondary"></i>
                        </div>

                        <div class="role-item">
                            <div class="role-icon role-technical">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Technical</h6>
                                <small class="text-secondary">Machines, sensors & maintenance</small>
                            </div>
                            <i class="fas fa-chevron-right text-secondary"></i>
                        </div>

                        <div class="role-item mb-0">
                            <div class="role-icon role-manager">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1">Manager</h6>
                                <small class="text-secondary">Management & reporting access</small>
                            </div>
                            <i class="fas fa-chevron-right text-secondary"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Recent Activity + System Status --}}
        <div class="row g-4">

            {{-- Recent Activity --}}
            <div class="col-12 col-xl-8">
                <div class="card dashboard-panel h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-clock text-primary me-2"></i>
                            Recent Activity
                        </h5>
                        <a href="{{ url('/admin/activity') }}"
                            class="small text-decoration-none fw-semibold">
                            View All
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle dashboard-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <i class="fas fa-user-plus text-success me-2"></i>
                                            New user registered
                                        </td>
                                        <td>sandeep.kumar</td>
                                        <td>Manager</td>
                                        <td>2 min ago</td>
                                        <td><span class="badge rounded-pill bg-success-subtle text-success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-file-lines text-primary me-2"></i>
                                            System report generated
                                        </td>
                                        <td>neha.sharma</td>
                                        <td>Technical</td>
                                        <td>15 min ago</td>
                                        <td><span class="badge rounded-pill bg-primary-subtle text-primary">Info</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-gears text-warning me-2"></i>
                                            Machine configuration updated
                                        </td>
                                        <td>rohit.verma</td>
                                        <td>Technical</td>
                                        <td>1 hour ago</td>
                                        <td><span class="badge rounded-pill bg-success-subtle text-success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-triangle-exclamation text-danger me-2"></i>
                                            Alert acknowledged
                                        </td>
                                        <td>vikas.singh</td>
                                        <td>Viewer</td>
                                        <td>2 hours ago</td>
                                        <td><span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">Warning</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-user-pen text-info me-2"></i>
                                            User role updated
                                        </td>
                                        <td>admin</td>
                                        <td>Manager</td>
                                        <td>3 hours ago</td>
                                        <td><span class="badge rounded-pill bg-success-subtle text-success">Success</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- System Status --}}
            <div class="col-12 col-xl-4">
                <div class="card dashboard-panel h-100">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-server text-primary me-2"></i>
                            System Status
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="system-status-item">
                            <div>
                                <i class="fas fa-server me-2 text-primary"></i>
                                <strong>Server Status</strong>
                                <small>Application services</small>
                            </div>
                            <span class="status-pill status-online">Online</span>
                        </div>

                        <div class="system-status-item">
                            <div>
                                <i class="fas fa-database me-2 text-primary"></i>
                                <strong>Database</strong>
                                <small>Database connection</small>
                            </div>
                            <span class="status-pill status-online">Connected</span>
                        </div>

                        <div class="system-status-item">
                            <div>
                                <i class="fas fa-network-wired me-2 text-primary"></i>
                                <strong>MQTT Integration</strong>
                                <small>Broker connection</small>
                            </div>
                            <span class="status-pill status-pending">In Progress</span>
                        </div>

                        <div class="system-status-item border-0 pb-0">
                            <div>
                                <i class="fas fa-plug me-2 text-primary"></i>
                                <strong>API Status</strong>
                                <small>API integration</small>
                            </div>
                            <span class="status-pill status-online">Active</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


                
            </div>
        </div>
    </div>
</main>
           


    @include('admin.include.footer')