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
                                <i class="fa-solid fa-gears text-primary me-2"></i>
                                Machine Details
                            </h4>
                            <p class="text-muted mb-0">
                                View machine information and current status.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.machines.edit', $machine) }}"
                               class="btn theme-btn">
                                <i class="fa-solid fa-pen-to-square me-1"></i>
                                Edit Machine
                            </a>

                            <a href="{{ route('admin.machines.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Machines
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Machine Summary --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-gears fs-3"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">{{ $machine->name }}</h5>
                                    <p class="text-muted mb-0">
                                        {{ $machine->machine_type ?: 'Machine type not specified' }}
                                    </p>
                                </div>

                                <div>
                                    @php
                                        $statusColors = [
                                            'healthy' => 'success',
                                            'at_risk' => 'warning',
                                            'critical' => 'danger',
                                            'offline' => 'secondary',
                                        ];

                                        $statusColor = $statusColors[$machine->status] ?? 'secondary';
                                    @endphp

                                    <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-3 py-2">
                                        {{ ucwords(str_replace('_', ' ', $machine->status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Machine Information --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-circle-info fs-4"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">Machine Information</h5>
                                    <p class="text-muted small mb-0">
                                        Complete details of this machine.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4">
                            <dl class="row mb-0">

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-hashtag me-2"></i>ID
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ $machine->id }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-building me-2"></i>Company
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ optional($machine->company)->name ?? 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-gears me-2"></i>Name
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ $machine->name }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-tag me-2"></i>Type
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ $machine->machine_type ?: 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-barcode me-2"></i>Serial Number
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ $machine->serial_number ?: 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-location-dot me-2"></i>Location
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ $machine->location ?: 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-regular fa-calendar me-2"></i>Installed At
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ optional($machine->installed_at)->format('Y-m-d') ?? 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-signal me-2"></i>Status
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} px-3 py-2">
                                        {{ ucwords(str_replace('_', ' ', $machine->status)) }}
                                    </span>
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-regular fa-clock me-2"></i>Created
                                </dt>
                                <dd class="col-sm-9 border-bottom py-3 mb-0">
                                    {{ optional($machine->created_at)->toDayDateTimeString() ?? 'N/A' }}
                                </dd>

                                <dt class="col-sm-3 text-muted fw-semibold py-3">
                                    <i class="fa-solid fa-clock-rotate-left me-2"></i>Updated
                                </dt>
                                <dd class="col-sm-9 py-3 mb-0">
                                    {{ optional($machine->updated_at)->toDayDateTimeString() ?? 'N/A' }}
                                </dd>

                            </dl>
                        </div>

                        <div class="card-footer bg-white border-0 p-3 p-md-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.machines.index') }}"
                                   class="btn btn-dark fs-14">
                                    Back to List
                                </a>

                                <a href="{{ route('admin.machines.edit', $machine) }}"
                                   class="btn theme-btn">
                                    <i class="fa-solid fa-pen-to-square me-1"></i>
                                    Edit Machine
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
