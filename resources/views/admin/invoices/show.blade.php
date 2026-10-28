
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Invoice Details</h4>
                            <p class="text-muted mb-0">
                                View invoice and billing information.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.invoices.edit', $invoice) }}"
                               class="btn theme-btn">
                                <i class="fas fa-edit me-1"></i> Edit Invoice
                            </a>

                            <a href="{{ route('admin.invoices.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row g-4">

                        {{-- Invoice Summary --}}
                        <div class="col-12 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h5 class="fw-bold mb-0">Invoice Summary</h5>
                                        <span class="bg-light rounded-3 p-3 text-primary">
                                            <i class="fas fa-file-invoice-dollar fa-lg"></i>
                                        </span>
                                    </div>

                                    <p class="text-muted small mb-1">Invoice ID</p>
                                    <h3 class="fw-bold mb-4">#{{ $invoice->id }}</h3>

                                    <p class="text-muted small mb-2">Invoice Status</p>
                                    @php
                                        $status = strtolower($invoice->status ?? 'pending');
                                        $statusClass = [
                                            'paid' => 'success',
                                            'pending' => 'warning',
                                            'failed' => 'danger',
                                        ][$status] ?? 'secondary';
                                    @endphp

                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} px-3 py-2 rounded-pill">
                                        {{ ucfirst($invoice->status ?? 'N/A') }}
                                    </span>

                                    <hr class="my-4">

                                    <p class="text-muted small mb-1">Invoice Amount</p>
                                    <h4 class="fw-bold text-primary mb-0">
                                        {{ $invoice->amount }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        {{-- Billing Details --}}
                        <div class="col-12 col-lg-8">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-4 pb-0">
                                    <h5 class="fw-bold mb-1">Billing Information</h5>
                                    <p class="text-muted small mb-0">
                                        Company and payment details
                                    </p>
                                </div>

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light rounded-3 p-3 text-primary">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                                <div>
                                                    <p class="text-muted small mb-1">Company</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($invoice->company)->name ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light rounded-3 p-3 text-primary">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                                <div>
                                                    <p class="text-muted small mb-1">Billing Period</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($invoice->billing_period_start)->format('Y-m-d') ?? 'N/A' }}
                                                        <span class="text-muted">→</span>
                                                        {{ optional($invoice->billing_period_end)->format('Y-m-d') ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light rounded-3 p-3 text-primary">
                                                    <i class="fas fa-credit-card"></i>
                                                </span>
                                                <div>
                                                    <p class="text-muted small mb-1">Paid At</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($invoice->paid_at)->format('Y-m-d H:i') ?? 'Not paid yet' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light rounded-3 p-3 text-primary">
                                                    <i class="fas fa-fingerprint"></i>
                                                </span>
                                                <div>
                                                    <p class="text-muted small mb-1">External Invoice ID</p>
                                                    <h6 class="fw-semibold mb-0 text-break">
                                                        {{ $invoice->external_invoice_id ?: 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
