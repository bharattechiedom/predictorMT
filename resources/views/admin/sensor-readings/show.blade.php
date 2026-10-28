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
                                <i class="fa-solid fa-chart-line text-primary me-2"></i>
                                Sensor Reading Details
                            </h4>
                            <p class="text-muted mb-0">
                                View recorded sensor measurements and associated device information.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.sensor-readings.edit', $reading) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Edit Reading
                            </a>

                            <a href="{{ route('admin.sensor-readings.index') }}"
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

                    {{-- Reading Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-3">
                                    <i class="fa-solid fa-wave-square fa-2x"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">
                                        Reading #{{ $reading->id }}
                                    </h5>
                                    <p class="text-muted mb-0">
                                        {{ optional($reading->timestamp)->format('d M Y, H:i') ?? 'Timestamp unavailable' }}
                                    </p>
                                </div>

                                <div class="text-md-end">
                                    <div class="text-muted small mb-1">Recorded Value</div>
                                    <h4 class="fw-bold text-primary mb-0">
                                        {{ $reading->value_float ?? '—' }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Reading Information --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                Reading Information
                            </h5>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <dl class="row mb-0">

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Reading ID
                                </dt>
                                <dd class="col-12 col-md-9 fw-semibold mb-3 mb-md-3">
                                    #{{ $reading->id }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Timestamp
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    <i class="fa-regular fa-clock text-muted me-2"></i>
                                    {{ optional($reading->timestamp)->format('Y-m-d H:i') ?? '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Sensor
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    <i class="fa-solid fa-microchip text-muted me-2"></i>
                                    {{ optional($reading->sensor)->device_id ?? '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1 mb-md-3">
                                    Machine
                                </dt>
                                <dd class="col-12 col-md-9 mb-3 mb-md-3">
                                    <i class="fa-solid fa-gears text-muted me-2"></i>
                                    {{ optional($reading->machine)->name ?? '—' }}
                                </dd>

                                <dt class="col-12 col-md-3 text-muted mb-1">
                                    Measurement Value
                                </dt>
                                <dd class="col-12 col-md-9 mb-0">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        {{ $reading->value_float ?? '—' }}
                                    </span>
                                </dd>

                            </dl>
                        </div>
                    </div>

                    {{-- Payload --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <h5 class="fw-bold mb-0">
                                    <i class="fa-solid fa-code text-primary me-2"></i>
                                    Payload (JSON)
                                </h5>

                                <span class="badge bg-light text-dark border">
                                    Raw Data
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            @php
                                $payload = is_array($reading->payload)
                                    ? json_encode($reading->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                                    : $reading->payload;
                            @endphp

                            @if (!empty($payload))
                                <pre class="bg-light border rounded-3 p-3 mb-0 font-monospace text-break"
                                     style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $payload }}</pre>
                            @else
                                <div class="text-center text-muted py-4">
                                    <i class="fa-regular fa-file-code fa-2x mb-2"></i>
                                    <p class="mb-0">No payload data available for this reading.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')
