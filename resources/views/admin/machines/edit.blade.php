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
                                <i class="fa-solid fa-gear text-primary me-2"></i>
                                Edit Machine
                            </h4>
                            <p class="text-muted mb-0">
                                Update machine information and status.
                            </p>
                        </div>

                        <a href="{{ route('admin.machines.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Machines
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                    {{-- Edit Machine Form --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-gears fs-4"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Machine Information</h5>
                                    <p class="text-muted small mb-0">
                                        Edit the details below and save your changes.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <form method="POST"
                                  action="{{ route('admin.machines.update', $machine) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">

                                    {{-- Company --}}
                                    <div class="col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company <span class="text-danger">*</span>
                                        </label>

                                        <select name="company_id"
                                                id="company_id"
                                                class="form-select @error('company_id') is-invalid @enderror"
                                                required>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id', $machine->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Name --}}
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Machine Name <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $machine->name) }}"
                                               placeholder="Enter machine name"
                                               required>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Type --}}
                                    <div class="col-md-6">
                                        <label for="machine_type" class="form-label fw-semibold">
                                            Machine Type
                                        </label>

                                        <input type="text"
                                               name="machine_type"
                                               id="machine_type"
                                               class="form-control @error('machine_type') is-invalid @enderror"
                                               value="{{ old('machine_type', $machine->machine_type) }}"
                                               placeholder="Enter machine type">

                                        @error('machine_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Serial Number --}}
                                    <div class="col-md-6">
                                        <label for="serial_number" class="form-label fw-semibold">
                                            Serial Number
                                        </label>

                                        <input type="text"
                                               name="serial_number"
                                               id="serial_number"
                                               class="form-control @error('serial_number') is-invalid @enderror"
                                               value="{{ old('serial_number', $machine->serial_number) }}"
                                               placeholder="Enter serial number">

                                        @error('serial_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-md-6">
                                        <label for="location" class="form-label fw-semibold">
                                            Location
                                        </label>

                                        <input type="text"
                                               name="location"
                                               id="location"
                                               class="form-control @error('location') is-invalid @enderror"
                                               value="{{ old('location', $machine->location) }}"
                                               placeholder="Enter machine location">

                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Installed At --}}
                                    <div class="col-md-6">
                                        <label for="installed_at" class="form-label fw-semibold">
                                            Installed At
                                        </label>

                                        <input type="date"
                                               name="installed_at"
                                               id="installed_at"
                                               class="form-control @error('installed_at') is-invalid @enderror"
                                               value="{{ old('installed_at', optional($machine->installed_at)->format('Y-m-d')) }}">

                                        @error('installed_at')
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
                                            @foreach (['healthy', 'at_risk', 'critical', 'offline'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $machine->status) === $status ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="d-flex flex-wrap gap-2 justify-content-end border-top mt-4 pt-4">
                                    <a href="{{ route('admin.machines.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-floppy-disk me-1"></i>
                                        Update Machine
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
