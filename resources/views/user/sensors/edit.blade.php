@php
    $page_title = 'Edit Sensor';
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
                            <h3 class="fw-bold mb-1">Edit Sensor</h3>
                            <p class="text-muted mb-0">
                                Update sensor details, machine assignment and device settings.
                            </p>
                        </div>

                        <a href="{{ route('user.sensors.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Back to Sensors
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
                                    aria-label="Close">
                            </button>
                        </div>
                    @endif

                    {{-- Sensor Form --}}
                    <div class="card border-0 shadow-none">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-microchip me-2 text-primary"></i>
                                Sensor Details
                            </h5>

                            <p class="text-muted small mb-0">
                                Fields marked with <span class="text-danger">*</span> are required.
                            </p>
                        </div>

                        <div class="card-body p-0">
                            <form method="POST" action="{{ route('user.sensors.update', $sensor) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Device ID --}}
                                    <div class="col-md-6">
                                        <label for="device_id" class="form-label fw-semibold">
                                            Device ID <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="device_id"
                                               id="device_id"
                                               class="form-control"
                                               value="{{ old('device_id', $sensor->device_id) }}"
                                               placeholder="Enter device ID"
                                               required>
                                    </div>

                                    {{-- Sensor Type --}}
                                    <div class="col-md-6">
                                        <label for="sensor_type" class="form-label fw-semibold">
                                            Sensor Type <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="sensor_type"
                                               id="sensor_type"
                                               class="form-control"
                                               value="{{ old('sensor_type', $sensor->sensor_type) }}"
                                               placeholder="Enter sensor type"
                                               required>
                                    </div>

                                    {{-- Machine --}}
                                    <div class="col-md-6">
                                        <label for="machine_id" class="form-label fw-semibold">
                                            Machine
                                        </label>

                                        <select name="machine_id"
                                                id="machine_id"
                                                class="form-select">
                                            <option value="">(Optional) Select Machine</option>

                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}"
                                                    {{ (string) old('machine_id', $sensor->machine_id) === (string) $machine->id ? 'selected' : '' }}>
                                                    {{ $machine->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Firmware Version --}}
                                    <div class="col-md-6">
                                        <label for="firmware_version" class="form-label fw-semibold">
                                            Firmware Version
                                        </label>

                                        <input type="text"
                                               name="firmware_version"
                                               id="firmware_version"
                                               class="form-control"
                                               value="{{ old('firmware_version', $sensor->firmware_version) }}"
                                               placeholder="e.g. 1.0.0">
                                    </div>

                                    {{-- Battery Level --}}
                                    <div class="col-md-4">
                                        <label for="battery_level" class="form-label fw-semibold">
                                            Battery Level (%)
                                        </label>

                                        <input type="number"
                                               name="battery_level"
                                               id="battery_level"
                                               class="form-control"
                                               min="0"
                                               max="100"
                                               value="{{ old('battery_level', $sensor->battery_level) }}"
                                               placeholder="Enter battery level">
                                    </div>

                                    {{-- Last Seen --}}
                                    <div class="col-md-4">
                                        <label for="last_seen" class="form-label fw-semibold">
                                            Last Seen
                                        </label>

                                        <input type="datetime-local"
                                               name="last_seen"
                                               id="last_seen"
                                               class="form-control"
                                               value="{{ old('last_seen', optional($sensor->last_seen)->format('Y-m-d\TH:i')) }}">
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-4">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select name="status"
                                                id="status"
                                                class="form-select"
                                                required>
                                            @foreach (['active', 'inactive', 'faulty', 'provisioning'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $sensor->status) === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3">
                                    <a href="{{ route('user.sensors.index') }}"
                                       class="btn btn-light border">
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

@include('user.include.footer')