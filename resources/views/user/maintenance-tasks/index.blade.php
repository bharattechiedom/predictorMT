@php
    $page_title = 'Maintenance';
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
                            <h3 class="fw-bold mb-1">Fault &amp; Maintenance</h3>
                            <p class="text-muted mb-0">
                                Monitor machine faults, maintenance schedules and recovery activities.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <div class="position-relative">
                                <input type="text"
                                       class="form-control pe-5 h-auto"
                                       id="maintenanceSearch"
                                       placeholder="Search maintenance tasks..."
                                       aria-label="Search maintenance tasks">

                                <i class="fa-solid fa-magnifying-glass position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                            </div>

                            <a href="{{ route('user.maintenance-tasks.create') }}" class="btn theme-btn">
                                <i class="fa-solid fa-plus me-1"></i>
                                New Task
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
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- KPI Cards --}}
                    <div class="row g-3 mt-2">

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">Active Faults</p>
                                            <h3 class="fw-bold text-danger mb-0">08</h3>
                                        </div>
                                        <i class="fa-solid fa-triangle-exclamation fs-3 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">Critical</p>
                                            <h3 class="fw-bold text-warning mb-0">02</h3>
                                        </div>
                                        <i class="fa-solid fa-radiation fs-3 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">Scheduled</p>
                                            <h3 class="fw-bold text-primary mb-0">05</h3>
                                        </div>
                                        <i class="fa-regular fa-calendar-check fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">Resolved</p>
                                            <h3 class="fw-bold text-success mb-0">12</h3>
                                        </div>
                                        <i class="fa-solid fa-circle-check fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">MTTR</p>
                                            <h3 class="fw-bold text-info mb-0">2.5h</h3>
                                        </div>
                                        <i class="fa-solid fa-stopwatch fs-3 text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <p class="text-muted small mb-2">Machine Health</p>
                                            <h3 class="fw-bold text-success mb-0">96%</h3>
                                        </div>
                                        <i class="fa-solid fa-heart-pulse fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Active Faults and Fault Summary --}}
                    <div class="row g-3 mt-2">

                        <div class="col-xl-8">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header p-3">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-list me-2 text-primary"></i>
                                        Active Faults
                                    </h5>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="ps-3">Machine</th>
                                                    <th>Fault</th>
                                                    <th>Severity</th>
                                                    <th>Started</th>
                                                    <th>Status</th>
                                                    <th>Engineer</th>
                                                    <th class="pe-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="ps-3">Motor-01</td>
                                                    <td>Bearing Failure</td>
                                                    <td><span class="badge bg-danger">Critical</span></td>
                                                    <td>10:20 AM</td>
                                                    <td><span class="badge bg-danger">Active</span></td>
                                                    <td>John</td>
                                                    <td class="pe-3">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="showMaintenanceInfo('Motor-01', 'Bearing Failure', 'Critical')">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3">Pump-01</td>
                                                    <td>Pressure Leakage</td>
                                                    <td><span class="badge bg-warning text-dark">High</span></td>
                                                    <td>09:45 AM</td>
                                                    <td><span class="badge bg-warning text-dark">Monitoring</span></td>
                                                    <td>Alex</td>
                                                    <td class="pe-3">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="showMaintenanceInfo('Pump-01', 'Pressure Leakage', 'High')">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3">Fan-01</td>
                                                    <td>High Vibration</td>
                                                    <td><span class="badge bg-info text-dark">Medium</span></td>
                                                    <td>08:30 AM</td>
                                                    <td><span class="badge bg-info text-dark">Pending</span></td>
                                                    <td>Mike</td>
                                                    <td class="pe-3">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="showMaintenanceInfo('Fan-01', 'High Vibration', 'Medium')">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3">Generator-01</td>
                                                    <td>Motor Overheating</td>
                                                    <td><span class="badge bg-danger">Critical</span></td>
                                                    <td>11:05 AM</td>
                                                    <td><span class="badge bg-danger">Active</span></td>
                                                    <td>David</td>
                                                    <td class="pe-3">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                                onclick="showMaintenanceInfo('Generator-01', 'Motor Overheating', 'Critical')">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Fault Summary --}}
                        <div class="col-xl-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header p-3">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-chart-pie me-2 text-primary"></i>
                                        Fault Summary
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div id="faultChart"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Maintenance Schedule --}}
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-header p-3">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-regular fa-calendar-check me-2 text-primary"></i>
                                Maintenance Schedule
                            </h5>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-3">Machine</th>
                                            <th>Maintenance Type</th>
                                            <th>Engineer</th>
                                            <th>Scheduled Date</th>
                                            <th>Priority</th>
                                            <th>Status</th>
                                            <th class="pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-3">Motor-01</td>
                                            <td>Preventive</td>
                                            <td>John Smith</td>
                                            <td>02 Aug 2026</td>
                                            <td><span class="badge bg-danger">High</span></td>
                                            <td><span class="badge bg-warning text-dark">Scheduled</span></td>
                                            <td class="pe-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        onclick="showMaintenanceInfo('Motor-01', 'Preventive Maintenance', 'High')">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">Pump-02</td>
                                            <td>Inspection</td>
                                            <td>Alex</td>
                                            <td>04 Aug 2026</td>
                                            <td><span class="badge bg-info text-dark">Medium</span></td>
                                            <td><span class="badge bg-success">Planned</span></td>
                                            <td class="pe-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        onclick="showMaintenanceInfo('Pump-02', 'Inspection', 'Medium')">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">Fan-01</td>
                                            <td>Corrective</td>
                                            <td>David</td>
                                            <td>Today</td>
                                            <td><span class="badge bg-danger">Critical</span></td>
                                            <td><span class="badge bg-danger">In Progress</span></td>
                                            <td class="pe-3">
                                                <button type="button" class="btn btn-sm btn-outline-success"
                                                        onclick="showMaintenanceInfo('Fan-01', 'Corrective Maintenance', 'Critical')">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">Generator-01</td>
                                            <td>Oil Change</td>
                                            <td>Mike</td>
                                            <td>08 Aug 2026</td>
                                            <td><span class="badge bg-secondary">Low</span></td>
                                            <td><span class="badge bg-primary">Pending</span></td>
                                            <td class="pe-3">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        onclick="showMaintenanceInfo('Generator-01', 'Oil Change', 'Low')">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- AI Maintenance Recommendation --}}
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-header p-3">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-robot me-2 text-primary"></i>
                                AI Maintenance Recommendation
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-warning">
                                <div class="fw-bold mb-1">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                    Motor-01
                                </div>
                                Bearing wear detected. Replace bearing within <strong>5 days</strong>.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-3">
                                    <tbody>
                                        <tr>
                                            <th class="text-muted">Health Score</th>
                                            <td><span class="badge bg-success">92%</span></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Failure Risk</th>
                                            <td><span class="badge bg-danger">18%</span></td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Confidence</th>
                                            <td>98%</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Remaining Life</th>
                                            <td>120 Days</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('user.maintenance-tasks.create') }}" class="btn theme-btn">
                                <i class="fa-solid fa-screwdriver-wrench me-1"></i>
                                Schedule Maintenance
                            </a>
                        </div>
                    </div>

                    {{-- Recovery Logs --}}
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-header p-3">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>
                                Recovery Logs
                            </h5>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-3">Date</th>
                                            <th>Machine</th>
                                            <th>Fault</th>
                                            <th>Recovery Action</th>
                                            <th>Engineer</th>
                                            <th>Duration</th>
                                            <th class="pe-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-3">31 Jul 2026</td>
                                            <td>Motor-01</td>
                                            <td>Bearing Failure</td>
                                            <td>Bearing Replaced</td>
                                            <td>John</td>
                                            <td>2h 15m</td>
                                            <td class="pe-3"><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">30 Jul 2026</td>
                                            <td>Pump-02</td>
                                            <td>Pressure Leakage</td>
                                            <td>Valve Changed</td>
                                            <td>Alex</td>
                                            <td>1h 20m</td>
                                            <td class="pe-3"><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">29 Jul 2026</td>
                                            <td>Generator-01</td>
                                            <td>Power Failure</td>
                                            <td>Power Reset</td>
                                            <td>David</td>
                                            <td>45 Min</td>
                                            <td class="pe-3"><span class="badge bg-primary">Verified</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Maintenance Tasks --}}
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-header p-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <i class="fa-solid fa-screwdriver-wrench me-2 text-primary"></i>
                                        Maintenance Tasks
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        Manage scheduled maintenance, assignments and task status.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            {{-- Filters --}}
                            <form method="GET" action="{{ route('user.maintenance-tasks.index') }}" id="maintenanceFilterForm">
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label for="statusFilter" class="form-label fw-semibold">Status</label>
                                        <select class="form-select" name="status" id="statusFilter">
                                            <option value="">All Status</option>
                                            <option value="scheduled" {{ request('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="machineFilter" class="form-label fw-semibold">Machine</label>
                                        <select class="form-select" name="machine_id" id="machineFilter">
                                            <option value="">All Machines</option>
                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ (string) request('machine_id') === (string) $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="dateFilter" class="form-label fw-semibold">Scheduled Date</label>
                                        <input type="date"
                                               class="form-control"
                                               name="date"
                                               id="dateFilter"
                                               value="{{ request('date') }}">
                                    </div>

                                    <div class="col-12 d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn theme-btn">
                                            <i class="fa-solid fa-filter me-1"></i>
                                            Apply Filters
                                        </button>

                                        <a href="{{ route('user.maintenance-tasks.index') }}"
                                           class="btn btn-light border">
                                            <i class="fa-solid fa-rotate-left me-1"></i>
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>

                            {{-- Tasks Table --}}
                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="maintenanceTasksTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Machine</th>
                                            <th>Scheduled</th>
                                            <th>Status</th>
                                            <th>Assigned To</th>
                                            <th>Cost</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($tasks as $task)
                                            @php
                                                $statusClass = [
                                                    'scheduled' => 'primary',
                                                    'in_progress' => 'warning text-dark',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger',
                                                ][$task->status] ?? 'secondary';
                                            @endphp

                                            <tr class="maintenance-task-row">
                                                <td>{{ $task->id }}</td>

                                                <td>
                                                    {{ optional($task->machine)->name ?? '—' }}
                                                </td>

                                                <td>
                                                    @if ($task->scheduled_at)
                                                        {{ $task->scheduled_at->format('M d, Y H:i') }}
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $task->scheduled_at->diffForHumans() }}
                                                        </small>
                                                    @else
                                                        —
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="badge bg-{{ $statusClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if ($task->assigned_to)
                                                        {{ optional($task->assignedTo)->name ?? 'Assigned user' }}
                                                    @else
                                                        <span class="text-muted">Unassigned</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($task->cost_estimate !== null)
                                                        ${{ number_format((float) $task->cost_estimate, 2) }}
                                                    @else
                                                        —
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <div class="d-inline-flex flex-wrap justify-content-center gap-1">
                                                        <a href="{{ route('user.maintenance-tasks.show', $task) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="View Details"
                                                           aria-label="View task {{ $task->id }}">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('user.maintenance-tasks.edit', $task) }}"
                                                           class="btn btn-sm btn-outline-secondary"
                                                           title="Edit Task"
                                                           aria-label="Edit task {{ $task->id }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>

                                                        <form action="{{ route('user.maintenance-tasks.destroy', $task) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    title="Delete Task"
                                                                    aria-label="Delete task {{ $task->id }}">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr id="noMaintenanceTasks">
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="fa-solid fa-clipboard-check fs-3 d-block mb-2"></i>
                                                    No maintenance tasks found.
                                                </td>
                                            </tr>
                                        @endforelse

                                        <tr id="noSearchResults" class="d-none">
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No matching maintenance tasks found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $tasks->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

