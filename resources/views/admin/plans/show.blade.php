@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

                <div class="main-content p-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">
                                <i class="fa-solid fa-layer-group text-primary me-2"></i>
                                Plan Details
                            </h4>
                            <p class="text-muted mb-0 small">
                                View subscription plan information, pricing, and included features.
                            </p>
                        </div>

                        <a href="{{ route('admin.plans.index') }}"
                           class="btn btn-dark fs-14">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back to Plans
                        </a>
                    </div>

                    {{-- Plan Overview --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">

                            <div class="d-flex flex-wrap align-items-center gap-3">

                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-layer-group fa-2x"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1 fs-5">
                                        {{ $plan->name }}
                                    </h4>

                                    <p class="text-muted mb-2">
                                        <i class="fa-solid fa-dollar-sign me-2"></i>
                                        ${{ number_format($plan->price, 2) }}

                                        <span class="ms-1">
                                            {{ $plan->billing_interval ? ' / ' . $plan->billing_interval : '' }}
                                        </span>
                                    </p>

                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                        <i class="fa-solid fa-circle-check me-1"></i>
                                        Subscription Plan
                                    </span>
                                </div>

                                <div>
                                    <a href="{{ route('admin.plans.edit', $plan) }}"
                                       class="btn theme-btn">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit Plan
                                    </a>
                                </div>

                            </div>

                            @if($plan->description)
                                <div class="border-top mt-4 pt-3">
                                    <h6 class="fw-semibold mb-2">Plan Description</h6>
                                    <p class="text-muted mb-0">
                                        {{ $plan->description }}
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- Statistics --}}
                    <div class="row g-3 mb-4">

                        {{-- Price --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex align-items-center gap-3">

                                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                        <i class="fa-solid fa-dollar-sign fa-lg"></i>
                                    </div>

                                    <div>
                                        <p class="text-muted small mb-1">Plan Price</p>
                                        <h3 class="fw-bold mb-0">
                                            ${{ number_format($plan->price, 2) }}
                                        </h3>

                                        @if($plan->billing_interval)
                                            <small class="text-muted">
                                                {{ $plan->billing_interval }}
                                            </small>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Machines --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex align-items-center gap-3">

                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fa-solid fa-gears fa-lg"></i>
                                    </div>

                                    <div>
                                        <p class="text-muted small mb-1">Machines Included</p>
                                        <h3 class="fw-bold mb-0">
                                            {{ $plan->machines_included }}
                                        </h3>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Companies --}}
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex align-items-center gap-3">

                                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                                        <i class="fa-solid fa-building fa-lg"></i>
                                    </div>

                                    <div>
                                        <p class="text-muted small mb-1">Companies on this Plan</p>
                                        <h3 class="fw-bold mb-0">
                                            {{ $plan->companies->count() }}
                                        </h3>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Plan Information --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-white border-0 p-4 pb-0">
                            <h5 class="fw-bold mb-1">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                Plan Information
                            </h5>

                            <p class="text-muted small mb-0">
                                Overview of pricing and subscription limits.
                            </p>
                        </div>

                        <div class="card-body p-4">

                            <div class="row g-4">

                                {{-- Plan Name --}}
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                            <i class="fa-solid fa-tag"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Plan Name</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $plan->name }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Price</p>
                                            <h6 class="fw-semibold mb-0">
                                                ${{ number_format($plan->price, 2) }}
                                            </h6>

                                            @if($plan->billing_interval)
                                                <small class="text-muted">
                                                    {{ $plan->billing_interval }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Machines Included --}}
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                                            <i class="fa-solid fa-gears"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Machines Included</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $plan->machines_included }} Machines
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Billing Interval --}}
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Billing Interval</p>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $plan->billing_interval ?: 'Not specified' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-12">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="bg-secondary bg-opacity-10 text-secondary rounded-3 p-3">
                                            <i class="fa-solid fa-align-left"></i>
                                        </div>

                                        <div>
                                            <p class="text-muted small mb-1">Description</p>
                                            <p class="mb-0">
                                                {{ $plan->description ?: 'No description available.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Plan Features --}}
                    @if(!empty($plan->features))
                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-header bg-white border-0 p-4 pb-0">
                                <h5 class="fw-bold mb-1">
                                    <i class="fa-solid fa-list-check text-primary me-2"></i>
                                    Plan Features
                                </h5>

                                <p class="text-muted small mb-0">
                                    Features and benefits included in this subscription.
                                </p>
                            </div>

                            <div class="card-body p-4">

                                <div class="row g-3">
                                    @foreach($plan->features as $feature)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-start gap-2">
                                                <i class="fa-solid fa-circle-check text-success mt-1"></i>
                                                <span>{{ $feature }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endif

                    {{-- Footer Actions --}}
                    <div class="border-top mt-4 pt-4 d-flex flex-wrap justify-content-end gap-2">

                        <a href="{{ route('admin.plans.index') }}"
                           class="btn btn-danger">
                            <i class="fa-solid fa-arrow-left"></i>
                            Back
                        </a>

                        <a href="{{ route('admin.plans.edit', $plan) }}"
                           class="btn theme-btn">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Plan
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>
</main>

@include('admin.include.footer')