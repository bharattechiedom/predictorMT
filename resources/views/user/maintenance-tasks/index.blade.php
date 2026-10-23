<?php

$page_title = "Maintenance";

?>

 @include('user.include.header')



<body>

  <div class="wrapper active">

    <div class="page-content">

        <div class="page-container p-3">

            <div class="card bg-white">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>

                       <h3 class="mb-1">Fault & Maintenance</h3>
            <p class="text-muted mb-0">
                Monitor machine faults, maintenance schedules and recovery activities.
            </p>

                        

                    </div>

                    <div class="d-flex gap-2">

                        <div class="search-box position-relative w-auto">

                            <input type="text" class="form-control pe-5" id="maintenanceSearch" placeholder="Search Maintenance...">

                            <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="color: #ccc;">

                                <i class="bi bi-search"></i>

                            </span>

                        </div>

                        <a href="{{ route('user.maintenance-tasks.create') }}" class="btn btn-primary">

                            <i class="fa-solid fa-plus"></i> New Task

                        </a>

                    </div>

                </div>




                <div class="container-fluid mt-4">

    <!-- Page Heading -->


    <!-- KPI Cards -->

    <div class="row g-3 mb-4">

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-danger bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">Active Faults</small>

                            <h3 class="fw-bold text-danger">08</h3>

                        </div>

                        <i class="fas fa-triangle-exclamation fa-2x text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-warning bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">Critical</small>

                            <h3 class="fw-bold text-warning">02</h3>

                        </div>

                        <i class="fas fa-radiation fa-2x text-warning"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-primary bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">Scheduled</small>

                            <h3 class="fw-bold text-primary">05</h3>

                        </div>

                        <i class="fas fa-calendar-check fa-2x text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-success bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">Resolved</small>

                            <h3 class="fw-bold text-success">12</h3>

                        </div>

                        <i class="fas fa-circle-check fa-2x text-success"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-info bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">MTTR</small>

                            <h3 class="fw-bold text-info">2.5h</h3>

                        </div>

                        <i class="fas fa-stopwatch fa-2x text-info"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0 bg-success bg-opacity-10">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">Health</small>

                            <h3 class="fw-bold text-success">96%</h3>

                        </div>

                        <i class="fas fa-heart-pulse fa-2x text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="row">

        <!-- Active Fault Table -->

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-list me-2"></i>

                        Active Faults

                    </h5>

                </div>

                <div class="card-body p-0 bg-white">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Machine</th>

                                    <th>Fault</th>

                                    <th>Severity</th>

                                    <th>Started</th>

                                    <th>Status</th>

                                    <th>Engineer</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>Motor-01</td>

                                    <td>Bearing Failure</td>

                                    <td><span class="badge bg-danger">Critical</span></td>

                                    <td>10:20 AM</td>

                                    <td><span class="badge bg-danger">Active</span></td>

                                    <td>John</td>

                                    <td>

                                        <button class="btn btn-sm btn-outline-primary">

                                            View

                                        </button>

                                    </td>

                                </tr>

                                <tr>

                                    <td>Pump-01</td>

                                    <td>Pressure Leakage</td>

                                    <td><span class="badge bg-warning text-dark">High</span></td>

                                    <td>09:45 AM</td>

                                    <td><span class="badge bg-warning text-dark">Monitoring</span></td>

                                    <td>Alex</td>

                                    <td>

                                        <button class="btn btn-sm btn-outline-primary">

                                            View

                                        </button>

                                    </td>

                                </tr>

                                <tr>

                                    <td>Fan-01</td>

                                    <td>High Vibration</td>

                                    <td><span class="badge bg-info">Medium</span></td>

                                    <td>08:30 AM</td>

                                    <td><span class="badge bg-info">Pending</span></td>

                                    <td>Mike</td>

                                    <td>

                                        <button class="btn btn-sm btn-outline-primary">

                                            View

                                        </button>

                                    </td>

                                </tr>

                                <tr>

                                    <td>Generator-01</td>

                                    <td>Motor Overheating</td>

                                    <td><span class="badge bg-danger">Critical</span></td>

                                    <td>11:05 AM</td>

                                    <td><span class="badge bg-danger">Active</span></td>

                                    <td>David</td>

                                    <td>

                                        <button class="btn btn-sm btn-outline-primary">

                                            Resolve

                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0 mt-3">

            <div class="card-header">
                <h5 class="mb-0 text-white">
                    <i class="fas fa-calendar-check me-2"></i>
                    Maintenance Schedule
                </h5>
            </div>

            <div class="card-body p-0 bg-white">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>Machine</th>
                                <th>Maintenance Type</th>
                                <th>Engineer</th>
                                <th>Scheduled Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>Motor-01</td>

                                <td>Preventive</td>

                                <td>John Smith</td>

                                <td>02 Aug 2026</td>

                                <td>
                                    <span class="badge bg-danger">
                                        High
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        Scheduled
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        View
                                    </button>
                                </td>

                            </tr>

                            <tr>

                                <td>Pump-02</td>

                                <td>Inspection</td>

                                <td>Alex</td>

                                <td>04 Aug 2026</td>

                                <td>
                                    <span class="badge bg-info">
                                        Medium
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        Planned
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        View
                                    </button>
                                </td>

                            </tr>

                            <tr>

                                <td>Fan-01</td>

                                <td>Corrective</td>

                                <td>David</td>

                                <td>Today</td>

                                <td>
                                    <span class="badge bg-danger">
                                        Critical
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        In Progress
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-success">
                                        Start
                                    </button>
                                </td>

                            </tr>

                            <tr>

                                <td>Generator-01</td>

                                <td>Oil Change</td>

                                <td>Mike</td>

                                <td>08 Aug 2026</td>

                                <td>
                                    <span class="badge bg-secondary">
                                        Low
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        Pending
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
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



        <!-- Right Side -->

        <div class="col-lg-4">

            <!-- Fault Summary -->

            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-chart-pie me-2"></i>

                        Fault Summary

                    </h5>

                </div>

                <div class="card-body bg-white">

                    <canvas id="faultChart" height="220"></canvas>

                </div>

            </div>



            <!-- Critical Alerts -->

             <div class="card shadow-sm border-0 mb-4">

            <div class="card-header">

                <h5 class="mb-0 text-white">

                    <i class="fas fa-robot me-2"></i>

                    AI Maintenance Recommendation

                </h5>

            </div>

            <div class="card-body bg-white">

                <div class="alert alert-warning">

                    <strong>Motor-01</strong>

                    <br>

                    Bearing wear detected.

                    Replace bearing within

                    <strong>5 Days</strong>

                </div>

                <table class="table table-borderless mb-0">

                    <tr>

                        <th>Health Score</th>

                        <td>

                            <span class="badge bg-success">

                                92%

                            </span>

                        </td>

                    </tr>

                    <tr>

                        <th>Failure Risk</th>

                        <td>

                            <span class="badge bg-danger">

                                18%

                            </span>

                        </td>

                    </tr>

                    <tr>

                        <th>Confidence</th>

                        <td>98%</td>

                    </tr>

                    <tr>

                        <th>Remaining Life</th>

                        <td>120 Days</td>

                    </tr>

                </table>

                <hr>

                <button class="btn btn-primary w-100">

                    <i class="fas fa-screwdriver-wrench me-2"></i>

                    Schedule Maintenance

                </button>

            </div>

        </div>

        </div>

    </div>

