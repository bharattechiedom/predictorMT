@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
                
        <div class="row">
           @include('admin.include.sidebar-nav')
            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

    

         {{-- Edit Company --}}
<div class="main-content p-4">

    <div class="card border-0 shadow-sm rounded-4">

        {{-- Header --}}
        <div class="card-header bg-white border-0 p-4 pb-0">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                </div>

                <div>
                    <h4 class="mb-1 fw-bold">Edit Company</h4>
                    <p class="text-muted small mb-0">
                        Update company details and subscription plan.
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

            <form action="{{ route('admin.companies.update', $company) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Company Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fa-solid fa-building text-primary me-2"></i>
                            Company Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter company name"
                            value="{{ old('name', $company->name) }}"
                            required
                        >
                    </div>

                    {{-- Country --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fa-solid fa-globe text-primary me-2"></i>
                            Country
                        </label>

                        <input
                            type="text"
                            name="country"
                            class="form-control"
                            placeholder="Enter country"
                            value="{{ old('country', $company->country) }}"
                        >
                    </div>

                    {{-- Timezone --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fa-solid fa-clock text-primary me-2"></i>
                            Timezone
                        </label>

                        <input
                            type="text"
                            name="timezone"
                            class="form-control"
                            placeholder="e.g. Asia/Kolkata"
                            value="{{ old('timezone', $company->timezone) }}"
                        >

                        <small class="text-muted">
                            Set the company's preferred timezone.
                        </small>
                    </div>

                    {{-- Subscription Plan --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fa-solid fa-layer-group text-primary me-2"></i>
                            Subscription Plan
                        </label>

                        <select name="plan_id" class="form-select">
                            <option value="">-- None --</option>

                            @foreach($plans as $plan)
                                <option
                                    value="{{ $plan->id }}"
                                    @selected(old('plan_id', $company->plan_id) == $plan->id)
                                >
                                    {{ $plan->name }}
                                    ({{ $plan->machines_included }} machines)
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 border-top mt-4 pt-4">

                    <a href="{{ route('admin.companies.index') }}"
                       class="btn btn-danger">
                        <i class="fa-solid fa-arrow-left"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn theme-btn">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Update Company
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