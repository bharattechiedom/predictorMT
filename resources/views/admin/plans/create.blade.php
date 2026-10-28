@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

                {{-- Add Plan --}}
                <div class="main-content p-4">

                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Header --}}
                        <div class="card-header bg-white border-0 p-4 pb-0">
                            <div class="d-flex align-items-center gap-3">

                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                    <i class="fa-solid fa-layer-group fa-lg"></i>
                                </div>

                                <div>
                                    <h4 class="mb-1 fw-bold">Add Plan</h4>
                                    <p class="text-muted small mb-0">
                                        Create a subscription plan and configure its pricing, machine limits, and features.
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="card-body p-4">

                            {{-- Validation Errors --}}
                            @if($errors->any())
                                <div class="alert alert-danger border-0 rounded-3">
                                    <div class="fw-semibold mb-2">
                                        <i class="fa-solid fa-circle-exclamation me-2"></i>
                                        Please fix the following errors:
                                    </div>

                                    <ul class="mb-0 ps-4">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.plans.store') }}" method="POST">
                                @csrf

                                <div class="row g-4">

                                    {{-- Plan Name --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-tag text-primary me-2"></i>
                                            Plan Name <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            placeholder="Enter plan name"
                                            value="{{ old('name') }}"
                                            required
                                        >
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-dollar-sign text-primary me-2"></i>
                                            Price <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            step="0.01"
                                            name="price"
                                            class="form-control"
                                            placeholder="Enter plan price"
                                            value="{{ old('price', '0.00') }}"
                                            required
                                        >
                                    </div>

                                    {{-- Machines Included --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-gears text-primary me-2"></i>
                                            Machines Included <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            name="machines_included"
                                            class="form-control"
                                            placeholder="Enter number of machines"
                                            value="{{ old('machines_included', 1) }}"
                                            required
                                        >
                                    </div>

                                    {{-- Billing Interval --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-calendar-days text-primary me-2"></i>
                                            Billing Interval
                                        </label>

                                        <input
                                            type="text"
                                            name="billing_interval"
                                            class="form-control"
                                            placeholder="e.g. per machine / month"
                                            value="{{ old('billing_interval') }}"
                                        >

                                        <small class="text-muted">
                                            Enter the billing interval label for this plan.
                                        </small>
                                    </div>

                                    {{-- Short Description --}}
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-align-left text-primary me-2"></i>
                                            Short Description
                                        </label>

                                        <textarea
                                            name="description"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Enter a short description of the plan"
                                        >{{ old('description') }}</textarea>
                                    </div>

                                    {{-- Features --}}
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">
                                            <i class="fa-solid fa-list-check text-primary me-2"></i>
                                            Plan Features
                                        </label>

                                        <textarea
                                            name="features_text"
                                            class="form-control"
                                            rows="6"
                                            placeholder="Enter one feature per line"
                                        >{{ old('features_text') }}</textarea>

                                        <small class="text-muted">
                                            Add each feature on a separate line.
                                        </small>
                                    </div>

                                </div>

                                {{-- Footer Actions --}}
                                <div class="d-flex flex-wrap justify-content-end gap-2 border-top mt-4 pt-4">

                                    <a
                                        href="{{ route('admin.plans.index') }}"
                                        class="btn btn-danger"
                                    >
                                        <i class="fa-solid fa-arrow-left"></i>
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-plus"></i>
                                        Create Plan
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