</div>













<div class="row mt-4">

    <!-- Maintenance Schedule -->
    <div class="col-lg-8">

        

    </div>





</div>



<!-- Recovery Logs -->

<div class="row mt-4">

    <div class="col-lg-12">

        <div class="card shadow-sm border-0">

            <div class="card-header">

                <h5 class="mb-0 text-white">

                    <i class="fas fa-history me-2"></i>

                    Recovery Logs

                </h5>

            </div>

            <div class="card-body p-0 bg-white">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>Date</th>

                                <th>Machine</th>

                                <th>Fault</th>

                                <th>Recovery Action</th>

                                <th>Engineer</th>

                                <th>Duration</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>31 Jul 2026</td>

                                <td>Motor-01</td>

                                <td>Bearing Failure</td>

                                <td>Bearing Replaced</td>

                                <td>John</td>

                                <td>2h 15m</td>

                                <td>
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>30 Jul 2026</td>

                                <td>Pump-02</td>

                                <td>Pressure Leakage</td>

                                <td>Valve Changed</td>

                                <td>Alex</td>

                                <td>1h 20m</td>

                                <td>
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>29 Jul 2026</td>

                                <td>Generator-01</td>

                                <td>Power Failure</td>

                                <td>Power Reset</td>

                                <td>David</td>

                                <td>45 Min</td>

                                <td>
                                    <span class="badge bg-primary">
                                        Verified
                                    </span>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
                <div class="card-body">

                    @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">

                        {{ session('success') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif



                    <!-- Filters -->

                    <div class="row g-3 mb-4">

                        <div class="col-md-3">

                            <select class="form-select" id="statusFilter">

                                <option value="">All Status</option>

                                <option value="scheduled">Scheduled</option>

                                <option value="in_progress">In Progress</option>

                                <option value="completed">Completed</option>

                                <option value="cancelled">Cancelled</option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <select class="form-select" id="machineFilter">

                                <option value="">All Machines</option>

                                @foreach($machines as $machine)

                                <option value="{{ $machine->id }}">{{ $machine->name }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <input type="date" class="form-control" id="dateFilter">

                        </div>

                    </div>



                    <!-- Tasks Table -->

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Machine</th>

                                    <th>Scheduled</th>

                                    <th>Status</th>

                                    <th>Assigned To</th>

                                    <th>Cost</th>

                                    <th class="text-center" width="100">Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($tasks as $task)

                                <tr>

                                    <td>{{ $task->id }}</td>

                                    <td>{{ $task->machine->name }}</td>

                                    <td>

                                        {{ $task->scheduled_at->format('M d, Y H:i') }}

                                        <br>

                                        <small class="text-muted">

                                            ({{ $task->scheduled_at->diffForHumans() }})

                                        </small>

                                    </td>

                                    <td>

                                        @php

                                            $statusClass = [

                                                'scheduled' => 'primary',

                                                'in_progress' => 'warning',

                                                'completed' => 'success',

                                                'cancelled' => 'danger'

                                            ][$task->status];

                                        @endphp

                                        <span class="badge bg-{{ $statusClass }}">

                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}

                                        </span>

                                    </td>

                                    <td>

                                        @if($task->assigned_to)

                                            {{ $task->assignedTo->name }}

                                        @else

                                            <span class="text-muted">Unassigned</span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($task->cost_estimate)

                                            ${{ number_format($task->cost_estimate, 2) }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="btn-group gap-1 table-td-Btn">

                                            <a href="{{ route('user.maintenance-tasks.show', $task) }}" 

                                               class="btn btn-sm btn-outline-info"

                                               title="View Details">

                                                <i class="bi bi-eye"></i>

                                            </a>

                                            <a href="{{ route('user.maintenance-tasks.edit', $task) }}" 

                                               class="btn btn-sm btn-outline-info  "

                                               title="Edit Task">

                                                <i class="bi bi-pencil"></i>

                                            </a>

                                            <form action="{{ route('user.maintenance-tasks.destroy', $task) }}" 

                                                  method="POST" 

                                                  onsubmit="return confirm('Are you sure you want to delete this task?');"

                                                  style="display: inline;">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" 

                                                        class="btn btn-sm btn-outline-info"

                                                        title="Delete Task">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="7" class="text-center">No maintenance tasks found</td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>



                    <div class="mt-3">

                        {{ $tasks->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script>
(function() {
    'use strict';
    
    const searchInput = document.getElementById('maintenanceSearch');
    const table = document.querySelector('.table tbody');
    
    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tr');
            let visibleCount = 0;
            
            rows.forEach(function(row) {
                // Skip empty state row
                if (row.querySelector('td[colspan]')) {
                    return;
                }
                
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Handle filter changes
    const statusFilter = document.getElementById('statusFilter');
    const machineFilter = document.getElementById('machineFilter');
    const dateFilter = document.getElementById('dateFilter');
    
    function applyFilters() {
        const status = statusFilter.value;
        const machine = machineFilter.value;
        const date = dateFilter.value;
        
        const url = new URL(window.location.href);
        url.searchParams.set('status', status);
        url.searchParams.set('machine_id', machine);
        url.searchParams.set('date', date);
        
        window.location.href = url.toString();
    }
    
    if (statusFilter) statusFilter.addEventListener('change', applyFilters);
    if (machineFilter) machineFilter.addEventListener('change', applyFilters);
    if (dateFilter) dateFilter.addEventListener('change', applyFilters);
})();
</script>



        </div> <!-- /row -->

      </div> <!-- /page-container -->

    </div> <!-- /page-content -->

  </div> <!-- /wrapper -->



 

</body>



@include('user.include.footer')


<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('faultChart');

    if (ctx) {

        new Chart(ctx, {

            type: 'doughnut',

            data: {

                labels: [
                    'Critical',
                    'High',
                    'Medium',
                    'Low'
                ],

                datasets: [{

                    data: [2, 3, 4, 6],

                    backgroundColor: [
                        '#dc3545',
                        '#fd7e14',
                        '#0dcaf0',
                        '#198754'
                    ],

                    borderWidth: 0

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        });

    }

});

</script>