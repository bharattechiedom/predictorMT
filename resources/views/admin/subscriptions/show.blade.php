
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Subscription Details</h4>
                            <p class="text-muted mb-0">
                                View company subscription and plan information.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.subscriptions.edit', $subscription) }}"
                               class="btn theme-btn">
                                <i class="fas fa-edit me-2"></i>Edit Subscription
                            </a>

                            <a href="{{ route('admin.subscriptions.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </div>

                    @php
                        $status = strtolower(str_replace(
                            ['_', '-'],
                            ' ',
                            $subscription->status ?? ''
                        ));

                        $statusClass = match($status) {
                            'active' => 'text-bg-success',
                            'trialing', 'trial' => 'text-bg-info',
                            'past due', 'pending' => 'text-bg-warning',
                            'cancelled', 'canceled', 'expired' => 'text-bg-danger',
                            default => 'text-bg-secondary',
                        };
                    @endphp

                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Card Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-receipt fs-4 text-primary"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        Subscription #{{ $subscription->id }}
                                    </h5>

                                    <span class="badge rounded-pill {{ $statusClass }}">
                                        {{ $subscription->status
                                            ? ucwords(str_replace(['_', '-'], ' ', $subscription->status))
                                            : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Subscription Information --}}
                        <div class="card-body p-4 border-top">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                General Information
                            </h6>

                            <div class="row g-0 border rounded-3 overflow-hidden">

                                <div class="col-12 col-md-4 bg-light p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Subscription ID</span>
                                    <span class="fw-semibold">
                                        #{{ $subscription->id }}
                                    </span>
                                </div>

                                <div class="col-12 col-md-4 p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Company</span>
                                    <span class="fw-semibold">
                                        {{ optional($subscription->company)->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-12 col-md-4 bg-light p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Plan</span>
                                    <span class="fw-semibold">
                                        {{ optional($subscription->plan)->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-12 col-md-4 p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Status</span>
                                    <span class="badge rounded-pill {{ $statusClass }}">
                                        {{ $subscription->status
                                            ? ucwords(str_replace(['_', '-'], ' ', $subscription->status))
                                            : 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-12 col-md-4 bg-light p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Started At</span>
                                    <span class="fw-semibold">
                                        {{ optional($subscription->started_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-12 col-md-4 p-3 border-bottom">
                                    <span class="text-muted small d-block mb-1">Ended At</span>
                                    <span class="fw-semibold">
                                        {{ optional($subscription->ended_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-12 p-3 bg-light">
                                    <span class="text-muted small d-block mb-1">
                                        External Subscription ID
                                    </span>
                                    <span class="fw-semibold text-break">
                                        {{ $subscription->external_subscription_id ?: 'N/A' }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Card Footer --}}
                        <div class="card-footer bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-end gap-2">
                                <a href="{{ route('admin.subscriptions.index') }}"
                                   class="btn btn-dark fs-14">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Subscriptions
                                </a>

                                <a href="{{ route('admin.subscriptions.edit', $subscription) }}"
                                   class="btn theme-btn">
                                    <i class="fas fa-edit me-2"></i>Edit Subscription
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
