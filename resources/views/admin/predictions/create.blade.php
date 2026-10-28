@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">
                                <i class="fa-solid fa-chart-line text-primary me-2"></i>
                                Add Prediction
                            </h4>
                            <p class="text-muted mb-0">
                                Create a new machine failure prediction record.
                            </p>
                        </div>

                        <a href="{{ route('admin.predictions.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Predictions
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Prediction Form --}}
                    <form method="POST" action="{{ route('admin.predictions.store') }}">
                        @csrf

                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 p-3 p-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fa-solid fa-microchip fa-lg"></i>
                                    </div>

                                    <div>
                                        <h5 class="fw-bold mb-1">Machine & Sensor</h5>
                                        <p class="text-muted small mb-0">
                                            Select the machine and its associated sensor.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-3 p-md-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine <span class="text-danger">*</span>
                                        </label>

                                        <select name="machine_id" id="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Machine</option>

                                            @foreach($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="sensor_id" class="form-label fw-semibold">
                                            Sensor <span class="text-muted small">(Optional)</span>
                                        </label>

                                        <select name="sensor_id" id="sensor_id"
                                                class="form-select @error('sensor_id') is-invalid @enderror">
                                            <option value="">None</option>

                                            @foreach($sensors as $sensor)
                                                <option value="{{ $sensor->id }}"
                                                    {{ old('sensor_id') == $sensor->id ? 'selected' : '' }}>
                                                    {{ $sensor->device_id }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('sensor_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 p-3 p-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                                        <i class="fa-regular fa-clock fa-lg"></i>
                                    </div>

                                    <div>
                                        <h5 class="fw-bold mb-1">Prediction Details</h5>
                                        <p class="text-muted small mb-0">
                                            Enter prediction timestamps and failure probability.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-3 p-md-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="predicted_at" class="form-label fw-semibold">
                                            Predicted At <span class="text-danger">*</span>
                                        </label>

                                        <input type="datetime-local" name="predicted_at"
                                               id="predicted_at"
                                               class="form-control @error('predicted_at') is-invalid @enderror"
                                               value="{{ old('predicted_at') }}" required>

                                        @error('predicted_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="predicted_failure_at" class="form-label fw-semibold">
                                            Predicted Failure At
                                        </label>

                                        <input type="datetime-local" name="predicted_failure_at"
                                               id="predicted_failure_at"
                                               class="form-control @error('predicted_failure_at') is-invalid @enderror"
                                               value="{{ old('predicted_failure_at') }}">

                                        @error('predicted_failure_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="probability" class="form-label fw-semibold">
                                            Probability
                                        </label>

                                        <input type="number" step="0.0001" min="0" max="1"
                                               name="probability" id="probability"
                                               class="form-control @error('probability') is-invalid @enderror"
                                               value="{{ old('probability') }}"
                                               placeholder="e.g. 0.8500">

                                        <div class="form-text">Enter a value between 0 and 1.</div>

                                        @error('probability')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="component" class="form-label fw-semibold">
                                            Component
                                        </label>

                                        <input type="text" name="component" id="component"
                                               class="form-control @error('component') is-invalid @enderror"
                                               value="{{ old('component') }}"
                                               placeholder="Enter component name">

                                        @error('component')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="model_version" class="form-label fw-semibold">
                                            Model Version <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="model_version" id="model_version"
                                               class="form-control @error('model_version') is-invalid @enderror"
                                               value="{{ old('model_version') }}"
                                               placeholder="e.g. v1.0.0" required>

                                        @error('model_version')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select name="status" id="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            @foreach(['open', 'acknowledged', 'converted', 'resolved'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', 'open') == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Explanation --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0 p-3 p-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                        <i class="fa-solid fa-code fa-lg"></i>
                                    </div>

                                    <div>
                                        <h5 class="fw-bold mb-1">Prediction Explanation</h5>
                                        <p class="text-muted small mb-0">
                                            Provide optional explanation data in JSON format.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-3 p-md-4">
                                <label for="explanation" class="form-label fw-semibold">
                                    Explanation (JSON)
                                </label>

                                <textarea name="explanation" id="explanation" rows="5"
                                          class="form-control font-monospace @error('explanation') is-invalid @enderror"
                                          placeholder='{"importance": {"vibration": 0.8}}'>{{ old('explanation') }}</textarea>

                                <div class="form-text">
                                    Example: {"importance": {"vibration": 0.8}}
                                </div>

                                @error('explanation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex flex-wrap justify-content-end gap-2 mb-4">
                            <a href="{{ route('admin.predictions.index') }}"
                               class="btn btn-dark fs-14">
                                <i class="fa-solid fa-xmark me-2"></i>
                                Cancel
                            </a>

                            <button type="submit" class="btn theme-btn">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                Create Prediction
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
