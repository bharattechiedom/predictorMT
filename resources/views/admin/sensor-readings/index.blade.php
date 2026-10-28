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
                                Sensor Readings
                            </h4>
                            <p class="text-muted mb-0">
                                Monitor recorded sensor measurements and machine readings.
                            </p>
                        </div>

                        <a href="{{ route('admin.sensor-readings.create') }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-plus me-1"></i>
                            Add Reading
                        </a>
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

                    {{-- Readings Table --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <h5 class="fw-bold mb-1">All Readings</h5>
                                    <p class="text-muted small mb-0">
                                        View sensor values and associated machines.
                                    </p>
                                </div>

                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    {{ $readings->total() }} Records
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3 py-3">#</th>
                                            <th class="py-3">Timestamp</th>
                                            <th class="py-3">Sensor</th>
                                            <th class="py-3">Machine</th>
                                            <th class="py-3">Value</th>
                                            <th class="text-center py-3 pe-3">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($readings as $reading)
                                            <tr>
                                                <td class="px-3">
                                                    <span class="fw-semibold">
                                                        {{ $reading->id }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="fa-regular fa-clock text-muted"></i>
                                                        <span>
                                                            {{ optional($reading->timestamp)->format('Y-m-d H:i') ?? '—' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                                            <i class="fa-solid fa-microchip"></i>
                                                        </span>
                                                        <span class="fw-medium">
                                                            {{ optional($reading->sensor)->device_id ?? '—' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-gears text-muted"></i>
                                                        <span>
                                                            {{ optional($reading->machine)->name ?? '—' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="badge bg-light text-dark border px-3 py-2">
                                                        {{ $reading->value_float ?? '—' }}
                                                    </span>
                                                </td>

                                                <td class="text-center pe-3">
                                                    <div class="d-inline-flex align-items-center gap-1">

                                                        <a href="{{ route('admin.sensor-readings.show', $reading) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="View Reading"
                                                           aria-label="View Reading">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.sensor-readings.edit', $reading) }}"
                                                           class="btn btn-sm btn-outline-warning"
                                                           title="Edit Reading"
                                                           aria-label="Edit Reading">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <form action="{{ route('admin.sensor-readings.destroy', $reading) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Delete this reading?');"
                                                              class="d-inline">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    title="Delete Reading"
                                                                    aria-label="Delete Reading">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="text-muted">
                                                        <i class="fa-solid fa-chart-line fa-2x mb-3"></i>
                                                        <h6 class="fw-semibold">No readings found</h6>
                                                        <p class="small mb-3">
                                                            No sensor readings are available yet.
                                                        </p>

                                                        <a href="{{ route('admin.sensor-readings.create') }}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fa-solid fa-plus me-1"></i>
                                                            Add Reading
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if ($readings->hasPages())
                            <div class="card-footer bg-white border-0 p-3">
                                {{ $readings->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')