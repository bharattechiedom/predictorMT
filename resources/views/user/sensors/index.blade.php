@php
    $page_title = 'Sensor Management';
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
                            <h3 class="fw-bold mb-1">Sensor Management</h3>
                            <p class="text-muted mb-0">
                                Monitor sensor readings, connectivity and battery status.
                            </p>
                        </div>

                        <a href="{{ route('user.sensors.create') }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-plus me-1"></i>
                            Add Sensor
                        </a>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3"
                             role="alert">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Sensor Table --}}
                    <div class="card border-0 shadow-none mt-3">
                        <div class="card-header p-0 mt-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <div>
                                    <h5 class="fw-bold mb-1">All Sensors</h5>
                                    <p class="text-muted small mb-0">
                                        Sensor information and latest available readings.
                                    </p>
                                </div>

                                <div class="input-search-group">
                                    <span class="input-group-text bg-white p-0 border-0">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>

                                    <input type="search"
                                           class="form-control border-0 h-auto"
                                           id="sensorSearch"
                                           placeholder="Search sensors...">
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <div class="table-responsive">
                                <table class="table align-middle table-hover m-0"
                                       id="sensorsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">Device ID</th>
                                            <th>Sensor</th>
                                            <th>Machine</th>
                                            <th>Type</th>
                                            <th>Current Value</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th>Battery</th>
                                            <th>Last Seen</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($sensors as $sensor)
                                            @php
                                                $status = strtolower($sensor->status ?? '');

                                                $statusClass = [
                                                    'active' => 'success',
                                                    'inactive' => 'warning',
                                                    'faulty' => 'danger',
                                                    'provisioning' => 'info',
                                                ][$status] ?? 'secondary';

                                                $sensorName = $sensor->sensor_type ?? 'Sensor';

                                                $battery = is_numeric($sensor->battery_level)
                                                    ? max(0, min(100, (float) $sensor->battery_level))
                                                    : null;
                                            @endphp

                                            <tr>
                                                <td class="px-2">
                                                        {{ $sensor->device_id ?? '—' }}
                                                </td>

                                                <td>{{ $sensorName }}</td>

                                                <td>
                                                    {{ $sensor->machine->name ?? '—' }}
                                                </td>

                                                <td>{{ $sensor->sensor_type ?? '—' }}</td>

                                                <td>—</td>

                                                <td>—</td>

                                                <td>
                                                    <span class="badge bg-{{ $statusClass }} {{ $status === 'inactive' ? 'text-dark' : '' }}">
                                                        {{ $sensor->status ? ucwords(str_replace('_', ' ', $sensor->status)) : 'Unknown' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if ($battery !== null)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="progress flex-grow-1"
                                                                 role="progressbar"
                                                                 aria-label="Battery level"
                                                                 aria-valuenow="{{ $battery }}"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100"
                                                                 style="height: 8px; min-width: 50px;">
                                                                <div class="progress-bar bg-{{ $battery > 20 ? 'success' : 'danger' }}"
                                                                     style="width: {{ $battery }}%">
                                                                </div>
                                                            </div>

                                                            <span class="small text-nowrap">
                                                                {{ rtrim(rtrim(number_format($battery, 1), '0'), '.') }}%
                                                            </span>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $sensor->last_seen ? $sensor->last_seen->diffForHumans() : 'Never' }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center gap-1 td_action_btn">
                                                        <a href="{{ route('user.sensors.show', $sensor) }}"
                                                           class="btn btn-outline-primary"
                                                           title="View"
                                                           aria-label="View sensor">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('user.sensors.edit', $sensor) }}"
                                                           class="btn btn-outline-warning"
                                                           title="Edit"
                                                           aria-label="Edit sensor">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>

                                                        <form method="POST"
                                                              action="{{ route('user.sensors.destroy', $sensor) }}"
                                                              onsubmit="return confirm('Are you sure you want to delete this sensor?')">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-outline-danger"
                                                                    title="Delete"
                                                                    aria-label="Delete sensor">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr id="noSensorsRow">
                                                <td colspan="10" class="text-center py-4 text-muted">
                                                    <i class="fa-solid fa-microchip fa-lg mb-2"></i>
                                                    <div>No sensors found.</div>
                                                </td>
                                            </tr>
                                        @endforelse

                                        <tr id="noSensorResults" class="d-none">
                                            <td colspan="10" class="text-center py-4 text-muted">
                                                <i class="fa-solid fa-magnifying-glass me-1"></i>
                                                No matching sensors found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if ($sensors->count())
                            <div class="mt-3">
                                {{ $sensors->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

{{-- Sensor Search --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('sensorSearch');
    const table = document.getElementById('sensorsTable');
    const noResults = document.getElementById('noSensorResults');

    if (!searchInput || !table) return;

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr:not(#noSensorResults)');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matches = row.textContent.toLowerCase().includes(searchTerm);

            row.classList.toggle('d-none', !matches);

            if (matches) visibleCount++;
        });

        if (noResults) {
            noResults.classList.toggle('d-none', visibleCount > 0);
        }
    });
});
</script>

@include('user.include.footer')
