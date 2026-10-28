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
                                <i class="fa-solid fa-tower-broadcast text-primary me-2"></i>
                                Add Sensor
                            </h4>
                            <p class="text-muted mb-0">
                                Register a new sensor and configure its device information.
                            </p>
                        </div>

                        <a href="{{ route('admin.sensors.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Sensors
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <strong>
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                Please fix the following errors:
                            </strong>

                            <ul class="mb-0 mt-2">
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

                    {{-- Add Sensor Form --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-microchip fs-4"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Sensor Information</h5>
                                    <p class="text-muted small mb-0">
                                        Enter the sensor details below.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <form method="POST"
                                  action="{{ route('admin.sensors.store') }}">
                                @csrf

                                <div class="row g-3">

                                    {{-- Device ID --}}
                                    <div class="col-md-6">
                                        <label for="device_id" class="form-label fw-semibold">
                                            Device ID <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="device_id"
                                               id="device_id"
                                               class="form-control @error('device_id') is-invalid @enderror"
                                               value="{{ old('device_id') }}"
                                               placeholder="Enter device ID"
                                               required>

                                        @error('device_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Sensor Type --}}
                                    <div class="col-md-6">
                                        <label for="sensor_type" class="form-label fw-semibold">
                                            Sensor Type <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="sensor_type"
                                               id="sensor_type"
                                               class="form-control @error('sensor_type') is-invalid @enderror"
                                               value="{{ old('sensor_type') }}"
                                               placeholder="Enter sensor type"
                                               required>

                                        @error('sensor_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine --}}
                                    <div class="col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine
                                        </label>

                                        <select name="machine_id"
                                                id="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror">
                                            <option value="">(Optional) Select Machine</option>

                                            @foreach ($machines as $machine)
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

                                    {{-- Firmware Version --}}
                                    <div class="col-md-6">
                                        <label for="firmware_version" class="form-label fw-semibold">
                                            Firmware Version
                                        </label>

                                        <input type="text"
                                               name="firmware_version"
                                               id="firmware_version"
                                               class="form-control @error('firmware_version') is-invalid @enderror"
                                               value="{{ old('firmware_version') }}"
                                               placeholder="Enter firmware version">

                                        @error('firmware_version')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Battery Level --}}
                                    <div class="col-md-6">
                                        <label for="battery_level" class="form-label fw-semibold">
                                            Battery Level (%)
                                        </label>

                                        <input type="number"
                                               name="battery_level"
                                               id="battery_level"
                                               class="form-control @error('battery_level') is-invalid @enderror"
                                               min="0"
                                               max="100"
                                               value="{{ old('battery_level') }}"
                                               placeholder="Enter battery level">

                                        @error('battery_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Last Seen --}}
                                    <div class="col-md-6">
                                        <label for="last_seen" class="form-label fw-semibold">
                                            Last Seen
                                        </label>

                                        <input type="datetime-local"
                                               name="last_seen"
                                               id="last_seen"
                                               class="form-control @error('last_seen') is-invalid @enderror"
                                               value="{{ old('last_seen') }}">

                                        @error('last_seen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select name="status"
                                                id="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            @foreach (['active', 'inactive', 'faulty', 'provisioning'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status') === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 border-top mt-4 pt-4">
                                    <a href="{{ route('admin.sensors.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-plus me-1"></i>
                                        Create Sensor
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
