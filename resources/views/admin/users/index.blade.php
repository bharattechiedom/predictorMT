@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">

            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}

                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Users List Card --}}
                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Page Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                                        <i class="fas fa-users fa-lg"></i>
                                    </div>

                                    <div>
                                        <h4 class="mb-1 fw-bold">Users Management</h4>
                                        <p class="text-muted mb-0 small">
                                            Manage all registered users and their company access.
                                        </p>
                                    </div>
                                </div>


                                
                                    <div class="d-flex align-items-center col-5">
                                        <div class="input-group search-input-group me-3">
                                                        <span class="input-group-text bg-white border-end-0">
                                                            <i class="fas fa-search text-muted"></i>
                                                        </span>

                                                        <input type="text"
                                                            id="userSearch"
                                                            class="form-control border-start-0 ps-0"
                                                            placeholder="Search by name, email, role, company or phone...">
                                                    </div>
                                                    <a href="{{ route('admin.users.create') }}" class="btn theme-btn btn-flex-none"><i class="fas fa-plus me-2"></i>Add User </a>
                                    </div>
                         
                                

                               

                            </div>
                        </div>

                        {{-- Search Bar --}}
                        

                        {{-- Users Table --}}
                        <div class="table-responsive list_Table">
                            <table class="table table-hover align-middle mb-0" id="usersTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Company</th>
                                        <th>Phone</th>
                                        <th>Created</th>
                                        <th class="text-center pe-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="ps-4 text-muted">
                                                #{{ $user->id }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                                        style="width: 38px; height: 38px;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>

                                                    <span class="fw-semibold">
                                                        {{ $user->name }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="text-break">
                                                    {{ $user->email }}
                                                </span>
                                            </td>

                                            <td>
                                                @php
                                                    $roleColors = [
                                                        'superadmin' => 'danger',
                                                        'admin' => 'warning',
                                                        'manager' => 'info',
                                                        'technician' => 'primary',
                                                        'viewer' => 'secondary',
                                                    ];
                                                @endphp

                                                <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($user->company)
                                                    <span class="badge bg-info bg-opacity-10 text-info-emphasis">
                                                        {{ $user->company->name }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                        No Company
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $user->phone ?? 'N/A' }}
                                            </td>

                                            <td class="text-nowrap">
                                                {{ $user->created_at->format('M d, Y') }}
                                            </td>

                                            <td class="text-center pe-4 text-nowrap">
                                                <div class="d-inline-flex align-items-center gap-1 td_action">
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-2"
                                                    title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    class="btn btn-sm btn-outline-warning rounded-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('admin.users.destroy', $user) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-2"
                                                        title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="noUsersFound">
                                            <td colspan="8" class="text-center py-5">
                                                <div class="mb-3">
                                                    <i class="fas fa-users fa-3x text-muted"></i>
                                                </div>

                                                <h6 class="fw-semibold">No users found</h6>

                                                <p class="text-muted mb-3">
                                                    Get started by creating your first user.
                                                </p>

                                                <a href="{{ route('admin.users.create') }}"
                                                    class="btn btn-primary btn-sm rounded-3">
                                                    <i class="fas fa-plus me-1"></i>Create User
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse

                                    {{-- Search Empty State --}}
                                    @if ($users->count())
                                        <tr id="noSearchResults" class="d-none">
                                            <td colspan="8" class="text-center py-4">
                                                <i class="fas fa-search fa-2x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">
                                                    No users match your search.
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($users->hasPages() || $users->count())
                            <div class="card-footer bg-white border-0 px-4 py-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                    <p class="text-muted small mb-0">
                                        Showing
                                        {{ $users->firstItem() ?? 0 }}
                                        to
                                        {{ $users->lastItem() ?? 0 }}
                                        of
                                        {{ $users->total() }}
                                        users
                                    </p>

                                    <div>
                                        {{ $users->links() }}
                                    </div>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- Client-side Table Search --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('userSearch');
        const table = document.getElementById('usersTable');

        if (!searchInput || !table) {
            return;
        }

        const rows = table.querySelectorAll('tbody tr:not(#noSearchResults)');
        const noSearchResults = document.getElementById('noSearchResults');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(function (row) {
                // Keep the original empty-state row visible when there are no records.
                if (row.id === 'noUsersFound') {
                    return;
                }

                const rowText = row.textContent.toLowerCase();
                const matches = rowText.includes(searchTerm);

                row.classList.toggle('d-none', !matches);

                if (matches) {
                    visibleCount++;
                }
            });

            if (noSearchResults) {
                noSearchResults.classList.toggle(
                    'd-none',
                    searchTerm === '' || visibleCount > 0
                );
            }
        });
    });
</script>

@include('admin.include.footer')
