
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

                    {{-- Tickets Table --}}
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-3 p-md-4 d-flex align-items-center gap-2 justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-light text-primary rounded-3 p-2">
                                    <i class="fas fa-ticket-alt"></i>
                                </span>
                                <div>
                                    <h5 class="fw-bold mb-1">All Tickets</h5>
                                    <p class="text-muted small mb-0">
                                       Manage and track company support tickets.
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.tickets.create') }}" class="btn theme-btn">
                            <i class="fas fa-plus me-2"></i>Add Ticket
                        </a>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3 py-3">#</th>
                                            <th class="py-3">Company</th>
                                            <th class="py-3">User</th>
                                            <th class="py-3">Subject</th>
                                            <th class="py-3">Status</th>
                                            <th class="py-3">Priority</th>
                                            <th class="text-center px-3 py-3">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($tickets as $ticket)
                                            @php
                                                $status = strtolower($ticket->status ?? '');
                                                $statusClass = [
                                                    'open' => 'primary',
                                                    'in_progress' => 'info',
                                                    'in progress' => 'info',
                                                    'pending' => 'warning',
                                                    'resolved' => 'success',
                                                    'closed' => 'secondary',
                                                ][$status] ?? 'secondary';

                                                $priority = strtolower($ticket->priority ?? '');
                                                $priorityClass = [
                                                    'low' => 'success',
                                                    'medium' => 'warning',
                                                    'high' => 'danger',
                                                    'urgent' => 'danger',
                                                ][$priority] ?? 'secondary';
                                            @endphp

                                            <tr>
                                                <td class="px-3 fw-semibold">
                                                    {{ $ticket->id }}
                                                </td>

                                                <td>
                                                    {{ optional($ticket->company)->name ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    {{ optional($ticket->user)->name ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    <span class="fw-semibold">
                                                        {{ $ticket->subject }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill px-3 py-2">
                                                        {{ ucfirst(str_replace('_', ' ', $ticket->status ?? 'N/A')) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="badge bg-{{ $priorityClass }}-subtle text-{{ $priorityClass }} rounded-pill px-3 py-2">
                                                        {{ ucfirst($ticket->priority ?? 'N/A') }}
                                                    </span>
                                                </td>

                                                <td class="px-3">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                                        <a href="{{ route('admin.tickets.show', $ticket) }}"
                                                           class="btn btn-sm btn-outline-primary"
                                                           title="View Ticket"
                                                           aria-label="View Ticket">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.tickets.edit', $ticket) }}"
                                                           class="btn btn-sm btn-outline-warning"
                                                           title="Edit Ticket"
                                                           aria-label="Edit Ticket">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('admin.tickets.destroy', $ticket) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Delete this ticket?');">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    title="Delete Ticket"
                                                                    aria-label="Delete Ticket">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <i class="fas fa-ticket-alt fa-2x text-muted mb-3"></i>
                                                    <h6 class="fw-semibold">No Tickets Found</h6>
                                                    <p class="text-muted small mb-0">
                                                        There are no tickets to display yet.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if($tickets->hasPages())
                            <div class="card-footer bg-white border-0 p-3">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
