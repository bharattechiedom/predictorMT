@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
                
        <div class="row">
           @include('admin.include.sidebar-nav')
            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

   
    {{-- Main Content --}}
    <div class="main-content">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3"
                 role="alert">

                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>
            </div>
        @endif

        {{-- Plans Table Card --}}
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Card Header --}}
            <div class="card-header bg-white border-0 p-3 p-md-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-list text-primary me-2"></i>
                            Plans Management
                        </h5>
                        <small class="text-muted">
                            Manage subscription plans, pricing and machine limits.
                        </small>
                    </div>
                    

                    
                    <div class="ms-auto">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill me-3">
                        {{ $plans->total() }} Total Plans
                    </span>
                        <a href="{{ route('admin.plans.create') }}"
                        class="btn theme-btn">
                            <i class="fa-solid fa-plus"></i>
                            Add Plan
                        </a>
                    </div>

                </div>
            </div>

            {{-- Table --}}
            <div class="card-body p-0">

                <div class="table-responsive list_Table">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Plan Name</th>
                                <th>Price</th>
                                <th>Machines</th>
                                <th>Companies</th>
                                <th>Created Date</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($plans as $plan)
                                <tr>

                                    {{-- ID --}}
                                    <td class="ps-4 text-muted">
                                        {{ $plan->id }}
                                    </td>

                                    {{-- Name --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="plan-icon">
                                                <i class="fa-solid fa-tags"></i>
                                            </div>

                                            <span class="fw-semibold">
                                                {{ $plan->name }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Price --}}
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            ${{ number_format($plan->price, 2) }}
                                        </span>
                                    </td>

                                    {{-- Machines --}}
                                    <td>
                                        <span class="text-dark">
                                            <i class="fa-solid fa-gears text-muted me-1"></i>
                                            {{ $plan->machines_included }}
                                        </span>
                                    </td>

                                    {{-- Companies --}}
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                            {{ $plan->companies_count ?? $plan->companies->count() }}
                                        </span>
                                    </td>

                                    {{-- Created Date --}}
                                    <td>
                                        <div class="small fw-medium">
                                            {{ $plan->created_at?->format('M d, Y') ?? 'N/A' }}
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center pe-4">
                                        <div class="d-inline-flex align-items-center gap-1 td_action">

                                            {{-- View --}}
                                            <a href="{{ route('admin.plans.show', $plan) }}"
                                               class="btn btn-sm btn-outline-primary action-btn"
                                               title="View Plan"
                                               aria-label="View Plan">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.plans.edit', $plan) }}"
                                               class="btn btn-sm btn-outline-warning action-btn"
                                               title="Edit Plan"
                                               aria-label="Edit Plan">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.plans.destroy', $plan) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this plan?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        title="Delete Plan"
                                                        aria-label="Delete Plan">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>
                                    <td colspan="7" class="text-center py-5">

                                        <div class="empty-state">
                                            <i class="fa-solid fa-tags fa-3x text-muted mb-3"></i>

                                            <h6 class="fw-bold">
                                                No Plans Found
                                            </h6>

                                            <p class="text-muted small mb-3">
                                                Get started by creating your first subscription plan.
                                            </p>

                                            <a href="{{ route('admin.plans.create') }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-plus"></i>
                                                Create First Plan
                                            </a>
                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Pagination --}}
        @if($plans->hasPages())
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-4">

                <small class="text-muted">
                    Showing {{ $plans->firstItem() ?? 0 }}
                    to {{ $plans->lastItem() ?? 0 }}
                    of {{ $plans->total() }} plans
                </small>

                <div class="plans-pagination">
                    {{ $plans->links() }}
                </div>

            </div>
        @endif

    </div>



                
            </div>
        </div>
    </div>
</main>
           


    @include('admin.include.footer')