@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Sensors Management Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Page Header --}}
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fa-solid fa-tower-broadcast fs-4"></i>
                                    </div>

                                    <div>
                                        <h4 class="fw-bold mb-1">Sensors Management</h4>
                                        <p class="text-muted small mb-0">
                                            Manage sensors, connected machines and device status.
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('admin.sensors.create') }}"
                                   class="btn theme-btn">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Sensor
                                </a>
                            </div>
                        </div>

                        {{-- Sensors Table --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3 ps-md-4">ID</th>
                                        <th>Device ID</th>
                                        <th>Sensor Type</th>
                                        <th>Machine</th>
                                        <th>Status</th>
                                        <th>Last Seen</th>
                                        <th class="text-center pe-3 pe-md-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($sensors as $sensor)
                                        <tr>
                                            {{-- ID --}}
                                            <td class="ps-3 ps-md-4 text-muted">
                                                #{{ $sensor->id }}
                                            </td>

                                            {{-- Device ID --}}
                                            <td>
                                                <span class="fw-semibold text-break">
                                                    {{ $sensor->device_id ?: 'N/A' }}
                                                </span>
                                            </td>

                                            {{-- Sensor Type --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                                        <i class="fa-solid fa-microchip"></i>
                                                    </div>

                                                    <span>
                                                        {{ $sensor->sensor_type ?: 'N/A' }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Machine --}}
                                            <td>
                                                @if (optional($sensor->machine)->name)
                                                    <span class="badge bg-info bg-opacity-10 text-info-emphasis">
                                                        <i class="fa-solid fa-gears me-1"></i>
                                                        {{ $sensor->machine->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                @php
                                                    $sensorStatus = strtolower((string) $sensor->status);

                                                    $statusColors = [
                                                        'active' => 'success',
                                                        'online' => 'success',
                                                        'connected' => 'success',
                                                        'inactive' => 'secondary',
                                                        'offline' => 'secondary',
                                                        'pending' => 'warning',
                                                        'error' => 'danger',
                                                        'fault' => 'danger',
                                                    ];

                                                    $statusColor = $statusColors[$sensorStatus] ?? 'secondary';
                                                @endphp

                                                <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-3 py-2">
                                                    {{ $sensor->status ?: 'Unknown' }}
                                                </span>
                                            </td>

                                            {{-- Last Seen --}}
                                            <td class="text-nowrap">
                                                <span class="text-muted">
                                                    <i class="fa-regular fa-clock me-1"></i>
                                                    {{ optional($sensor->last_seen)->format('Y-m-d H:i') ?? 'N/A' }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="text-center pe-3 pe-md-4 text-nowrap">
                                                <div class="d-inline-flex align-items-center gap-1 td_action">

                                                    <a href="{{ route('admin.sensors.show', $sensor) }}"
                                                       class="btn btn-sm btn-outline-primary rounded-2"
                                                       title="View"
                                                       aria-label="View sensor">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.sensors.edit', $sensor) }}"
                                                       class="btn btn-sm btn-outline-warning rounded-2"
                                                       title="Edit"
                                                       aria-label="Edit sensor">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    <form action="{{ route('admin.sensors.destroy', $sensor) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Delete this sensor?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger rounded-2"
                                                                title="Delete"
                                                                aria-label="Delete sensor">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="mb-3">
                                                    <i class="fa-solid fa-tower-broadcast fs-1 text-muted"></i>
                                                </div>

                                                <h6 class="fw-semibold">No sensors found</h6>

                                                <p class="text-muted mb-3">
                                                    Get started by adding your first sensor.
                                                </p>

                                                <a href="{{ route('admin.sensors.create') }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-plus me-1"></i>
                                                    Add Sensor
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($sensors->hasPages() || $sensors->count())
                            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                    <p class="text-muted small mb-0">
                                        Showing {{ $sensors->firstItem() ?? 0 }}
                                        to {{ $sensors->lastItem() ?? 0 }}
                                        of {{ $sensors->total() }} sensors
                                    </p>

                                    <div>
                                        {{ $sensors->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
