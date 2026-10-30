@php
    $page_title = 'Create Machine';
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
                            <h3 class="fw-bold mb-1">Add New Machine</h3>
                            <p class="text-muted mb-0">
                                Register a machine and configure its basic details.
                            </p>
                        </div>

                        <a href="{{ route('user.machines.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Back to Machines
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                    {{-- Create Machine Form --}}
                    <div class="card border-0 shadow-none">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-gears me-2 text-primary"></i>
                                Machine Details
                            </h5>
                            <p class="text-muted small mb-0">
                                Fields marked with <span class="text-danger">*</span> are required.
                            </p>
                        </div>

                        <div class="card-body p-0">
                            <form method="POST"
                                  action="{{ route('user.machines.store') }}">
                                @csrf

                                <div class="row g-3">

                                    {{-- Machine Name --}}
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Machine Name <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="name"
                                               name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}"
                                               placeholder="Enter machine name"
                                               required>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Type --}}
                                    <div class="col-md-6">
                                        <label for="machine_type" class="form-label fw-semibold">
                                            Machine Type <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="machine_type"
                                               name="machine_type"
                                               class="form-control @error('machine_type') is-invalid @enderror"
                                               value="{{ old('machine_type') }}"
                                               placeholder="e.g. Electric Motor"
                                               required>

                                        @error('machine_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Serial Number --}}
                                    <div class="col-md-6">
                                        <label for="serial_number" class="form-label fw-semibold">
                                            Serial Number <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="serial_number"
                                               name="serial_number"
                                               class="form-control @error('serial_number') is-invalid @enderror"
                                               value="{{ old('serial_number') }}"
                                               placeholder="Enter serial number"
                                               required>

                                        @error('serial_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-md-6">
                                        <label for="location" class="form-label fw-semibold">
                                            Location <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               id="location"
                                               name="location"
                                               class="form-control @error('location') is-invalid @enderror"
                                               value="{{ old('location') }}"
                                               placeholder="e.g. Plant A"
                                               required>

                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Installation Date --}}
                                    <div class="col-md-6">
                                        <label for="installed_at" class="form-label fw-semibold">
                                            Installed At <span class="text-danger">*</span>
                                        </label>

                                        <input type="date"
                                               id="installed_at"
                                               name="installed_at"
                                               class="form-control @error('installed_at') is-invalid @enderror"
                                               value="{{ old('installed_at') }}"
                                               required>

                                        @error('installed_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Status --}}
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>

                                        <select id="status"
                                                name="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            <option value="">Select status</option>

                                            <option value="healthy"
                                                {{ old('status') == 'healthy' ? 'selected' : '' }}>
                                                Healthy
                                            </option>

                                            <option value="at_risk"
                                                {{ old('status') == 'at_risk' ? 'selected' : '' }}>
                                                At Risk
                                            </option>

                                            <option value="critical"
                                                {{ old('status') == 'critical' ? 'selected' : '' }}>
                                                Critical
                                            </option>

                                            <option value="offline"
                                                {{ old('status') == 'offline' ? 'selected' : '' }}>
                                                Offline
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3">
                                    <a href="{{ route('user.machines.index') }}"
                                       class="btn btn-light border">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-plus me-1"></i>
                                        Create Machine
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
