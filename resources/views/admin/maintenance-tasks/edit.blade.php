
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

                <div class="main-content">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm"
                             role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Edit Maintenance Task Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <i class="fas fa-screwdriver-wrench text-primary me-2"></i>
                                        Edit Maintenance Task
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Update maintenance task details and scheduling information.
                                    </p>
                                </div>

                                <a href="{{ route('admin.maintenance-tasks.index') }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Tasks
                                </a>

                            </div>
                        </div>

                        {{-- Form --}}
                        <div class="card-body p-4 border-top">

                            <form method="POST"
                                  action="{{ route('admin.maintenance-tasks.update', $task) }}">

                                @csrf
                                @method('PUT')

                                <div class="row g-4">

                                    {{-- Company --}}
                                    <div class="col-12 col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company <span class="text-danger">*</span>
                                        </label>

                                        <select name="company_id"
                                                id="company_id"
                                                class="form-select @error('company_id') is-invalid @enderror"
                                                required>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id', $task->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine --}}
                                    <div class="col-12 col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine <span class="text-danger">*</span>
                                        </label>

                                        <select name="machine_id"
                                                id="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror"
                                                required>
                                            @foreach($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ old('machine_id', $task->machine_id) == $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Created By --}}
                                    <div class="col-12 col-md-6">
                                        <label for="created_by" class="form-label fw-semibold">
                                            Created By <span class="text-danger">*</span>
                                        </label>

                                        <select name="created_by"
                                                id="created_by"
                                                class="form-select @error('created_by') is-invalid @enderror"
                                                required>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('created_by', $task->created_by) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('created_by')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Assigned To --}}
                                    <div class="col-12 col-md-6">
                                        <label for="assigned_to" class="form-label fw-semibold">
                                            Assigned To
                                        </label>

                                        <select name="assigned_to"
                                                id="assigned_to"
                                                class="form-select @error('assigned_to') is-invalid @enderror">
                                            <option value=""
                                                {{ old('assigned_to', $task->assigned_to) == '' ? 'selected' : '' }}>
                                                Unassigned
                                            </option>

                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('assigned_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Scheduled At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="scheduled_at" class="form-label fw-semibold">
                                            <i class="far fa-calendar-alt text-secondary me-1"></i>
                                            Scheduled At
                                        </label>

                                        <input type="datetime-local"
                                               name="scheduled_at"
                                               id="scheduled_at"
                                               value="{{ old('scheduled_at', optional($task->scheduled_at)->format('Y-m-d\TH:i')) }}"
                                               class="form-control @error('scheduled_at') is-invalid @enderror">

                                        @error('scheduled_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Completed At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="completed_at" class="form-label fw-semibold">
                                            <i class="far fa-calendar-check text-secondary me-1"></i>
                                            Completed At
                                        </label>

                                        <input type="datetime-local"
                                               name="completed_at"
                                               id="completed_at"
                                               value="{{ old('completed_at', optional($task->completed_at)->format('Y-m-d\TH:i')) }}"
                                               class="form-control @error('completed_at') is-invalid @enderror">

                                        @error('completed_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-12 col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select name="status"
                                                id="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            @foreach(['scheduled', 'in_progress', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $task->status) === $status ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Cost Estimate --}}
                                    <div class="col-12 col-md-6">
                                        <label for="cost_estimate" class="form-label fw-semibold">
                                            Cost Estimate
                                        </label>

                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span>

                                            <input type="number"
                                                   step="0.01"
                                                   name="cost_estimate"
                                                   id="cost_estimate"
                                                   value="{{ old('cost_estimate', $task->cost_estimate) }}"
                                                   class="form-control @error('cost_estimate') is-invalid @enderror"
                                                   placeholder="Enter estimated cost">
                                        </div>

                                        @error('cost_estimate')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Notes --}}
                                    <div class="col-12">
                                        <label for="notes" class="form-label fw-semibold">
                                            <i class="far fa-sticky-note text-secondary me-1"></i>
                                            Notes
                                        </label>

                                        <textarea name="notes"
                                                  id="notes"
                                                  class="form-control @error('notes') is-invalid @enderror"
                                                  rows="3"
                                                  placeholder="Enter task details or additional notes...">{{ old('notes', $task->notes) }}</textarea>

                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Parts Required --}}
                                    <div class="col-12">
                                        <label for="parts_required" class="form-label fw-semibold">
                                            <i class="fas fa-boxes-stacked text-secondary me-1"></i>
                                            Parts Required (JSON)
                                        </label>

                                        <textarea name="parts_required"
                                                  id="parts_required"
                                                  class="form-control font-monospace @error('parts_required') is-invalid @enderror"
                                                  rows="3"
                                                  placeholder='[{"part":"bearing","qty":2}]'>{{ old('parts_required', is_array($task->parts_required) ? json_encode($task->parts_required) : $task->parts_required) }}</textarea>

                                        <div class="form-text">
                                            Enter the required parts in valid JSON format.
                                        </div>

                                        @error('parts_required')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap gap-2 border-top mt-4 pt-4">

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fas fa-save me-1"></i>
                                        Update Task
                                    </button>

                                    <a href="{{ route('admin.maintenance-tasks.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
