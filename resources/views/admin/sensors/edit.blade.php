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
                                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>
                                Edit Sensor
                            </h4>
                            <p class="text-muted mb-0">
                                Update sensor details, machine assignment and device status.
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

                    {{-- Edit Sensor Form --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-microchip fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Sensor Information</h5>
                                    <p class="text-muted small mb-0">
                                        Modify the registered sensor information below.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <form method="POST"
                                  action="{{ route('admin.sensors.update', $sensor) }}">

                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Device ID --}}
                                    <div class="col-12 col-md-6">
                                        <label for="device_id" class="form-label fw-semibold">
                                            Device ID <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="device_id"
                                               name="device_id"
                                               class="form-control @error('device_id') is-invalid @enderror"
                                               value="{{ old('device_id', $sensor->device_id) }}"
                                               placeholder="Enter device ID"
                                               required>

                                        @error('device_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Sensor Type --}}
                                    <div class="col-12 col-md-6">
                                        <label for="sensor_type" class="form-label fw-semibold">
                                            Sensor Type <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="sensor_type"
                                               name="sensor_type"
                                               class="form-control @error('sensor_type') is-invalid @enderror"
                                               value="{{ old('sensor_type', $sensor->sensor_type) }}"
                                               placeholder="Enter sensor type"
                                               required>

                                        @error('sensor_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine --}}
                                    <div class="col-12 col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine
                                        </label>

                                        <select id="machine_id"
                                                name="machine_id"
                                                class="form-select @error('machine_id') is-invalid @enderror">

                                            <option value="">(Optional) Select Machine</option>

                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ (string) old('machine_id', $sensor->machine_id) === (string) $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('machine_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Firmware Version --}}
                                    <div class="col-12 col-md-6">
                                        <label for="firmware_version" class="form-label fw-semibold">
                                            Firmware Version
                                        </label>

                                        <input type="text"
                                               id="firmware_version"
                                               name="firmware_version"
                                               class="form-control @error('firmware_version') is-invalid @enderror"
                                               value="{{ old('firmware_version', $sensor->firmware_version) }}"
                                               placeholder="e.g. v1.0.0">

                                        @error('firmware_version')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Battery Level --}}
                                    <div class="col-12 col-md-6">
                                        <label for="battery_level" class="form-label fw-semibold">
                                            Battery Level (%)
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                   id="battery_level"
                                                   name="battery_level"
                                                   class="form-control @error('battery_level') is-invalid @enderror"
                                                   min="0"
                                                   max="100"
                                                   value="{{ old('battery_level', $sensor->battery_level) }}"
                                                   placeholder="0–100">

                                            <span class="input-group-text">%</span>

                                            @error('battery_level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Last Seen --}}
                                    <div class="col-12 col-md-6">
                                        <label for="last_seen" class="form-label fw-semibold">
                                            Last Seen
                                        </label>

                                        <input type="datetime-local"
                                               id="last_seen"
                                               name="last_seen"
                                               class="form-control @error('last_seen') is-invalid @enderror"
                                               value="{{ old('last_seen', optional($sensor->last_seen)->format('Y-m-d\TH:i')) }}">

                                        @error('last_seen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-12 col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select id="status"
                                                name="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>

                                            @foreach (['active', 'inactive', 'faulty', 'provisioning'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $sensor->status) === $status ? 'selected' : '' }}>
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
                                <hr class="my-4">

                                <div class="d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('admin.sensors.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-floppy-disk me-1"></i>
                                        Update Sensor
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
