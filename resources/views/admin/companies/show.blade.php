@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
                
        <div class="row">
           @include('admin.include.sidebar-nav')
            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

    {{-- Company Profile --}}
<div class="main-content p-4">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fa-solid fa-building text-primary me-2"></i>
                Company Profile
            </h4>
            <p class="text-muted mb-0 small">
                View company information and account overview.
            </p>
        </div>

        <a href="{{ route('admin.companies.index') }}"
           class="btn btn-dark fs-14">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Companies
        </a>
    </div>

    {{-- Company Overview --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <div class="d-flex flex-wrap align-items-center gap-3">

                <div class="company-avatar">
                    <i class="fa-solid fa-building"></i>
                </div>

                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-1 fs-5">{{ $company->name }}</h4>

                    <p class="text-muted mb-2">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        {{ $company->country ?? 'Country not specified' }}
                    </p>

                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Company Account
                    </span>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.companies.edit', $company) }}"
                       class="btn theme-btn">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit Company
                    </a>
                </div>

            </div>

        </div>
    </div>

    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div>
                        <p class="text-muted small mb-1">Total Users</p>
                        <h3 class="fw-bold mb-0">
                            {{ $company->users->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-gears"></i>
                    </div>

                    <div>
                        <p class="text-muted small mb-1">Total Machines</p>
                        <h3 class="fw-bold mb-0">
                            {{ $company->machines->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <div>
                        <p class="text-muted small mb-1">Subscription Plan</p>
                        <h5 class="fw-bold mb-0">
                            {{ $company->plan?->name ?? 'No Plan Assigned' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Company Details --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4 pb-0">
            <h5 class="fw-bold mb-1">
                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                Company Information
            </h5>
            <p class="text-muted small mb-0">
                Basic details and subscription information.
            </p>
        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- Company Name --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-building"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Company Name</p>
                            <h6 class="fw-semibold mb-0">{{ $company->name }}</h6>
                        </div>
                    </div>
                </div>

                {{-- Country --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-globe"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Country</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $company->country ?? 'N/A' }}
                            </h6>
                        </div>
                    </div>
                </div>

                {{-- Timezone --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-clock"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Timezone</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $company->timezone ?: 'UTC' }}
                            </h6>
                        </div>
                    </div>
                </div>

                {{-- Plan --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Subscription Plan</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $company->plan?->name ?? 'None' }}
                            </h6>

                            @if($company->plan)
                                <small class="text-muted">
                                    {{ $company->plan->machines_included }} machines included
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Users --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Registered Users</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $company->users->count() }} Users
                            </h6>
                        </div>
                    </div>
                </div>

                {{-- Machines --}}
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-icon">
                            <i class="fa-solid fa-gears"></i>
                        </span>
                        <div>
                            <p class="text-muted small mb-1">Registered Machines</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $company->machines->count() }} Machines
                            </h6>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Actions --}}
            <div class="border-top mt-4 pt-4 d-flex flex-wrap justify-content-end gap-2">

                <a href="{{ route('admin.companies.index') }}"
                   class="btn btn-danger">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

                <a href="{{ route('admin.companies.edit', $company) }}"
                   class="btn theme-btn">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Profile
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