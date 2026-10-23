@include('admin.include.header')


            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-custom bg-black">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 text-white">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </span>
                        <div class="navbar-nav ms-auto">
                            <span class="navbar-text text-white">
                                Welcome, {{ $admin->name }}!
                            </span>
                        </div>
                    </div>
                </nav>

                <div class="main-content">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Welcome Card -->
                    <div class="welcome-card">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-2">
                                    Welcome back, {{ $admin->name }}!
                                </h2>
                                <p class="mb-0">Here's what's happening with your PredictorMT system today.</p>
                            </div>
                            <!-- <div class="col-md-4 text-end">
                                <i class="fas fa-chart-line fa-4x opacity-75"></i>
                            </div> -->
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4 statsCard mt-5">
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card p-3 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-primary me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">1,234</h5>
                                        <small class="text-muted">Total Users</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card p-3 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-success me-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">567</h5>
                                        <small class="text-muted">Active Today</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card p-3 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-warning me-3">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">23</h5>
                                        <small class="text-muted">Pending Issues</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card p-3 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-info me-3">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">$12,345</h5>
                                        <small class="text-muted">Revenue</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card bg-white p-3">
                                <div class="card-header bg-transparent px-0">
                                    <h5 class="mb-0">
                                        <i class="fas fa-clock me-2"></i>
                                        Recent Activity
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <i class="fas fa-user-plus text-success me-2"></i>
                                                New user registered
                                            </div>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <i class="fas fa-chart-bar text-primary me-2"></i>
                                                System report generated
                                            </div>
                                            <small class="text-muted">15 minutes ago</small>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <i class="fas fa-cog text-warning me-2"></i>
                                                Settings updated
                                            </div>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-white p-2">
                                <div class="card-header bg-transparent px-0">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        System Status
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Server Status</span>
                                        <span class="badge bg-success">Online</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Database</span>
                                        <span class="badge bg-success">Connected</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>API Status</span>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Last Backup</span>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.include.footer')