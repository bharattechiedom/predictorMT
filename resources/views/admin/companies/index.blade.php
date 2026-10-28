@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
                
        <div class="row">
           @include('admin.include.sidebar-nav')
            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">

    

    <div class="main-content">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Companies Card --}}
    <div class="card border-0 shadow-sm rounded-4">

        {{-- Header --}}
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex flex-wrap justify-content-between
                        align-items-center gap-3">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="fas fa-building text-primary me-2"></i>
                        Companies List
                    </h5>
                    <p class="text-secondary small mb-0">
                        Manage all registered companies
                    </p>
                </div>

                <div class="d-flex align-items-center col-5">
                    <div class="input-group search-input-group me-3">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="text" id="companySearch"
                        class="form-control"
                        placeholder="Search companies...">
                    </div>
                    <a href="{{ route('admin.companies.create') }}"
                        class="btn theme-btn btn-flex-none">
                        <i class="fas fa-plus me-1"></i>
                        Add Company
                    </a>                            
                </div>

                

            </div>
        </div>


        <div class="table-responsive list_Table">
            <table class="table table-hover align-middle mb-0" id="companiesTable">

                <thead class="table-light">
                    <tr class="text-secondary small text-uppercase">
                        <th class="ps-4">ID</th>
                        <th>Company Name</th>
                        <th>Country</th>
                        <th>Timezone</th>
                        <th>Plan</th>
                        <th>Created</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td class="ps-4">
                                <span class="badge text-bg-light border">
                                    #{{ $company->id }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-inline-flex align-items-center
                                                 justify-content-center rounded-3
                                                 bg-primary-subtle text-primary fw-bold"
                                          style="width:38px;height:38px;">
                                        {{ strtoupper(substr($company->name, 0, 1)) }}
                                    </span>

                                    <span class="fw-semibold text-dark">
                                        {{ $company->name }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="badge text-bg-info">
                                    {{ $company->country ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <span class="text-secondary small">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $company->timezone ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                @if($company->plan)
                                    <span class="badge text-bg-success">
                                        <i class="fas fa-crown me-1"></i>
                                        {{ $company->plan->name }}
                                    </span>
                                @else
                                    <span class="badge text-bg-secondary">
                                        No Plan
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="text-dark small">
                                    {{ $company->created_at->format('M d, Y') }}
                                </span>
                            </td>

                            <td class="text-center pe-4">
                                <div class="d-inline-flex gap-1 td_action">

                                    <a href="{{ route('admin.companies.show', $company) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.companies.edit', $company) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.companies.destroy', $company) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this company?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                                <h6 class="fw-bold">No Companies Found</h6>
                                <p class="text-secondary small mb-3">
                                    Add your first company to get started.
                                </p>
                                <a href="{{ route('admin.companies.create') }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>
                                    Create Company
                                </a>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResults" class="d-none">
                        <td colspan="7"
                            class="text-center text-secondary py-4">
                            <i class="fas fa-search me-2"></i>
                            No matching companies found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($companies->hasPages() || $companies->count())
            <div class="card-footer bg-white border-0 p-3">
                <div class="d-flex flex-wrap justify-content-between
                            align-items-center gap-2">

                    <small class="text-secondary">
                        Showing {{ $companies->firstItem() ?? 0 }}
                        to {{ $companies->lastItem() ?? 0 }}
                        of {{ $companies->total() }} companies
                    </small>

                    {{ $companies->links() }}

                </div>
            </div>
        @endif

    </div>
</div>

{{-- Minimal JavaScript for Search --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('companySearch');
    const table = document.getElementById('companiesTable');

    if (!search || !table) return;

    const rows = [...table.querySelectorAll('tbody tr')]
        .filter(row => row.id !== 'noSearchResults');

    const noResults = document.getElementById('noSearchResults');

    search.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        let count = 0;

        rows.forEach(row => {
            const match = row.textContent.toLowerCase().includes(query);
            row.classList.toggle('d-none', !match);
            if (match) count++;
        });

        noResults?.classList.toggle('d-none', !query || count > 0);
    });
});
</script>


                
            </div>
        </div>
    </div>
</main>
           


    @include('admin.include.footer')