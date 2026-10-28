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

                                <h4 class="fw-bold mb-0">Alert Details</h4>
                            </div>

                            <p class="text-muted mb-0">
                                Review alert information, source and acknowledgement details.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="badge bg-dark rounded-pill px-3 py-2">
                                <i class="fa-solid fa-eye me-1"></i>
                                View Only
                            </span>

                            <a href="{{ route('admin.alerts.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Alerts
                            </a>
                        </div>
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

                        $payload = is_array($alert->payload)
                            ? json_encode($alert->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                            : $alert->payload;
                    @endphp

                    {{-- Alert Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                                        <i class="fa-solid {{ $levelIcon }} fa-xl"></i>
                                    </div>

                                    <div>
                                        <h5 class="fw-bold mb-1">
                                            Alert #{{ $alert->id }}
                                        </h5>

                                        <p class="text-muted mb-0">
                                            {{ optional($alert->company)->name ?? 'Company not assigned' }}
                                        </p>
                                    </div>
                                </div>

                                <span class="badge {{ $levelClass }} rounded-pill px-3 py-2">
                                    <i class="fa-solid {{ $levelIcon }} me-1"></i>
                                    {{ $alert->level ?: 'Unknown Level' }}
                                </span>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-solid fa-building me-1"></i>
                                            Company
                                        </div>

                                        <div class="fw-semibold">
                                            {{ optional($alert->company)->name ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-solid fa-gears me-1"></i>
                                            Machine
                                        </div>

                                        <div class="fw-semibold">
                                            {{ optional($alert->machine)->name ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-solid fa-microchip me-1"></i>
                                            Sensor
                                        </div>

                                        <div class="fw-semibold">
                                            {{ optional($alert->sensor)->device_id ?? '—' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alert Message --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                    <i class="fa-solid fa-message fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Alert Message</h5>
                                    <p class="text-muted small mb-0">
                                        Message associated with this alert.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4 pt-0">
                            @if(filled($alert->message))
                                <div class="border-start border-4 border-warning bg-light rounded-end p-3">
                                    <p class="mb-0 text-break">{{ $alert->message }}</p>
                                </div>
                            @else
                                <p class="text-muted mb-0">
                                    No message is available for this alert.
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Alert Information --}}
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-xl-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                            <i class="fa-solid fa-circle-info fa-lg"></i>
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-1">Alert Information</h5>
                                            <p class="text-muted small mb-0">
                                                General alert identification details.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-3 p-md-4 pt-0">
                                    <div class="row g-3">
                                        <div class="col-5 text-muted">Alert ID</div>
                                        <div class="col-7 fw-semibold">
                                            #{{ $alert->id }}
                                        </div>

                                        <div class="col-5 text-muted">Level</div>
                                        <div class="col-7">
                                            <span class="badge {{ $levelClass }} rounded-pill px-3 py-2">
                                                {{ $alert->level ?: 'Unknown' }}
                                            </span>
                                        </div>

                                        <div class="col-5 text-muted">Origin</div>
                                        <div class="col-7 fw-semibold text-break">
                                            {{ $alert->origin ?: '—' }}
                                        </div>

                                        <div class="col-5 text-muted">Company</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($alert->company)->name ?? '—' }}
                                        </div>

                                        <div class="col-5 text-muted">Machine</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($alert->machine)->name ?? '—' }}
                                        </div>

                                        <div class="col-5 text-muted">Sensor</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($alert->sensor)->device_id ?? '—' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Acknowledgement Details --}}
                        <div class="col-12 col-xl-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                            <i class="fa-solid fa-user-check fa-lg"></i>
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-1">Acknowledgement Details</h5>
                                            <p class="text-muted small mb-0">
                                                Information about alert acknowledgement.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-3 p-md-4 pt-0">
                                    <div class="row g-3">
                                        <div class="col-5 text-muted">Acknowledged By</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($alert->acknowledgedBy)->name ?? ($alert->acknowledged_by ?? '—') }}
                                        </div>

                                        <div class="col-5 text-muted">Acknowledged At</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($alert->acknowledged_at)->format('Y-m-d H:i') ?? '—' }}
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    @if($alert->acknowledged_at || $alert->acknowledged_by || optional($alert->acknowledgedBy)->name)
                                        <div class="d-flex align-items-start gap-2 text-success">
                                            <i class="fa-solid fa-circle-check mt-1"></i>
                                            <div>
                                                <div class="fw-semibold">Acknowledgement Recorded</div>
                                                <small class="text-muted">
                                                    Acknowledgement information is available for this alert.
                                                </small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-start gap-2 text-muted">
                                            <i class="fa-regular fa-clock mt-1"></i>
                                            <div>
                                                <div class="fw-semibold">No Acknowledgement Details</div>
                                                <small>
                                                    No acknowledgement information is currently recorded.
                                                </small>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payload --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-dark bg-opacity-10 text-dark rounded-3 p-3">
                                    <i class="fa-solid fa-code fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Alert Payload</h5>
                                    <p class="text-muted small mb-0">
                                        Raw structured data associated with the alert.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            @if(filled($payload))
                                <pre class="bg-light border rounded-3 p-3 mb-0 text-break"
                                     style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $payload }}</pre>
                            @else
                                <div class="text-center py-4">
                                    <i class="fa-solid fa-file-circle-question fa-2x text-muted mb-3"></i>
                                    <h6 class="fw-semibold">No Payload Available</h6>
                                    <p class="text-muted small mb-0">
                                        There is no additional payload data for this alert.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Bottom Navigation --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.alerts.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to All Alerts
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
