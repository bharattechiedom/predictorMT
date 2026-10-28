
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
                            <h4 class="fw-bold mb-1">Add Subscription</h4>
                            <p class="text-muted mb-0">
                                Create a new subscription for a company.
                            </p>
                        </div>

                        <a href="{{ route('admin.subscriptions.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Subscriptions
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
                                <i class="fas fa-receipt text-primary me-2"></i>
                                Subscription Information
                            </h5>
                            <p class="text-muted small mb-0">
                                Enter the company, plan, status and subscription details below.
                            </p>
                        </div>

                        <div class="card-body p-4 border-top">
                            <form method="POST"
                                  action="{{ route('admin.subscriptions.store') }}">
                                @csrf

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
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Plan --}}
                                    <div class="col-12 col-md-6">
                                        <label for="plan_id" class="form-label fw-semibold">
                                            Plan <span class="text-danger">*</span>
                                        </label>

                                        <select name="plan_id"
                                                id="plan_id"
                                                class="form-select @error('plan_id') is-invalid @enderror"
                                                required>
                                            <option value="">Select Plan</option>

                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}"
                                                    {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                                    {{ $plan->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('plan_id')
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
                                            <option value="">Select Status</option>

                                            @foreach(['active', 'trialing', 'past_due', 'cancelled'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', 'active') == $status ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Started At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="started_at" class="form-label fw-semibold">
                                            Started At <span class="text-danger">*</span>
                                        </label>

                                        <input type="datetime-local"
                                               name="started_at"
                                               id="started_at"
                                               value="{{ old('started_at') }}"
                                               class="form-control @error('started_at') is-invalid @enderror"
                                               required>

                                        @error('started_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Ended At --}}
                                    <div class="col-12 col-md-6">
                                        <label for="ended_at" class="form-label fw-semibold">
                                            Ended At
                                        </label>

                                        <input type="datetime-local"
                                               name="ended_at"
                                               id="ended_at"
                                               value="{{ old('ended_at') }}"
                                               class="form-control @error('ended_at') is-invalid @enderror">

                                        @error('ended_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <small class="text-muted">
                                            Optional. Leave blank if no end date is set.
                                        </small>
                                    </div>

                                    {{-- External Subscription ID --}}
                                    <div class="col-12 col-md-6">
                                        <label for="external_subscription_id"
                                               class="form-label fw-semibold">
                                            External Subscription ID
                                        </label>

                                        <input type="text"
                                               name="external_subscription_id"
                                               id="external_subscription_id"
                                               value="{{ old('external_subscription_id') }}"
                                               class="form-control @error('external_subscription_id') is-invalid @enderror"
                                               placeholder="Enter external subscription ID">

                                        @error('external_subscription_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Form Actions --}}
                                <div class="border-top mt-4 pt-4 d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn theme-btn">
                                        <i class="fas fa-save me-2"></i>Create Subscription
                                    </button>

                                    <a href="{{ route('admin.subscriptions.index') }}"
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
