@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}

                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Machines Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Page Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fas fa-cogs fa-lg"></i>
                                    </div>

                                    <div>
                                        <h4 class="fw-bold mb-1">Machines Management</h4>
                                        <p class="text-muted mb-0 small">
                                            Manage registered machines, companies and machine status.
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center col-5">
                                    <div class="input-group search-input-group me-3">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>

                                        <input type="text"
                                            id="machineSearch"
                                            class="form-control border-start-0 ps-0"
                                            placeholder="Search by machine, company, type, serial or status...">
                                    </div>
                                        <a href="{{ route('admin.machines.create') }}"
                                        class="btn theme-btn btn-flex-none">
                                        <i class="fas fa-plus me-2"></i>Add Machine
                                    </a>

                                                       
                                </div>


                                
                            </div>
                        </div>

                      
                        {{-- Machines Table --}}
                        <div class="table-responsive list_Table">
                            <table class="table table-hover align-middle mb-0" id="machinesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Machine Name</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Serial Number</th>
                                        <th>Status</th>
                                        <th class="text-center pe-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($machines as $machine)
                                        <tr>
                                            <td class="ps-4 text-muted">
                                                #{{ $machine->id }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                        style="width: 38px; height: 38px;">
                                                        <i class="fas fa-cog"></i>
                                                    </div>

                                                    <span class="fw-semibold">
                                                        {{ $machine->name }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                @if (optional($machine->company)->name)
                                                    <span class="badge bg-info bg-opacity-10 text-info-emphasis">
                                                        {{ $machine->company->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">No Company</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $machine->machine_type ?? 'N/A' }}
                                            </td>

                                            <td>
                                                <span class="text-muted">
                                                    {{ $machine->serial_number ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                @php
                                                    $status = strtolower($machine->status ?? '');

                                                    $statusColors = [
                                                        'active' => 'success',
                                                        'inactive' => 'secondary',
                                                        'maintenance' => 'warning',
                                                        'pending' => 'info',
                                                    ];
                                                @endphp

                                                <span class="badge bg-{{ $statusColors[$status] ?? 'secondary' }}">
                                                    {{ $machine->status ?: 'N/A' }}
                                                </span>
                                            </td>

                                            <td class="text-center pe-4 text-nowrap">
                                              <div class="d-inline-flex gap-1 td_action">
                                                <a href="{{ route('admin.machines.show', $machine) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-2"
                                                    title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.machines.edit', $machine) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.machines.destroy', $machine) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Delete this machine?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-2"
                                                        title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                              </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="noMachinesFound">
                                            <td colspan="7" class="text-center py-5">
                                                <div class="mb-3">
                                                    <i class="fas fa-cogs fa-3x text-muted"></i>
                                                </div>

                                                <h6 class="fw-semibold">No machines found</h6>

                                                <p class="text-muted mb-3">
                                                    Add your first machine to get started.
                                                </p>

                                                <a href="{{ route('admin.machines.create') }}"
                                                    class="btn btn-primary btn-sm rounded-3">
                                                    <i class="fas fa-plus me-1"></i>Add Machine
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse

                                    {{-- Search Empty State --}}
                                    @if ($machines->count())
                                        <tr id="noMachineSearchResults" class="d-none">
                                            <td colspan="7" class="text-center py-4">
                                                <i class="fas fa-search fa-2x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">
                                                    No machines match your search.
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($machines->hasPages() || $machines->count())
                            <div class="card-footer bg-white border-0 px-4 py-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                    <p class="text-muted small mb-0">
                                        Showing
                                        {{ $machines->firstItem() ?? 0 }}
                                        to
                                        {{ $machines->lastItem() ?? 0 }}
                                        of
                                        {{ $machines->total() }}
                                        machines
                                    </p>

                                    <div>
                                        {{ $machines->links() }}
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

{{-- Client-side Table Search --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('machineSearch');
        const table = document.getElementById('machinesTable');

        if (!searchInput || !table) {
            return;
        }

        const rows = table.querySelectorAll(
            'tbody tr:not(#noMachineSearchResults)'
        );

        const noSearchResults = document.getElementById('noMachineSearchResults');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(function (row) {
                if (row.id === 'noMachinesFound') {
                    return;
                }

                const matches = row.textContent.toLowerCase().includes(searchTerm);

                row.classList.toggle('d-none', !matches);

                if (matches) {
                    visibleCount++;
                }
            });

            if (noSearchResults) {
                noSearchResults.classList.toggle(
                    'd-none',
                    searchTerm === '' || visibleCount > 0
                );
            }
        });
    });
</script>

@include('admin.include.footer')
