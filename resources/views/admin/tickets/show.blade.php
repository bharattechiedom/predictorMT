
@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-md-4">

                    {{-- Page Header --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Ticket Details</h4>
                            <p class="text-muted mb-0">
                                View support ticket information and current status.
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.tickets.edit', $ticket) }}"
                               class="btn theme-btn">
                                <i class="fas fa-edit me-1"></i> Edit Ticket
                            </a>

                            <a href="{{ route('admin.tickets.index') }}"
                               class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    @php
                        $status = strtolower($ticket->status ?? '');
                        $statusClass = [
                            'open' => 'primary',
                            'pending' => 'warning',
                            'resolved' => 'success',
                            'closed' => 'secondary',
                        ][$status] ?? 'secondary';

                        $priority = strtolower($ticket->priority ?? '');
                        $priorityClass = [
                            'low' => 'success',
                            'medium' => 'warning',
                            'high' => 'danger',
                        ][$priority] ?? 'secondary';
                    @endphp

                    <div class="row g-4">

                        {{-- Ticket Summary --}}
                        <div class="col-12 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h5 class="fw-bold mb-0">Ticket Summary</h5>

                                        <span class="bg-light text-primary rounded-3 p-3">
                                            <i class="fas fa-ticket-alt fa-lg"></i>
                                        </span>
                                    </div>

                                    <p class="text-muted small mb-1">Ticket ID</p>
                                    <h3 class="fw-bold mb-4">#{{ $ticket->id }}</h3>

                                    <p class="text-muted small mb-2">Current Status</p>
                                    <div class="mb-4">
                                        <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill px-3 py-2">
                                            {{ ucfirst($ticket->status ?? 'N/A') }}
                                        </span>
                                    </div>

                                    <p class="text-muted small mb-2">Priority</p>
                                    <div class="mb-4">
                                        <span class="badge bg-{{ $priorityClass }}-subtle text-{{ $priorityClass }} rounded-pill px-3 py-2">
                                            {{ ucfirst($ticket->priority ?? 'N/A') }}
                                        </span>
                                    </div>

                                    <hr>

                                    <p class="text-muted small mb-1">Subject</p>
                                    <h6 class="fw-semibold mb-0 text-break">
                                        {{ $ticket->subject }}
                                    </h6>
                                </div>
                            </div>
                        </div>

                        {{-- Ticket Information --}}
                        <div class="col-12 col-lg-8">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header bg-white border-0 p-4">
                                    <h5 class="fw-bold mb-1">Ticket Information</h5>
                                    <p class="text-muted small mb-0">
                                        Company, user and issue details.
                                    </p>
                                </div>

                                <div class="card-body p-4 border-top">
                                    <div class="row g-4">

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light text-primary rounded-3 p-3">
                                                    <i class="fas fa-building"></i>
                                                </span>

                                                <div>
                                                    <p class="text-muted small mb-1">Company</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($ticket->company)->name ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light text-primary rounded-3 p-3">
                                                    <i class="fas fa-user"></i>
                                                </span>

                                                <div>
                                                    <p class="text-muted small mb-1">User</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($ticket->user)->name ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="my-0">
                                        </div>

                                        <div class="col-12">
                                            <p class="text-muted small mb-2">Description</p>

                                            <div class="bg-light rounded-3 p-3">
                                                <p class="mb-0 text-break" style="white-space: pre-wrap;">{{ $ticket->description ?: 'No description provided.' }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="my-0">
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light text-primary rounded-3 p-3">
                                                    <i class="fas fa-calendar-plus"></i>
                                                </span>

                                                <div>
                                                    <p class="text-muted small mb-1">Created</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($ticket->created_at)->toDayDateTimeString() ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex align-items-start gap-3">
                                                <span class="bg-light text-primary rounded-3 p-3">
                                                    <i class="fas fa-calendar-check"></i>
                                                </span>

                                                <div>
                                                    <p class="text-muted small mb-1">Last Updated</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ optional($ticket->updated_at)->toDayDateTimeString() ?? 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
