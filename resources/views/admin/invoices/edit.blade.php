
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
                            <h4 class="fw-bold mb-1">Edit Invoice</h4>
                            <p class="text-muted mb-0">
                                Update invoice details, billing period and payment status.
                            </p>
                        </div>

                        <a href="{{ route('admin.invoices.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Invoices
                        </a>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-2">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Please fix the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
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

                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Card Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-1">
                                <i class="fas fa-file-invoice-dollar text-primary me-2"></i>
                                Invoice Information
                            </h5>
                            <p class="text-muted small mb-0">
                                Edit the invoice information below and save your changes.
                            </p>
                        </div>

                        <div class="card-body p-4 border-top">
                            <form method="POST"
                                  action="{{ route('admin.invoices.update', $invoice) }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">

                                    {{-- Company --}}
                                    <div class="col-12 col-md-6">
                                        <label for="company_id" class="form-label fw-semibold">
                                            Company <span class="text-danger">*</span>
                                        </label>

                                        <select name="company_id"
                                                id="company_id"
                                                class="form-select @error('company_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Company</option>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id', $invoice->company_id) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Amount --}}
                                    <div class="col-12 col-md-6">
                                        <label for="amount" class="form-label fw-semibold">
                                            Amount <span class="text-danger">*</span>
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               name="amount"
                                               id="amount"
                                               value="{{ old('amount', $invoice->amount) }}"
                                               class="form-control @error('amount') is-invalid @enderror"
                                               placeholder="Enter invoice amount"
                                               required>

                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Billing Period Start --}}
                                    <div class="col-12 col-md-6">
                                        <label for="billing_period_start" class="form-label fw-semibold">
                                            Billing Period Start <span class="text-danger">*</span>
                                        </label>

                                        <input type="date"
                                               name="billing_period_start"
                                               id="billing_period_start"
                                               value="{{ old('billing_period_start', optional($invoice->billing_period_start)->format('Y-m-d')) }}"
                                               class="form-control @error('billing_period_start') is-invalid @enderror"
                                               required>

                                        @error('billing_period_start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Billing Period End --}}
                                    <div class="col-12 col-md-6">
                                        <label for="billing_period_end" class="form-label fw-semibold">
                                            Billing Period End <span class="text-danger">*</span>
                                        </label>

                                        <input type="date"
                                               name="billing_period_end"
                                               id="billing_period_end"
                                               value="{{ old('billing_period_end', optional($invoice->billing_period_end)->format('Y-m-d')) }}"
                                               class="form-control @error('billing_period_end') is-invalid @enderror"
                                               required>

                                        @error('billing_period_end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Paid At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="paid_at" class="form-label fw-semibold">
                                            Paid At
                                        </label>

                                        <input type="datetime-local"
                                               name="paid_at"
                                               id="paid_at"
                                               value="{{ old('paid_at', optional($invoice->paid_at)->format('Y-m-d\TH:i')) }}"
                                               class="form-control @error('paid_at') is-invalid @enderror">

                                        @error('paid_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <small class="text-muted">
                                            Optional. Enter the date and time when payment was received.
                                        </small>
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
                                            @foreach(['pending', 'paid', 'failed'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $invoice->status) === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- External Invoice ID --}}
                                    <div class="col-12 col-md-6">
                                        <label for="external_invoice_id" class="form-label fw-semibold">
                                            External Invoice ID
                                        </label>

                                        <input type="text"
                                               name="external_invoice_id"
                                               id="external_invoice_id"
                                               value="{{ old('external_invoice_id', $invoice->external_invoice_id) }}"
                                               class="form-control @error('external_invoice_id') is-invalid @enderror"
                                               placeholder="Enter external invoice ID">

                                        @error('external_invoice_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="border-top mt-4 pt-4 d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn theme-btn">
                                        <i class="fas fa-save me-2"></i>Update Invoice
                                    </button>

                                    <a href="{{ route('admin.invoices.index') }}"
                                       class="btn btn-dark fs-14">
                                        Cancel
                                    </a>
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
