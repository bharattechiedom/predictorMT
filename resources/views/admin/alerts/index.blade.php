@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-2">
                                    <i class="fa-solid fa-bell fa-lg"></i>
                                </div>
                                <h4 class="fw-bold mb-0">Alert Monitoring</h4>
                            </div>

                            <p class="text-muted mb-0">
                                Monitor system alerts across companies, machines and sensors.
                            </p>
                        </div>

                        <span class="badge bg-theme-primary  rounded-pill px-3 py-2">
                            <i class="fa-solid fa-shield-halved me-1"></i>
                            Read-only Access
                        </span>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Alert Summary --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-2">Total Alerts</p>
                                            <h3 class="fw-bold mb-0">
                                                {{ $alerts->total() }}
                                            </h3>
                                            <small class="text-muted">All recorded alerts</small>
                                        </div>

                                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                            <i class="fa-solid fa-bell fa-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-2">Current Page</p>
                                            <h3 class="fw-bold mb-0">
                                                {{ $alerts->count() }}
                                            </h3>
                                            <small class="text-muted">Alerts displayed below</small>
                                        </div>

                                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                            <i class="fa-solid fa-list-ul fa-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-2">Access Mode</p>
                                            <h5 class="fw-bold mb-1">View Only</h5>
                                            <small class="text-muted">Monitoring permissions</small>
                                        </div>

                                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                            <i class="fa-solid fa-eye fa-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alerts Table --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>
                                        System Alerts
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        Review alert sources and open a record for more information.
                                    </p>
                                </div>

                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    {{ $alerts->total() }} Records
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3 py-3">Alert ID</th>
                                            <th class="py-3">Company</th>
                                            <th class="py-3">Machine</th>
                                            <th class="py-3">Sensor</th>
                                            <th class="py-3">Level</th>
                                            <th class="py-3">Origin</th>
                                            <th class="text-center py-3 pe-3">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($alerts as $alert)
                                            <tr>
                                                <td class="px-3">
                                                    <span class="fw-bold text-primary">
                                                        #{{ $alert->id }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="bg-primary bg-opacity-10 text-primary rounded-2 p-2">
                                                            <i class="fa-solid fa-building"></i>
                                                        </div>

                                                        <span class="fw-semibold">
                                                            {{ optional($alert->company)->name ?? '—' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-gears text-muted"></i>
                                                        <span>
                                                            {{ optional($alert->machine)->name ?? '—' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    @if(optional($alert->sensor)->device_id)
                                                        <span class="badge bg-light text-dark border">
                                                            <i class="fa-solid fa-microchip me-1"></i>
                                                            {{ $alert->sensor->device_id }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @php
                                                        $level = strtolower((string) $alert->level);

                                                        $levelClass = match ($level) {
                                                            'critical', 'emergency', 'high', 'error' => 'bg-danger',
                                                            'warning', 'medium', 'moderate' => 'bg-warning text-dark',
                                                            'low', 'info', 'informational' => 'bg-info text-dark',
                                                            default => 'bg-secondary',
                                                        };

                                                        $levelIcon = match ($level) {
                                                            'critical', 'emergency', 'high', 'error' => 'fa-circle-exclamation',
                                                            'warning', 'medium', 'moderate' => 'fa-triangle-exclamation',
                                                            'low', 'info', 'informational' => 'fa-circle-info',
                                                            default => 'fa-bell',
                                                        };
                                                    @endphp

                                                    <span class="badge {{ $levelClass }} rounded-pill px-3 py-2">
                                                        <i class="fa-solid {{ $levelIcon }} me-1"></i>
                                                        {{ $alert->level ?: 'Unknown' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-muted">
                                                        {{ $alert->origin ?: '—' }}
                                                    </span>
                                                </td>

                                                <td class="text-center pe-3">
                                                    <div class="d-inline-flex gap-1 td_action">
                                                    <a href="{{ route('admin.alerts.show', $alert) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="View Alert Details"
                                                       aria-label="View Alert Details">
                                                        <i class="fa-solid fa-eye me-1"></i>
                                                    </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <div class="mb-3">
                                                        <i class="fa-regular fa-bell-slash fa-3x text-muted"></i>
                                                    </div>

                                                    <h6 class="fw-bold">No Alerts Found</h6>
                                                    <p class="text-muted small mb-0">
                                                        There are currently no alert records to display.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if($alerts->hasPages())
                            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">
                                {{ $alerts->links() }}
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2 text-muted small mt-3">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>This page is for viewing and monitoring alerts only.</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')