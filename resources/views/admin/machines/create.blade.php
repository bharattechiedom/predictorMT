@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                <i class="fas fa-cogs fa-lg"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold mb-1">Add Machine</h4>
                                <p class="text-muted mb-0 small">
                                    Register a machine and enter its company, installation and status details.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('admin.machines.index') }}"
                            class="btn btn-outline-secondary rounded-3">
                            <i class="fas fa-arrow-left me-2"></i>Back to Machines
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
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
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Add Machine Form --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fas fa-plus-circle fa-lg"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Machine Information</h5>
                                    <p class="text-muted small mb-0">
                                        Fill in the details below to create a machine record.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 border-top">

                            <form method="POST" action="{{ route('admin.machines.store') }}">
                                @csrf

                                <div class="row g-3">

                                    {{-- Company --}}
                                    <div class="col-12 col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company <span class="text-danger">*</span>
                                        </label>

                                        <select name="company_id"
                                            id="company_id"
                                            class="form-select @error('company_id') is-invalid @enderror"
                                            required>
                                            <option value="" disabled
                                                {{ old('company_id') ? '' : 'selected' }}>
                                                Select Company
                                            </option>

                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Machine Name <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                            name="name"
                                            id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}"
                                            placeholder="Enter machine name"
                                            required>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Machine Type --}}
                                    <div class="col-12 col-md-6">
                                        <label for="machine_type" class="form-label fw-semibold">
                                            Type
                                        </label>

                                        <input type="text"
                                            name="machine_type"
                                            id="machine_type"
                                            class="form-control @error('machine_type') is-invalid @enderror"
                                            value="{{ old('machine_type') }}"
                                            placeholder="Enter machine type">

                                        @error('machine_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Serial Number --}}
                                    <div class="col-12 col-md-6">
                                        <label for="serial_number" class="form-label fw-semibold">
                                            Serial Number
                                        </label>

                                        <input type="text"
                                            name="serial_number"
                                            id="serial_number"
                                            class="form-control @error('serial_number') is-invalid @enderror"
                                            value="{{ old('serial_number') }}"
                                            placeholder="Enter serial number">

                                        @error('serial_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Location --}}
                                    <div class="col-12 col-md-6">
                                        <label for="location" class="form-label fw-semibold">
                                            Location
                                        </label>

                                        <input type="text"
                                            name="location"
                                            id="location"
                                            class="form-control @error('location') is-invalid @enderror"
                                            value="{{ old('location') }}"
                                            placeholder="Enter machine location">

                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Installed At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="installed_at" class="form-label fw-semibold">
                                            Installed At
                                        </label>

                                        <input type="date"
                                            name="installed_at"
                                            id="installed_at"
                                            class="form-control @error('installed_at') is-invalid @enderror"
                                            value="{{ old('installed_at') }}">

                                        @error('installed_at')
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
                                            <option value="healthy"
                                                {{ old('status', 'healthy') == 'healthy' ? 'selected' : '' }}>
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
                                <div class="border-top mt-4 pt-4 d-flex flex-wrap justify-content-end gap-2">
                                    <a href="{{ route('admin.machines.index') }}"
                                        class="btn btn-light border rounded-3 px-4">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                                        <i class="fas fa-plus me-2"></i>Create Machine
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
