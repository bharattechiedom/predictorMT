@php
    $page_title = 'Sensor Details';
@endphp

@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>

            <div class="col-md-10">
                <div class="page-content m-auto p-3 mt-5">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold mb-1">Sensor Details</h3>
                            <p class="text-muted mb-0">
                                View sensor information, machine assignment and device status.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('user.sensors.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left me-1"></i>
                                Back to Sensors
                            </a>

                            <a href="{{ route('user.sensors.edit', $sensor) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Edit Sensor
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close">
                            </button>
                        </div>
                    @endif

                    {{-- Sensor Information --}}
                    <div class="card border-0 shadow-none mt-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-microchip me-2 text-primary"></i>
                                Sensor Information
                            </h5>
                            <p class="text-muted small mb-0">
                                Complete details of the selected sensor.
                            </p>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <div class="row g-3">

                                {{-- Sensor ID --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Sensor ID</div>
                                        <div class="fw-semibold text-dark">{{ $sensor->id }}</div>
                                    </div>
                                </div>

                                {{-- Device ID --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Device ID</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $sensor->device_id ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Sensor Type --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Sensor Type</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $sensor->sensor_type ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Machine --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Assigned Machine</div>
                                        <div class="fw-semibold text-dark">
                                            {{ optional($sensor->machine)->name ?: 'Not Assigned' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Firmware Version --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Firmware Version</div>
                                        <div class="fw-semibold text-dark">
                                            {{ $sensor->firmware_version ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Battery Level --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-2">Battery Level</div>

                                        @if (is_numeric($sensor->battery_level))
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1"
                                                     role="progressbar"
                                                     aria-label="Battery level"
                                                     aria-valuenow="{{ max(0, min(100, (float) $sensor->battery_level)) }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100"
                                                     style="height: 8px;">
                                                    <div class="progress-bar {{ $sensor->battery_level <= 20 ? 'bg-danger' : ($sensor->battery_level <= 50 ? 'bg-warning' : 'bg-success') }}"
                                                         style="width: {{ max(0, min(100, (float) $sensor->battery_level)) }}%;">
                                                    </div>
                                                </div>

                                                <span class="fw-semibold">
                                                    {{ $sensor->battery_level }}%
                                                </span>
</div>
                                        @else
                                            <div class="fw-semibold text-dark">—</div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Last Seen --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Last Seen</div>
                                        <div class="fw-semibold text-dark">
                                            {{ optional($sensor->last_seen)->format('Y-m-d H:i') ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-2">Status</div>

                                        @php
                                            $status = strtolower($sensor->status ?? '');

                                            $statusClass = match ($status) {
                                                'active' => 'bg-success',
                                                'inactive' => 'bg-warning text-dark',
                                                'faulty' => 'bg-danger',
                                                'provisioning' => 'bg-info text-dark',
                                                default => 'bg-secondary',
                                            };
                                        @endphp

                                        <span class="badge {{ $statusClass }}">
                                            {{ $sensor->status ? ucfirst($sensor->status) : 'Unknown' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Created At --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Created At</div>
                                        <div class="fw-semibold text-dark">
                                            {{ optional($sensor->created_at)->toDayDateTimeString() ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Updated At --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">Last Updated</div>
                                        <div class="fw-semibold text-dark">
                                            {{ optional($sensor->updated_at)->toDayDateTimeString() ?? '—' }}
                                        </div>
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

@include('user.include.footer')