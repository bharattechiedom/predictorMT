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
                                Add Sensor Reading
                            </h4>
                            <p class="text-muted mb-0">
                                Record a sensor measurement and its associated machine details.
                            </p>
                        </div>

                        <a href="{{ route('admin.sensor-readings.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Readings
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

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Reading Form --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-wave-square fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Reading Information</h5>
                                    <p class="text-muted small mb-0">
                                        Enter the sensor, machine, timestamp and measurement value.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <form method="POST"
                                  action="{{ route('admin.sensor-readings.store') }}">
                                @csrf

                                <div class="row g-3">

                                    {{-- Sensor --}}
                                    <div class="col-12 col-md-6">
                                        <label for="sensor_id" class="form-label fw-semibold">
                                            Sensor <span class="text-danger">*</span>
                                        </label>

                                        <select id="sensor_id"
                                                name="sensor_id"
                                                class="form-select @error('sensor_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Sensor</option>

                                            @foreach ($sensors as $sensor)
                                                <option value="{{ $sensor->id }}"
                                                    {{ (string) old('sensor_id') === (string) $sensor->id ? 'selected' : '' }}>
                                                    {{ $sensor->device_id }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('sensor_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine --}}
                                    <div class="col-12 col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine <span class="text-danger">*</span>
                                        </label>

                                        <select id="machine_id"
                                                name="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Machine</option>

                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ (string) old('machine_id') === (string) $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Timestamp --}}
                                    <div class="col-12 col-md-6">
                                        <label for="timestamp" class="form-label fw-semibold">
                                            Timestamp <span class="text-danger">*</span>
                                        </label>

                                        <input type="datetime-local"
                                               id="timestamp"
                                               name="timestamp"
                                               class="form-control @error('timestamp') is-invalid @enderror"
                                               value="{{ old('timestamp') }}"
                                               required>

                                        @error('timestamp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Value --}}
                                    <div class="col-12 col-md-6">
                                        <label for="value_float" class="form-label fw-semibold">
                                            Value (Float)
                                        </label>

                                        <input type="number"
                                               step="any"
                                               id="value_float"
                                               name="value_float"
                                               class="form-control @error('value_float') is-invalid @enderror"
                                               value="{{ old('value_float') }}"
                                               placeholder="Enter measurement value">

                                        @error('value_float')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="form-text">
                                            Decimal values are supported.
                                        </div>
                                    </div>

                                    {{-- Payload --}}
                                    <div class="col-12">
                                        <label for="payload" class="form-label fw-semibold">
                                            Payload (JSON)
                                        </label>

                                        <textarea id="payload"
                                                  name="payload"
                                                  class="form-control font-monospace @error('payload') is-invalid @enderror"
                                                  rows="5"
                                                  placeholder='{"key":"value"}'>{{ old('payload') }}</textarea>

                                        @error('payload')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="form-text">
                                            Optional: Enter additional reading data in JSON format.
                                        </div>
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <hr class="my-4">

                                <div class="d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('admin.sensor-readings.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-floppy-disk me-1"></i>
                                        Create Reading
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

@include('admin.include.footer')