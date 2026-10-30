@php
    $page_title = 'Maintenance Task Details';

    $statusClasses = [
        'scheduled'   => 'primary',
        'in_progress' => 'warning',
        'completed'   => 'success',
        'cancelled'   => 'danger',
    ];

    $statusClass = $statusClasses[$task->status] ?? 'secondary';

    $parts = is_array($task->parts_required)
        ? $task->parts_required
        : (json_decode($task->parts_required ?? '[]', true) ?? []);

    $partsTotal = array_sum(array_map(function ($part) {
        return (float) ($part['cost'] ?? 0) * (int) ($part['quantity'] ?? 0);
    }, $parts));
@endphp

@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>

            {{-- Main Content --}}
            <div class="col-md-10">
                <div class="page-content m-auto p-3 mt-5">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold mb-1">
                                Maintenance Task #{{ $task->id }}
                            </h3>
                            <p class="text-muted mb-0">
                                View task information, schedule, assigned technician and required parts.
                            </p>
                        </div>

                        <a href="{{ route('user.maintenance-tasks.edit', $task) }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-pen-to-square me-1"></i>
                            Edit Task
                        </a>
                    </div>

                    <div class="row g-3 mt-2">

                        {{-- Task Information --}}
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">Task Information</h5>
                                </div>

                                <div class="card-body p-0 mt-3">
                                    <div class="row g-4">

                                        {{-- Machine --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-solid fa-gears me-1 text-muted"></i>
                                                Machine
                                            </label>

                                            <p class="mb-1">
                                                @if ($task->machine)
                                                    <a href="{{ route('user.machines.show', $task->machine) }}"
                                                       class="text-decoration-none fw-semibold">
                                                        {{ $task->machine->name }}
                                                    </a>

                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $task->machine->machine_type }}
                                                    </small>
                                                @else
                                                    <span class="text-muted">Machine unavailable</span>
                                                @endif
                                            </p>
                                        </div>

                                        {{-- Created By --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-solid fa-user me-1 text-muted"></i>
                                                Created By
                                            </label>

                                            <p class="mb-0">
                                                {{ $task->createdBy->name ?? 'N/A' }}
                                            </p>
                                        </div>

                                        {{-- Assigned To --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-solid fa-user-gear me-1 text-muted"></i>
                                                Assigned To
                                            </label>

                                            <p class="mb-0">
                                                {{ $task->assignedTo->name ?? 'Unassigned' }}
                                            </p>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-solid fa-circle-check me-1 text-muted"></i>
                                                Status
                                            </label>

                                            <p class="mb-0">
                                                <span class="badge bg-{{ $statusClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </p>
                                        </div>

                                        {{-- Scheduled Date --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-regular fa-calendar me-1 text-muted"></i>
                                                Scheduled For
                                            </label>

                                            <p class="mb-1">
                                                {{ $task->scheduled_at?->format('M d, Y H:i') ?? 'N/A' }}
                                            </p>

                                            @if ($task->scheduled_at)
                                                <small class="text-muted">
                                                    {{ $task->scheduled_at->diffForHumans() }}
                                                </small>
                                            @endif
                                        </div>

                                        {{-- Completion Date --}}
                                        @if ($task->completed_at)
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="fa-regular fa-calendar-check me-1 text-muted"></i>
                                                    Completed On
                                                </label>

                                                <p class="mb-1">
                                                    {{ $task->completed_at->format('M d, Y H:i') }}
                                                </p>

                                                <small class="text-muted">
                                                    {{ $task->completed_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        @endif

                                        {{-- Notes --}}
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">
                                                <i class="fa-regular fa-note-sticky me-1 text-muted"></i>
                                                Notes
                                            </label>

                                            <div class="border rounded p-3">
                                                <p class="mb-0 text-break">
                                                    {{ $task->notes ?: 'No notes provided.' }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Cost and Parts --}}
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">Cost Details</h5>
                                </div>

                                <div class="card-body p-0 mt-3">

                                    <div class="border rounded p-3 mb-4">
                                        <div class="text-muted small mb-1">
                                            Estimated Cost
                                        </div>

                                        <h3 class="fw-bold mb-0">
                                            ${{ number_format((float) $task->cost_estimate, 2) }}
                                        </h3>
                                    </div>

                                    <h6 class="fw-bold mb-3">
                                        <i class="fa-solid fa-screwdriver-wrench me-1 text-muted"></i>
                                        Required Parts
                                    </h6>

                                    @if (count($parts))
                                        <div class="table-responsive">
                                            <table class="table table-sm align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Part</th>
                                                        <th>Qty</th>
                                                        <th class="text-end">Cost</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($parts as $part)
                                                        <tr>
                                                            <td>
                                                                {{ $part['name'] ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                {{ $part['quantity'] ?? 0 }}
                                                            </td>
                                                            <td class="text-end text-nowrap">
                                                                ${{ number_format((float) ($part['cost'] ?? 0), 2) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th colspan="2">Total Parts Cost</th>
                                                        <th class="text-end text-nowrap">
                                                            ${{ number_format($partsTotal, 2) }}
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @else
                                        <div class="border rounded p-3 text-center">
                                            <i class="fa-solid fa-box-open text-muted fs-4 mb-2"></i>
                                            <p class="text-muted mb-0">
                                                No parts specified.
                                            </p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        {{-- Task Actions --}}
                        <div class="col-12">
                            <div class="card border-0 shadow-none">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                        <a href="{{ route('user.maintenance-tasks.index') }}"
                                           class="btn btn-light border">
                                            <i class="fa-solid fa-arrow-left me-1"></i>
                                            Back to Maintenance
                                        </a>

                                        <div class="d-flex flex-wrap gap-2">

                                            {{-- Start Task --}}
                                            @if ($task->status === 'scheduled')
                                                <form action="{{ route('user.maintenance-tasks.update', $task) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="status" value="in_progress">

                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="fa-solid fa-play me-1"></i>
                                                        Start Task
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Complete Task --}}
                                            @if ($task->status === 'in_progress')
                                                <form action="{{ route('user.maintenance-tasks.update', $task) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="status" value="completed">
                                                    <input type="hidden" name="completed_at"
                                                           value="{{ now()->format('Y-m-d H:i:s') }}">

                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa-solid fa-check me-1"></i>
                                                        Mark Complete
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Cancel Task --}}
                                            @if (in_array($task->status, ['scheduled', 'in_progress']))
                                                <form action="{{ route('user.maintenance-tasks.update', $task) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to cancel this task?');">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="status" value="cancelled">

                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="fa-solid fa-xmark me-1"></i>
                                                        Cancel Task
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@include('user.include.footer')
