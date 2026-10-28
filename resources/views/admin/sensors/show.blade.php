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
                            <h4 class="fw-bold mb-1">
                                <i class="fa-solid fa-microchip text-primary me-2"></i>
                                Sensor Details
                            </h4>
                            <p class="text-muted mb-0">
                                View sensor configuration, device information and current status.
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.sensors.edit', $sensor) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Edit Sensor
                            </a>

                            <a href="{{ route('admin.sensors.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Sensor Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-3">
                                    <i class="fa-solid fa-microchip fa-2x"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">
                                        {{ $sensor->device_id }}
                                    </h5>
                                    <p class="text-muted mb-0">
                                        {{ $sensor->sensor_type }}
                                    </p>
                                </div>

                                <div>
                                    @php
                                        $status = strtolower($sensor->status ?? '');

                                        $statusClass = match ($status) {
                                            'active', 'online', 'connected' => 'bg-success',
                                            'inactive', 'offline' => 'bg-secondary',
                                            'faulty', 'error' => 'bg-danger',
                                            'provisioning', 'pending' => 'bg-warning text-dark',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }} px-3 py-2">
                                        {{ ucfirst($sensor->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sensor Information --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                General Information
                            </h5>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <dl class="row mb-0">

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Sensor ID
                                </dt>
                                <dd class="col-12 col-md-9 fw-semibold mb-3 mb-md-3">
                                    #{{ $sensor->id }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Device ID
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    {{ $sensor->device_id ?: '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Sensor Type
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    {{ $sensor->sensor_type ?: '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Assigned Machine
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    {{ optional($sensor->machine)->name ?? 'Not assigned' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Firmware Version
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    {{ $sensor->firmware_version ?: '—' }}
                                </dd>

                            </dl>
                        </div>
                    </div>

                    {{-- Sensor Health --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-heart-pulse text-primary me-2"></i>
                                Sensor Health
                            </h5>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <div class="row g-3">

                                {{-- Battery Level --}}
                                <div class="col-12 col-md-6">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                                <i class="fa-solid fa-battery-half fa-lg"></i>
                                            </div>

                                            <div class="flex-grow-1">
                                                <div class="text-muted small mb-1">
                                                    Battery Level
                                                </div>

                                                <h5 class="fw-bold mb-0">
                                                    {{ $sensor->battery_level !== null ? $sensor->battery_level . '%' : '—' }}
                                                </h5>
                                            </div>
                                        </div>

                                        @if ($sensor->battery_level !== null)
                                            <div class="progress mt-3" style="height: 6px;">
                                                <div class="progress-bar
                                                    {{ $sensor->battery_level <= 20 ? 'bg-danger' : ($sensor->battery_level <= 50 ? 'bg-warning' : 'bg-success') }}"
                                                    role="progressbar"
                                                    style="width: {{ max(0, min(100, $sensor->battery_level)) }}%;"
                                                    aria-valuenow="{{ $sensor->battery_level }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Last Seen --}}
                                <div class="col-12 col-md-6">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                                <i class="fa-regular fa-clock fa-lg"></i>
                                            </div>

                                            <div>
                                                <div class="text-muted small mb-1">
                                                    Last Seen
                                                </div>

                                                <h6 class="fw-semibold mb-0">
                                                    {{ optional($sensor->last_seen)->format('Y-m-d H:i') ?? 'Never recorded' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Record Timestamps --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-regular fa-calendar text-primary me-2"></i>
                                Record Information
                            </h5>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <dl class="row mb-0">

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Created At
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    {{ optional($sensor->created_at)->toDayDateTimeString() ?? '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1">
                                    Last Updated
                                </dt>
                                <dd class="col-12 col-md-9 mb-0">
                                    {{ optional($sensor->updated_at)->toDayDateTimeString() ?? '—' }}
                                </dd>

                            </dl>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')
