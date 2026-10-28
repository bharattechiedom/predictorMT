
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

                <div class="main-content">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm"
                             role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Maintenance Task Details Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <i class="fas fa-screwdriver-wrench text-primary me-2"></i>
                                        Maintenance Task Details
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        View maintenance task information, scheduling and assigned users.
                                    </p>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.maintenance-tasks.edit', $task) }}"
                                       class="btn theme-btn">
                                        <i class="fas fa-edit me-1"></i>
                                        Edit Task
                                    </a>

                                    <a href="{{ route('admin.maintenance-tasks.index') }}"
                                       class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Back
                                    </a>
                                </div>

                            </div>
                        </div>

                        {{-- Task Information --}}
                        <div class="card-body p-4 border-top">

                            {{-- Basic Information --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Basic Information
                            </h6>

                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle mb-0">

                                    <tbody>
                                        <tr>
                                            <th class="bg-light text-secondary" style="width:30%;">
                                                Task ID
                                            </th>
                                            <td>
                                                <span class="badge text-bg-light border">
                                                    #{{ $task->id }}
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Company</th>
                                            <td class="fw-semibold text-dark">
                                                <i class="fas fa-building text-primary me-2"></i>
                                                {{ optional($task->company)->name ?? 'N/A' }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Machine</th>
                                            <td>
                                                <i class="fas fa-cogs text-secondary me-2"></i>
                                                {{ optional($task->machine)->name ?? 'N/A' }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Created By</th>
                                            <td>
                                                <i class="fas fa-user text-secondary me-2"></i>
                                                {{ optional($task->createdBy)->name ?? $task->created_by ?? 'N/A' }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Assigned To</th>
                                            <td>
                                                <i class="fas fa-user-check text-secondary me-2"></i>
                                                {{ optional($task->assignedTo)->name ?? ($task->assigned_to ?: 'Unassigned') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Status</th>
                                            <td>
                                                @php
                                                    $taskStatus = strtolower(str_replace(['_', '-'], ' ', $task->status ?? 'pending'));

                                                    $statusClass = match($taskStatus) {
                                                        'completed', 'complete' => 'text-bg-success',
                                                        'pending' => 'text-bg-warning',
                                                        'in progress' => 'text-bg-primary',
                                                        'cancelled', 'canceled' => 'text-bg-danger',
                                                        'scheduled' => 'text-bg-info',
                                                        default => 'text-bg-secondary',
                                                    };
                                                @endphp

                                                <span class="badge {{ $statusClass }} px-3 py-2">
                                                    {{ ucfirst($task->status ?? 'Pending') }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>

                            {{-- Schedule Information --}}
                            <h6 class="fw-bold mb-3">
                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                Schedule Information
                            </h6>

                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light text-secondary" style="width:30%;">
                                                Scheduled At
                                            </th>
                                            <td>
                                                <i class="far fa-calendar-alt text-secondary me-2"></i>
                                                {{ optional($task->scheduled_at)->format('M d, Y') ?? 'N/A' }}

                                                @if($task->scheduled_at)
                                                    <span class="text-secondary ms-2">
                                                        <i class="far fa-clock me-1"></i>
                                                        {{ $task->scheduled_at->format('h:i A') }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-light text-secondary">Completed At</th>
                                            <td>
                                                <i class="far fa-calendar-check text-secondary me-2"></i>
                                                {{ optional($task->completed_at)->format('M d, Y') ?? 'N/A' }}

                                                @if($task->completed_at)
                                                    <span class="text-secondary ms-2">
                                                        <i class="far fa-clock me-1"></i>
                                                        {{ $task->completed_at->format('h:i A') }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Notes --}}
                            <h6 class="fw-bold mb-3">
                                <i class="far fa-sticky-note text-primary me-2"></i>
                                Notes
                            </h6>

                            <div class="border rounded-3 p-3 mb-4 bg-light">
                                @if(filled($task->notes))
                                    <div class="text-dark" style="white-space: pre-wrap;">{{ $task->notes }}</div>
                                @else
                                    <span class="text-secondary">No notes available.</span>
                                @endif
                            </div>

                            {{-- Parts Required --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-boxes-stacked text-primary me-2"></i>
                                Parts Required
                            </h6>

                            <div class="border rounded-3 p-3 mb-4 bg-light">
                                @if(filled($task->parts_required))
                                    <pre class="mb-0 text-dark" style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ is_array($task->parts_required) ? json_encode($task->parts_required, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $task->parts_required }}</pre>
                                @else
                                    <span class="text-secondary">No parts information available.</span>
                                @endif
                            </div>

                            {{-- Cost Estimate --}}
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                Cost Information
                            </h6>

                            <div class="border rounded-3 p-3">
                                <div class="text-secondary small mb-1">
                                    Cost Estimate
                                </div>

                                <h5 class="fw-bold text-dark mb-0">
                                    {{ $task->cost_estimate !== null ? number_format((float) $task->cost_estimate, 2) : 'N/A' }}
                                </h5>
                            </div>

                        </div>

                        {{-- Footer Actions --}}
                        <div class="card-footer bg-white border-0 p-4">
                            <div class="d-flex flex-wrap gap-2 justify-content-end">

                                <a href="{{ route('admin.maintenance-tasks.index') }}"
                                   class="btn btn-dark fs-14">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Tasks
                                </a>

                                <a href="{{ route('admin.maintenance-tasks.edit', $task) }}"
                                   class="btn theme-btn">
                                    <i class="fas fa-edit me-1"></i>
                                    Edit Task
                                </a>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