{{-- Fault Chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Search only the actual maintenance task listing.
    const searchInput = document.getElementById('maintenanceSearch');
    const taskRows = document.querySelectorAll('#maintenanceTasksTable .maintenance-task-row');
    const noSearchResults = document.getElementById('noSearchResults');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            taskRows.forEach(function (row) {
                const matches = row.textContent.toLowerCase().includes(searchTerm);
                row.classList.toggle('d-none', !matches);

                if (matches) {
                    visibleCount++;
                }
            });

            if (noSearchResults) {
                noSearchResults.classList.toggle(
                    'd-none',
                    visibleCount > 0 || taskRows.length === 0 || searchTerm === ''
                );
            }
        });
    }

    // Fault Summary chart
    const chartElement = document.getElementById('faultChart');

    if (chartElement && typeof Chart !== 'undefined') {
        new Chart(chartElement, {
            type: 'doughnut',
            data: {
                labels: ['Critical', 'High', 'Medium', 'Low'],
                datasets: [{
                    data: [2, 3, 4, 6],
                    backgroundColor: ['#dc3545', '#fd7e14', '#0dcaf0', '#198754'],
                    borderWidth: 0,
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 18
                        }
                    }
                }
            }
        });
    }
});

// Demo fault details: shows the selected row's information.
function showMaintenanceInfo(machine, fault, severity) {
    alert(
        'Machine: ' + machine +
        '\nFault / Task: ' + fault +
        '\nSeverity / Priority: ' + severity
    );
}
</script>

@include('user.include.footer')