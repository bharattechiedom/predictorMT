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
                                Prediction Details
                            </h4>
                            <p class="text-muted mb-0">
                                View prediction information, failure probability and explanation.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.predictions.edit', $prediction) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit Prediction
                            </a>

                            <a href="{{ route('admin.predictions.index') }}"
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

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @php
                        $status = strtolower((string) $prediction->status);

                        $statusClass = match ($status) {
                            'resolved', 'converted', 'completed', 'success' => 'bg-success',
                            'acknowledged' => 'bg-info text-dark',
                            'open', 'pending' => 'bg-warning text-dark',
                            'failed', 'error' => 'bg-danger',
                            default => 'bg-secondary',
                        };

                        $explanation = is_array($prediction->explanation)
                            ? json_encode($prediction->explanation, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                            : $prediction->explanation;
                    @endphp

                    {{-- Prediction Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fa-solid fa-chart-line fa-xl"></i>
                                    </div>

                                    <div>
                                        <h5 class="fw-bold mb-1">
                                            Prediction #{{ $prediction->id }}
                                        </h5>
                                        <p class="text-muted mb-0">
                                            {{ optional($prediction->machine)->name ?? 'Machine not assigned' }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                        {{ $prediction->status ?: 'Unknown' }}
                                    </span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-solid fa-gauge-high me-1"></i>
                                            Probability
                                        </div>
                                        <h5 class="fw-bold mb-0">
                                            {{ $prediction->probability ?? '—' }}
                                        </h5>
                                        <small class="text-muted">Range: 0–1</small>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-regular fa-clock me-1"></i>
                                            Predicted At
                                        </div>
                                        <div class="fw-semibold">
                                            {{ optional($prediction->predicted_at)->format('Y-m-d H:i') ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="text-muted small mb-2">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                            Predicted Failure At
                                        </div>
                                        <div class="fw-semibold">
                                            {{ optional($prediction->predicted_failure_at)->format('Y-m-d H:i') ?? '—' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Machine & Prediction Information --}}
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-xl-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                                            <i class="fa-solid fa-microchip fa-lg"></i>
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-1">Machine Information</h5>
                                            <p class="text-muted small mb-0">
                                                Associated machine and sensor details.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-3 p-md-4 pt-0">
                                    <div class="row g-3">
                                        <div class="col-5 text-muted">Prediction ID</div>
                                        <div class="col-7 fw-semibold">
                                            #{{ $prediction->id }}
                                        </div>

                                        <div class="col-5 text-muted">Machine</div>
                                        <div class="col-7 fw-semibold">
                                            {{ optional($prediction->machine)->name ?? '—' }}
                                        </div>

                                        <div class="col-5 text-muted">Sensor</div>
                                        <div class="col-7">
                                            @if(optional($prediction->sensor)->device_id)
                                                <span class="badge bg-light text-dark border">
                                                    {{ $prediction->sensor->device_id }}
                                                </span>
                                            @else
                                                <span class="text-muted">Not assigned</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-3 p-md-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                            <i class="fa-solid fa-brain fa-lg"></i>
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-1">Prediction Information</h5>
                                            <p class="text-muted small mb-0">
                                                Model and component details.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-3 p-md-4 pt-0">
                                    <div class="row g-3">
                                        <div class="col-5 text-muted">Component</div>
                                        <div class="col-7 fw-semibold">
                                            {{ $prediction->component ?: '—' }}
                                        </div>

                                        <div class="col-5 text-muted">Model Version</div>
                                        <div class="col-7">
                                            @if($prediction->model_version)
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle">
                                                    {{ $prediction->model_version }}
                                                </span>
                                            @else
                                                —
                                            @endif
                                        </div>

                                        <div class="col-5 text-muted">Status</div>
                                        <div class="col-7">
                                            <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                                {{ $prediction->status ?: 'Unknown' }}
                                            </span>
                                        </div>

                                        <div class="col-5 text-muted">Probability</div>
                                        <div class="col-7 fw-semibold">
                                            {{ $prediction->probability ?? '—' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Explanation --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                    <i class="fa-solid fa-code fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Prediction Explanation</h5>
                                    <p class="text-muted small mb-0">
                                        Explanation data associated with this prediction.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            @if(filled($explanation))
                                <pre class="bg-light border rounded-3 p-3 mb-0 text-break"
                                     style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $explanation }}</pre>
                            @else
                                <div class="text-center py-4">
                                    <i class="fa-solid fa-file-circle-question fa-2x text-muted mb-3"></i>
                                    <h6 class="fw-semibold">No explanation available</h6>
                                    <p class="text-muted small mb-0">
                                        No explanation data has been added to this prediction.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Bottom Actions --}}
                    <div class="d-flex flex-wrap justify-content-end gap-2">
                        <a href="{{ route('admin.predictions.index') }}"
                           class="btn btn-dark fs-14">
                            <i class="fa-solid fa-list me-2"></i>
                            All Predictions
                        </a>

                        <a href="{{ route('admin.predictions.edit', $prediction) }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Prediction
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')