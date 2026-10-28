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
                                Predictions
                            </h4>
                            <p class="text-muted mb-0">
                                View and manage machine prediction records.
                            </p>
                        </div>

                        <a href="{{ route('admin.predictions.create') }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-plus"></i>
                            Add Prediction
                        </a>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Predictions Table --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <h5 class="fw-bold mb-1">Prediction Records</h5>
                                    <p class="text-muted small mb-0">
                                        Review prediction time, machine, sensor, probability and status.
                                    </p>
                                </div>

                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                    Total: {{ $predictions->total() }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3 py-3">#</th>
                                            <th class="py-3">Predicted At</th>
                                            <th class="py-3">Machine</th>
                                            <th class="py-3">Sensor</th>
                                            <th class="py-3">Probability</th>
                                            <th class="py-3">Status</th>
                                            <th class="text-center py-3 pe-3">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($predictions as $prediction)
                                            <tr>
                                                <td class="px-3 fw-semibold">
                                                    {{ $prediction->id }}
                                                </td>

                                                <td>
                                                    <span class="text-nowrap">
                                                        <i class="fa-regular fa-clock text-muted me-1"></i>
                                                        {{ optional($prediction->predicted_at)->format('Y-m-d H:i') ?? '—' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="fw-medium">
                                                        {{ optional($prediction->machine)->name ?? '—' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="badge bg-light text-dark border">
                                                        {{ optional($prediction->sensor)->device_id ?? '—' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $prediction->probability ?? '—' }}
                                                </td>

                                                <td>
                                                    @php
                                                        $status = strtolower((string) $prediction->status);

                                                        $statusClass = match ($status) {
                                                            'completed', 'success', 'successful', 'active' => 'bg-success',
                                                            'pending', 'processing', 'queued' => 'bg-warning text-dark',
                                                            'failed', 'error', 'rejected' => 'bg-danger',
                                                            default => 'bg-secondary',
                                                        };
                                                    @endphp

                                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                                        {{ $prediction->status ?: 'Unknown' }}
                                                    </span>
                                                </td>

                                                <td class="text-center pe-3">
                                                    <div class="d-inline-flex align-items-center gap-2">
                                                        <a href="{{ route('admin.predictions.show', $prediction) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="View Prediction"
                                                           aria-label="View Prediction">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.predictions.edit', $prediction) }}"
                                                           class="btn btn-sm btn-outline-warning"
                                                           title="Edit Prediction"
                                                           aria-label="Edit Prediction">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <form action="{{ route('admin.predictions.destroy', $prediction) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Delete this prediction?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    title="Delete Prediction"
                                                                    aria-label="Delete Prediction">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <i class="fa-solid fa-chart-line fa-2x text-muted mb-3"></i>
                                                    <h6 class="fw-semibold">No predictions found</h6>
                                                    <p class="text-muted small mb-0">
                                                        Prediction records will appear here when available.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if($predictions->hasPages())
                            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">
                                {{ $predictions->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
