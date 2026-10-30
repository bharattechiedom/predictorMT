@php
    $page_title = 'Edit Maintenance Task';

    $parts = old('parts', json_decode($task->parts_required, true) ?? []);

    if (empty($parts)) {
        $parts = [
            ['name' => '', 'quantity' => '', 'cost' => '']
        ];
    }

    $partIndex = count($parts);
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
                            <h3 class="fw-bold mb-1">Edit Maintenance Task #{{ $task->id }}</h3>
                            <p class="text-muted mb-0">
                                Update task details, schedule, assigned technician and required parts.
                            </p>
                        </div>

                        <a href="{{ route('user.maintenance-tasks.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Back to Maintenance
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Edit Task Form --}}
                    <div class="card border-0 shadow-none mt-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-0">Maintenance Task Details</h5>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <form action="{{ route('user.maintenance-tasks.update', $task) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Machine --}}
                                    <div class="col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine <span class="text-danger">*</span>
                                        </label>

                                        <select name="machine_id"
                                                id="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Machine</option>

                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ old('machine_id', $task->machine_id) == $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }} ({{ $machine->machine_type }})
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Assigned Technician --}}
                                    <div class="col-md-6">
                                        <label for="assigned_to" class="form-label fw-semibold">
                                            Assign To
                                        </label>

                                        <select name="assigned_to"
                                                id="assigned_to"
                                                class="form-select @error('assigned_to') is-invalid @enderror">
                                            <option value="">Select Technician</option>

                                            @foreach ($technicians as $tech)
                                                <option value="{{ $tech->id }}"
                                                    {{ old('assigned_to', $task->assigned_to) == $tech->id ? 'selected' : '' }}>
                                                    {{ $tech->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('assigned_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Schedule Date --}}
                                    <div class="col-md-6">
                                        <label for="scheduled_at" class="form-label fw-semibold">
                                            Schedule Date <span class="text-danger">*</span>
                                        </label>

                                        <input type="datetime-local"
                                               name="scheduled_at"
                                               id="scheduled_at"
                                               class="form-control @error('scheduled_at') is-invalid @enderror"
                                               value="{{ old('scheduled_at', $task->scheduled_at ? $task->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                                               required>

                                        @error('scheduled_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status
                                        </label>

                                        <select name="status"
                                                id="status"
                                                class="form-select @error('status') is-invalid @enderror">
                                            <option value="scheduled"
                                                {{ old('status', $task->status) == 'scheduled' ? 'selected' : '' }}>
                                                Scheduled
                                            </option>

                                            <option value="in_progress"
                                                {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                                                In Progress
                                            </option>

                                            <option value="completed"
                                                {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                            <option value="cancelled"
                                                {{ old('status', $task->status) == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Completion Date --}}
                                    <div class="col-md-6" id="completedAtWrapper">
                                        <label for="completed_at" class="form-label fw-semibold">
                                            Completion Date
                                        </label>

                                        <input type="datetime-local"
                                               name="completed_at"
                                               id="completed_at"
                                               class="form-control @error('completed_at') is-invalid @enderror"
                                               value="{{ old('completed_at', $task->completed_at ? $task->completed_at->format('Y-m-d\TH:i') : '') }}">

                                        @error('completed_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Cost Estimate --}}
                                    <div class="col-md-6">
                                        <label for="cost_estimate" class="form-label fw-semibold">
                                            Cost Estimate ($)
                                        </label>

                                        <input type="number"
                                               name="cost_estimate"
                                               id="cost_estimate"
                                               class="form-control @error('cost_estimate') is-invalid @enderror"
                                               value="{{ old('cost_estimate', $task->cost_estimate) }}"
                                               step="0.01"
                                               min="0">

                                        @error('cost_estimate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Notes --}}
                                    <div class="col-12">
                                        <label for="notes" class="form-label fw-semibold">
                                            Notes
                                        </label>

                                        <textarea name="notes"
                                                  id="notes"
                                                  rows="4"
                                                  class="form-control @error('notes') is-invalid @enderror"
                                                  placeholder="Enter maintenance notes...">{{ old('notes', $task->notes) }}</textarea>

                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Parts Required --}}
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                            <label class="form-label fw-semibold mb-0">
                                                Parts Required
                                            </label>

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary"
                                                    id="addPart">
                                                <i class="fa-solid fa-plus me-1"></i>
                                                Add Part
                                            </button>
                                        </div>

                                        <div id="partsContainer">
                                            @foreach ($parts as $index => $part)
                                                <div class="row g-2 mb-2 part-row">
                                                    <div class="col-12 col-md-5">
                                                        <input type="text"
                                                               name="parts[{{ $index }}][name]"
                                                               class="form-control"
                                                               placeholder="Part Name"
                                                               value="{{ $part['name'] ?? '' }}">
                                                    </div>

                                                    <div class="col-5 col-md-3">
                                                        <input type="number"
                                                               name="parts[{{ $index }}][quantity]"
                                                               class="form-control"
                                                               placeholder="Quantity"
                                                               min="1"
                                                               value="{{ $part['quantity'] ?? '' }}">
                                                    </div>

                                                    <div class="col-5 col-md-3">
                                                        <input type="number"
                                                               name="parts[{{ $index }}][cost]"
                                                               class="form-control"
                                                               placeholder="Cost"
                                                               step="0.01"
                                                               min="0"
                                                               value="{{ $part['cost'] ?? '' }}">
                                                    </div>

                                                    <div class="col-2 col-md-1">
                                                        <button type="button"
                                                                class="btn btn-outline-danger remove-part w-100"
                                                                aria-label="Remove part"
                                                                {{ count($parts) === 1 ? 'disabled' : '' }}>
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Form Actions --}}
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3 border-top">
                                            <a href="{{ route('user.maintenance-tasks.index') }}"
                                               class="btn btn-light border">
                                                Cancel
                                            </a>

                                            <button type="submit" class="btn theme-btn">
                                                <i class="fa-solid fa-floppy-disk me-1"></i>
                                                Update Task
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('partsContainer');
    const addButton = document.getElementById('addPart');
    const statusSelect = document.getElementById('status');
    const completedAtInput = document.getElementById('completed_at');
    const completedAtWrapper = document.getElementById('completedAtWrapper');

    let partIndex = {{ $partIndex }};

    // Add a new part row
    addButton.addEventListener('click', function () {
        const newRow = document.createElement('div');

        newRow.className = 'row g-2 mb-2 part-row';

        newRow.innerHTML = `
            <div class="col-12 col-md-5">
                <input type="text"
                       class="form-control"
                       name="parts[${partIndex}][name]"
                       placeholder="Part Name">
            </div>

            <div class="col-5 col-md-3">
                <input type="number"
                       class="form-control"
                       name="parts[${partIndex}][quantity]"
                       placeholder="Quantity"
                       min="1">
            </div>

            <div class="col-5 col-md-3">
                <input type="number"
                       class="form-control"
                       name="parts[${partIndex}][cost]"
                       placeholder="Cost"
                       step="0.01"
                       min="0">
            </div>

            <div class="col-2 col-md-1">
                <button type="button"
                        class="btn btn-outline-danger remove-part w-100"
                        aria-label="Remove part">
                    <i class="fa-solid fa-minus"></i>
                </button>
            </div>
        `;

        container.appendChild(newRow);
        partIndex++;

        updateRemoveButtons();
    });

    // Remove a part row
    container.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.remove-part');

        if (!removeButton) {
            return;
        }

        const rows = container.querySelectorAll('.part-row');

        if (rows.length > 1) {
            removeButton.closest('.part-row').remove();
        }

        updateRemoveButtons();
    });

    // Keep at least one part row
    function updateRemoveButtons() {
        const rows = container.querySelectorAll('.part-row');

        rows.forEach(function (row) {
            const button = row.querySelector('.remove-part');

            if (button) {
                button.disabled = rows.length === 1;
            }
        });
    }

    // Show completion date only when status is completed
    function toggleCompletionDate() {
        const isCompleted = statusSelect.value === 'completed';

        completedAtWrapper.style.display = isCompleted ? '' : 'none';
        completedAtInput.required = isCompleted;
    }

    statusSelect.addEventListener('change', toggleCompletionDate);

    toggleCompletionDate();
    updateRemoveButtons();
});
</script>
@endpush

@include('user.include.footer')