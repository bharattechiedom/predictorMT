
@php
    $page_title = 'Machine Management';
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

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold mb-1">Machine Management</h3>
                            <p class="text-muted mb-0">
                                Monitor machine health, status and performance.
                            </p>
                        </div>

                        <a href="{{ route('user.machines.create') }}"
                            class="btn theme-btn">
                            <i class="fa-solid fa-plus me-1"></i> Add Machine
                        </a>
                    </div>

                    {{-- Machine Table --}}
                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-header bg-white border-0">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <h5 class="fw-bold mb-0 fs-4">All Machines</h5>

                                <div class="input-search-group">
                                    <span class="input-group-text bg-white p-0 border-0">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="search"
                                           class="form-control"
                                           id="machineSearch"
                                           placeholder="Search machines...">
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle m-0"
                                       id="machinesTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">#</th>
                                            <th>Machine</th>
                                            <th>Type</th>
                                            <th>Serial Number</th>
                                            <th>Plant</th>
                                            <th>Health</th>
                                            <th>Status</th>
                                            <th>Last Update</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($machines as $machine)
                                            @php
                                                $health = $machine->health ?? null;
                                                $status = strtolower($machine->status ?? '');
                                            @endphp

                                            <tr>
                                                <td class="px-3">
                                                    {{ $loop->iteration + ($machines->currentPage() - 1) * $machines->perPage() }}
                                                </td>

                                                <td>
                                                    
                                                        {{ $machine->name }}
                                                </td>

                                                <td>{{ $machine->machine_type ?? '-' }}</td>
                                                <td>{{ $machine->serial_number ?? '-' }}</td>
                                                <td>{{ $machine->location ?? 'Plant A' }}</td>

                                                <td>
                                                    @if(is_numeric($health))
                                                        <span class="badge {{ $health >= 90 ? 'bg-success' : ($health >= 75 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                            {{ $health }}%
                                                        </span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @switch($status)
                                                        @case('running')
                                                            <span class="badge bg-success">
                                                                <i class="fa-solid fa-circle me-1"></i> Running
                                                            </span>
                                                            @break

                                                        @case('idle')
                                                            <span class="badge bg-warning text-dark">
                                                                <i class="fa-solid fa-pause me-1"></i> Idle
                                                            </span>
                                                            @break

                                                        @case('fault')
                                                            <span class="badge bg-danger">
                                                                <i class="fa-solid fa-triangle-exclamation me-1"></i> Fault
                                                            </span>
                                                            @break

                                                        @case('maintenance')
                                                            <span class="badge bg-info text-dark">
                                                                <i class="fa-solid fa-screwdriver-wrench me-1"></i> Maintenance
                                                            </span>
                                                            @break

                                                        @default
                                                            <span class="badge bg-secondary">
                                                                {{ $machine->status ?? 'Unknown' }}
                                                            </span>
                                                    @endswitch
                                                </td>

                                                <td>
                                                    {{ $machine->updated_at ? $machine->updated_at->diffForHumans() : '-' }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center gap-1 td_action_btn">
                                                        <a href="{{ route('user.machines.show', $machine) }}"
                                                           class="btn btn-outline-primary"
                                                           title="View"
                                                           aria-label="View machine">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('user.machines.edit', $machine) }}"
                                                           class="btn btn-outline-warning"
                                                           title="Edit"
                                                           aria-label="Edit machine">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </a>

                                                        <form method="POST"
                                                              action="{{ route('user.machines.destroy', $machine) }}"
                                                              onsubmit="return confirm('Are you sure you want to delete this machine?')">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-outline-danger"
                                                                    title="Delete"
                                                                    aria-label="Delete machine">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            {{-- Demo row: shown only when database is empty --}}
                                            <tr class="dummy-machine">
                                                <td class="px-3">1</td>
                                                <td class="fw-semibold">Industrial Motor 01</td>
                                                <td>Electric Motor</td>
                                                <td>MTR-1001</td>
                                                <td>Plant A</td>
                                                <td>
                                                    <span class="badge bg-success">96%</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        <i class="fa-solid fa-circle me-1"></i> Running
                                                    </span>
                                                </td>
                                                <td>2 minutes ago</td>
                                                <td class="text-center">
                                                    <span class="text-muted small">Demo Record</span>
                                                </td>
                                            </tr>
                                        @endforelse

                                        <tr id="noMachineResults" class="d-none">
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                <i class="fa-solid fa-magnifying-glass me-1"></i>
                                                No matching machines found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($machines->count())
                            <div class="card-footer bg-white">
                                {{ $machines->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('machineSearch');
    const table = document.getElementById('machinesTable');
    const noResults = document.getElementById('noMachineResults');

    if (!searchInput || !table) return;

    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr:not(#noMachineResults)');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matches = row.textContent.toLowerCase().includes(term);
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
