
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

                    {{-- Maintenance Tasks Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <i class="fas fa-screwdriver-wrench text-primary me-2"></i>
                                        Maintenance Tasks
                                    </h5>
                                    <p class="text-secondary small mb-0">
                                        Manage scheduled maintenance tasks for your machines
                                    </p>
                                </div>
                                <div class="d-flex align-items-center col-5">
                                    <div class="input-group search-input-group me-3">
                                        <span class="input-group-text bg-white">
                                    <i class="fas fa-search text-secondary"></i>
                                </span>

                                <input type="text"
                                       id="taskSearch"
                                       class="form-control"
                                       placeholder="Search maintenance tasks...">
                                    </div>
                                     <a href="{{ route('admin.maintenance-tasks.create') }}"
                                   class="btn theme-btn btn-flex-none">
                                    <i class="fas fa-plus me-1"></i>
                                    Add Task
                                </a>
                                      

                                                       
                                </div>

                               

                            </div>
                        </div>

                       
                        {{-- Tasks Table --}}
                        <div class="table-responsive list_Table">
                            <table class="table table-hover align-middle mb-0"
                                   id="tasksTable">

                                <thead class="table-light">
                                    <tr class="text-secondary small text-uppercase">
                                        <th class="ps-4">ID</th>
                                        <th>Company</th>
                                        <th>Machine</th>
                                        <th>Scheduled</th>
                                        <th>Status</th>
                                        <th class="text-center pe-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($tasks as $task)
                                        <tr>
                                            {{-- Task ID --}}
                                            <td class="ps-4">
                                                <span class="badge text-bg-light border">
                                                    #{{ $task->id }}
                                                </span>
                                            </td>

                                            {{-- Company --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary fw-bold"
                                                          style="width:38px;height:38px;">
                                                        {{ strtoupper(substr(optional($task->company)->name ?? 'N', 0, 1)) }}
                                                    </span>

                                                    <span class="fw-semibold text-dark">
                                                        {{ optional($task->company)->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Machine --}}
                                            <td>
                                                <span class="text-dark">
                                                    <i class="fas fa-cogs text-secondary me-1"></i>
                                                    {{ optional($task->machine)->name ?? 'N/A' }}
                                                </span>
                                            </td>

                                            {{-- Scheduled Date --}}
                                            <td>
                                                <span class="text-dark small">
                                                    <i class="far fa-calendar-alt text-secondary me-1"></i>
                                                    {{ optional($task->scheduled_at)->format('M d, Y') ?? 'N/A' }}
                                                </span>

                                                @if($task->scheduled_at)
                                                    <div class="text-secondary small mt-1">
                                                        <i class="far fa-clock me-1"></i>
                                                        {{ $task->scheduled_at->format('h:i A') }}
                                                    </div>
                                                @endif
                                            </td>

                                            {{-- Status --}}
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

                                                <span class="badge {{ $statusClass }}">
                                                    {{ ucfirst($task->status ?? 'Pending') }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="text-center pe-4">
                                                <div class="d-inline-flex gap-1 td_action">

                                                    <a href="{{ route('admin.maintenance-tasks.show', $task) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.maintenance-tasks.edit', $task) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.maintenance-tasks.destroy', $task) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Delete this task?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="fas fa-screwdriver-wrench fa-3x text-secondary mb-3"></i>

                                                <h6 class="fw-bold">No Maintenance Tasks Found</h6>

                                                <p class="text-secondary small mb-3">
                                                    Add your first maintenance task to get started.
                                                </p>

                                                <a href="{{ route('admin.maintenance-tasks.create') }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i>
                                                    Create Task
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse

                                    {{-- Search Empty State --}}
                                    <tr id="noTaskSearchResults" class="d-none">
                                        <td colspan="6"
                                            class="text-center text-secondary py-4">
                                            <i class="fas fa-search me-2"></i>
                                            No matching maintenance tasks found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($tasks->hasPages() || $tasks->count())
                            <div class="card-footer bg-white border-0 p-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                                    <small class="text-secondary">
                                        Showing {{ $tasks->firstItem() ?? 0 }}
                                        to {{ $tasks->lastItem() ?? 0 }}
                                        of {{ $tasks->total() }} tasks
                                    </small>

                                    {{ $tasks->links() }}

                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

{{-- Live Search --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('taskSearch');
    const table = document.getElementById('tasksTable');

    if (!search || !table) return;

    const rows = [...table.querySelectorAll('tbody tr')]
        .filter(row => row.id !== 'noTaskSearchResults');

    const noResults = document.getElementById('noTaskSearchResults');

    search.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        let count = 0;

        rows.forEach(row => {
            const match = row.textContent.toLowerCase().includes(query);

            row.classList.toggle('d-none', !match);

            if (match) count++;
        });

        noResults?.classList.toggle('d-none', !query || count > 0);
    });
});
</script>

@include('admin.include.footer')
