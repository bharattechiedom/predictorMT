@php
    $page_title = 'Create Maintenance Task';
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
                            <h3 class="fw-bold mb-1">Create Maintenance Task</h3>
                            <p class="text-muted mb-0">
                                Schedule maintenance, assign a technician and add the required parts.
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
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Create Maintenance Form --}}
                    <div class="card border-0 shadow-none mt-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-screwdriver-wrench me-2 text-primary"></i>
                                Maintenance Details
                            </h5>

                            <p class="text-muted small mb-0">
                                Fields marked with <span class="text-danger">*</span> are required.
                            </p>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('user.maintenance-tasks.store') }}" method="POST">
                                @csrf

                                <div class="row g-3">

                                    {{-- Machine --}}
                                    <div class="col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-select @error('machine_id') is-invalid @enderror"
                                                id="machine_id"
                                                name="machine_id"
                                                required>
                                            <option value="">Select Machine</option>

                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }} ({{ $machine->machine_type }})
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Technician --}}
                                    <div class="col-md-6">
                                        <label for="assigned_to" class="form-label fw-semibold">
                                            Assign To
                                        </label>

                                        <select class="form-select @error('assigned_to') is-invalid @enderror"
                                                id="assigned_to"
                                                name="assigned_to">
                                            <option value="">Select Technician</option>

                                            @foreach ($technicians as $tech)
                                                <option value="{{ $tech->id }}"
                                                    {{ old('assigned_to') == $tech->id ? 'selected' : '' }}>
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
                                               class="form-control @error('scheduled_at') is-invalid @enderror"
                                               id="scheduled_at"
                                               name="scheduled_at"
                                               value="{{ old('scheduled_at') }}"
                                               required>

                                        @error('scheduled_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Cost Estimate --}}
                                    <div class="col-md-6">
                                        <label for="cost_estimate" class="form-label fw-semibold">
                                            Cost Estimate ($)
                                        </label>

                                        <input type="number"
                                               class="form-control @error('cost_estimate') is-invalid @enderror"
                                               id="cost_estimate"
                                               name="cost_estimate"
                                               value="{{ old('cost_estimate') }}"
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

                                        <textarea class="form-control @error('notes') is-invalid @enderror"
                                                  id="notes"
                                                  name="notes"
                                                  rows="4"
                                                  placeholder="Enter maintenance notes...">{{ old('notes') }}</textarea>

                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Parts Required --}}
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                            <div>
                                                <label class="form-label fw-semibold mb-1">
                                                    <i class="fa-solid fa-boxes-stacked me-1 text-primary"></i>
                                                    Parts Required
                                                </label>

                                                <p class="text-muted small mb-0">
                                                    Add the part name, quantity and estimated cost.
                                                </p>
                                            </div>

                                            <button type="button"
                                                    class="btn btn-outline-primary btn-sm"
                                                    id="addPart">
                                                <i class="fa-solid fa-plus me-1"></i>
                                                Add Part
                                            </button>
                                        </div>

                                        <div id="partsContainer">
                                            @php
                                                $oldParts = old('parts', [
                                                    ['name' => '', 'quantity' => '', 'cost' => '']
                                                ]);
                                            @endphp

                                            @foreach ($oldParts as $index => $part)
                                                <div class="row g-2 mb-2 part-row align-items-start">
                                                    <div class="col-md-5">
                                                        <label class="form-label small">Part Name</label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="parts[{{ $index }}][name]"
                                                               placeholder="Enter part name"
                                                               value="{{ $part['name'] ?? '' }}">
                                                    </div>

                                                    <div class="col-5 col-md-3">
                                                        <label class="form-label small">Quantity</label>
                                                        <input type="number"
                                                               class="form-control"
                                                               name="parts[{{ $index }}][quantity]"
                                                               placeholder="Qty"
                                                               min="1"
                                                               value="{{ $part['quantity'] ?? '' }}">
                                                    </div>

                                                    <div class="col-5 col-md-3">
                                                        <label class="form-label small">Cost ($)</label>
                                                        <input type="number"
                                                               class="form-control"
                                                               name="parts[{{ $index }}][cost]"
                                                               placeholder="Cost"
                                                               step="0.01"
                                                               min="0"
                                                               value="{{ $part['cost'] ?? '' }}">
                                                    </div>

                                                    <div class="col-2 col-md-1">
                                                        <label class="form-label small d-block">&nbsp;</label>
                                                        <button type="button"
                                                                class="btn btn-outline-danger remove-part w-100"
                                                                {{ count($oldParts) === 1 ? 'disabled' : '' }}
                                                                aria-label="Remove part">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3">
                                    <a href="{{ route('user.maintenance-tasks.index') }}"
                                       class="btn btn-light border">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-plus me-1"></i>
                                        Create Task
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('partsContainer');
    const addButton = document.getElementById('addPart');

    if (!container || !addButton) {
        return;
    }

    let partIndex = {{ count(old('parts', [['name' => '', 'quantity' => '', 'cost' => '']])) }};

    function updateRemoveButtons() {
        const rows = container.querySelectorAll('.part-row');

        rows.forEach(function (row) {
            const removeButton = row.querySelector('.remove-part');

            if (removeButton) {
                removeButton.disabled = rows.length === 1;
            }
        });
    }

    addButton.addEventListener('click', function () {
        const newRow = document.createElement('div');
        newRow.className = 'row g-2 mb-2 part-row align-items-start';

        newRow.innerHTML = `
            <div class="col-md-5">
                <label class="form-label small">Part Name</label>
                <input type="text"
                       class="form-control"
                       name="parts[${partIndex}][name]"
                       placeholder="Enter part name">
            </div>

            <div class="col-5 col-md-3">
                <label class="form-label small">Quantity</label>
                <input type="number"
                       class="form-control"
                       name="parts[${partIndex}][quantity]"
                       placeholder="Qty"
                       min="1">
            </div>

            <div class="col-5 col-md-3">
                <label class="form-label small">Cost ($)</label>
                <input type="number"
                       class="form-control"
                       name="parts[${partIndex}][cost]"
                       placeholder="Cost"
                       step="0.01"
                       min="0">
            </div>

            <div class="col-2 col-md-1">
                <label class="form-label small d-block">&nbsp;</label>
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

    container.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.remove-part');

        if (!removeButton || removeButton.disabled) {
            return;
        }

        const row = removeButton.closest('.part-row');

        if (row && container.querySelectorAll('.part-row').length > 1) {
            row.remove();
        }

        updateRemoveButtons();
    });

    updateRemoveButtons();
});
</script>

@include('user.include.footer')