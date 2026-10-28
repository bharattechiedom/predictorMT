
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card border-0 shadow-sm rounded-4">

                        {{-- Page Header --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <div>
                                    <h4 class="mb-1 fw-bold">Subscriptions</h4>
                                    <p class="text-muted mb-0">
                                        Manage company subscriptions and their plans.
                                    </p>
                                </div>

                                <a href="{{ route('admin.subscriptions.create') }}"
                                   class="btn theme-btn">
                                    <i class="fas fa-plus me-2"></i>Add Subscription
                                </a>
                            </div>
                        </div>

                        

                        {{-- Subscriptions Table --}}
                        <div class="table-responsive list_Table">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th>Company</th>
                                        <th>Plan</th>
                                        <th>Status</th>
                                        <th>Started</th>
                                        <th>Ended</th>
                                        <th class="text-center pe-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="subscriptionTableBody">
                                    @forelse($subscriptions as $subscription)
                                        @php
                                            $status = strtolower(str_replace(
                                                ['_', '-'],
                                                ' ',
                                                $subscription->status ?? ''
                                            ));

                                            $statusClass = match($status) {
                                                'active' => 'text-bg-success',
                                                'trial', 'trialing' => 'text-bg-info',
                                                'pending' => 'text-bg-warning',
                                                'cancelled', 'canceled', 'expired' => 'text-bg-danger',
                                                default => 'text-bg-secondary',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="ps-4 fw-semibold">
                                                {{ $subscription->id }}
                                            </td>

                                            <td>
                                                <div class="fw-semibold">
                                                    {{ optional($subscription->company)->name ?? 'N/A' }}
                                                </div>
                                            </td>

                                            <td>
                                                <span class="fw-medium">
                                                    {{ optional($subscription->plan)->name ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge rounded-pill {{ $statusClass }}">
                                                    {{ $subscription->status
                                                        ? ucwords(str_replace(['_', '-'], ' ', $subscription->status))
                                                        : 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="text-nowrap">
                                                    {{ optional($subscription->started_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="text-nowrap">
                                                    {{ optional($subscription->ended_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td class="pe-4">
                                                <div class="d-flex justify-content-center align-items-center gap-2 td_action">
                                                    <a href="{{ route('admin.subscriptions.show', $subscription) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="View Subscription"
                                                       aria-label="View Subscription">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.subscriptions.edit', $subscription) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Edit Subscription"
                                                       aria-label="Edit Subscription">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.subscriptions.destroy', $subscription) }}"
                                                          method="POST"
                                                          class="m-0"
                                                          onsubmit="return confirm('Delete this subscription?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Delete Subscription"
                                                                aria-label="Delete Subscription">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-receipt fa-2x text-muted mb-3"></i>
                                                <h6 class="fw-semibold">No subscriptions found</h6>
                                                <p class="text-muted mb-0">
                                                    Add a subscription to see it listed here.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <tr id="subscriptionNoResults" style="display: none;">
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            No matching subscriptions found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($subscriptions->hasPages())
                            <div class="card-footer bg-white border-0 p-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                    <small class="text-muted">
                                        Showing {{ $subscriptions->firstItem() ?? 0 }}
                                        to {{ $subscriptions->lastItem() ?? 0 }}
                                        of {{ $subscriptions->total() }} subscriptions
                                    </small>

                                    <div>
                                        {{ $subscriptions->links() }}
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('subscriptionSearch');
        const tableBody = document.getElementById('subscriptionTableBody');
        const noResults = document.getElementById('subscriptionNoResults');

        if (!searchInput || !tableBody) return;

        searchInput.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr:not(#subscriptionNoResults)');
            let visibleCount = 0;

            rows.forEach(function (row) {
                const matches = row.textContent.toLowerCase().includes(searchValue);

                row.style.display = matches ? '' : 'none';

                if (matches) {
                    visibleCount++;
                }
            });

            if (noResults) {
                noResults.style.display =
                    visibleCount === 0 && rows.length > 0 ? '' : 'none';
            }
        });
    });
</script>

@include('admin.include.footer')
