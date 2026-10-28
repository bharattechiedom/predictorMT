
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
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <div>
                                    <h4 class="fw-bold mb-1">Invoices</h4>
                                    <p class="text-muted mb-0">
                                        Manage company invoices, billing periods and payment statuses.
                                    </p>
                                </div>

                                <a href="{{ route('admin.invoices.create') }}"
                                   class="btn theme-btn">
                                    <i class="fas fa-plus me-2"></i>Add Invoice
                                </a>
                            </div>
                        </div>

                        {{-- Search --}}
                        <div class="card-body bg-light border-top border-bottom p-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-md-6 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text"
                                               id="invoiceSearch"
                                               class="form-control"
                                               placeholder="Search company, amount, status...">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-7 text-md-end">
                                    <span class="text-muted small">
                                        Total Invoices: {{ $invoices->total() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Invoices Table --}}
                        <div class="table-responsive list_Table">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th>Company</th>
                                        <th>Amount</th>
                                        <th>Billing Period</th>
                                        <th>Status</th>
                                        <th class="text-center pe-4">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="invoiceTableBody">
                                    @forelse($invoices as $invoice)
                                        @php
                                            $status = strtolower(str_replace(
                                                ['_', '-'],
                                                ' ',
                                                $invoice->status ?? ''
                                            ));

                                            $statusClass = match($status) {
                                                'paid' => 'text-bg-success',
                                                'pending' => 'text-bg-warning',
                                                'overdue', 'unpaid', 'failed' => 'text-bg-danger',
                                                'draft' => 'text-bg-secondary',
                                                'sent' => 'text-bg-info',
                                                default => 'text-bg-secondary',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="ps-4 fw-semibold">
                                                {{ $invoice->id }}
                                            </td>

                                            <td>
                                                <span class="fw-semibold">
                                                    {{ optional($invoice->company)->name ?? 'N/A' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="fw-semibold text-nowrap">
                                                    {{ number_format((float) $invoice->amount, 2) }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="small text-nowrap">
                                                    <div>
                                                        <i class="far fa-calendar-alt text-muted me-1"></i>
                                                        {{ optional($invoice->billing_period_start)->format('d M Y') ?? 'N/A' }}
                                                    </div>
                                                    <div class="text-muted mt-1">
                                                        <i class="fas fa-arrow-right me-1"></i>
                                                        {{ optional($invoice->billing_period_end)->format('d M Y') ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge rounded-pill {{ $statusClass }}">
                                                    {{ $invoice->status
                                                        ? ucwords(str_replace(['_', '-'], ' ', $invoice->status))
                                                        : 'N/A' }}
                                                </span>
                                            </td>

                                            <td class="pe-4">
                                                <div class="d-flex justify-content-center align-items-center gap-2 td_action">
                                                    <a href="{{ route('admin.invoices.show', $invoice) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="View Invoice"
                                                       aria-label="View Invoice">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.invoices.edit', $invoice) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Edit Invoice"
                                                       aria-label="Edit Invoice">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.invoices.destroy', $invoice) }}"
                                                          method="POST"
                                                          class="m-0"
                                                          onsubmit="return confirm('Delete this invoice?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                title="Delete Invoice"
                                                                aria-label="Delete Invoice">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="invoiceEmptyRow">
                                            <td colspan="6" class="text-center py-5">
                                                <i class="fas fa-file-invoice-dollar fa-2x text-muted mb-3"></i>
                                                <h6 class="fw-semibold">No invoices found</h6>
                                                <p class="text-muted mb-0">
                                                    Create an invoice to see it listed here.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse

                                    <tr id="invoiceNoResults" style="display: none;">
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            No matching invoices found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($invoices->hasPages())
                            <div class="card-footer bg-white border-0 p-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                    <small class="text-muted">
                                        Showing {{ $invoices->firstItem() ?? 0 }}
                                        to {{ $invoices->lastItem() ?? 0 }}
                                        of {{ $invoices->total() }} invoices
                                    </small>

                                    <div>
                                        {{ $invoices->links() }}
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
        const searchInput = document.getElementById('invoiceSearch');
        const tableBody = document.getElementById('invoiceTableBody');
        const noResults = document.getElementById('invoiceNoResults');

        if (!searchInput || !tableBody) return;

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = tableBody.querySelectorAll('tr:not(#invoiceNoResults)');
            let visibleCount = 0;

            rows.forEach(function (row) {
                const matches = row.textContent.toLowerCase().includes(query);

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
