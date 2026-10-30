@php
    $page_title = 'View Machine';
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
                            <h3 class="fw-bold mb-1">Machine Details</h3>
                            <p class="text-muted mb-0">
                                View machine information, installation details and current status.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('user.machines.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left me-1"></i>
                                Back to Machines
                            </a>

                            <a href="{{ route('user.machines.edit', $machine) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen me-1"></i>
                                Edit Machine
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3"
                             role="alert">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Machine Details --}}
                    <div class="card border-0 shadow-none mt-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-gears me-2 text-primary"></i>
                                {{ $machine->name }}
                            </h5>

                            <p class="text-muted small mb-0">
                                Machine information and current configuration.
                            </p>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <div class="row g-3">

                                {{-- Machine Name --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Machine Name
                                        </div>
                                        <div class="fw-semibold text-dark fs-5">
                                            {{ $machine->name ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Machine Type --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Machine Type
                                        </div>
                                        <div class="fw-semibold text-dark fs-5">
                                            {{ $machine->machine_type ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Serial Number --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Serial Number
                                        </div>
                                        <div class="fw-semibold text-dark fs-5">
                                            {{ $machine->serial_number ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Location
                                        </div>
                                        <div class="fw-semibold text-dark fs-5">
                                            {{ $machine->location ?: '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Installation Date --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Installed At
                                        </div>
                                        <div class="fw-semibold text-dark fs-5">
                                            {{ $machine->installed_at ? $machine->installed_at->format('Y-m-d') : '—' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Machine Status --}}
                                <div class="col-md-6">
                                    <div class="border rounded p-2">
                                        <div class="text-muted small mb-1">
                                            Current Status
                                        </div>

                                        @php
                                            $status = strtolower($machine->status ?? '');
                                        @endphp

                                        @switch($status)
                                            @case('healthy')
                                            @case('running')
                                                <span class="badge bg-success">
                                                    <i class="fa-solid fa-circle-check me-1"></i>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                                @break

                                            @case('at_risk')
                                            @case('idle')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                                @break

                                            @case('critical')
                                            @case('fault')
                                                <span class="badge bg-danger">
                                                    <i class="fa-solid fa-circle-exclamation me-1"></i>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                                @break

                                            @case('offline')
                                                <span class="badge bg-secondary">
                                                    <i class="fa-solid fa-power-off me-1"></i>
                                                    Offline
                                                </span>
                                                @break

                                            @case('maintenance')
                                                <span class="badge bg-info text-dark">
                                                    <i class="fa-solid fa-screwdriver-wrench me-1"></i>
                                                    Maintenance
                                                </span>
                                                @break

                                            @default
                                                <span class="badge bg-secondary">
                                                    {{ $machine->status ?: 'Unknown' }}
                                                </span>
                                        @endswitch
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Footer Actions --}}
                        <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3">
                            <a href="{{ route('user.machines.index') }}"
                               class="btn btn-light border">
                                Back to List
                            </a>

                            <a href="{{ route('user.machines.edit', $machine) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen me-1"></i>
                                Edit Machine
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('user.include.footer')