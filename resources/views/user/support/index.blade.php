<?php
$page_title = "Support";
?>
 @include('user.include.header')

<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3 bg-white rounded shadow-sm">
        <div class="row">

          <!-- Header -->
          <div class="card-header d-flex flex-wrap align-items-center gap-2 mb-3">
            <div class="flex-grow-1">
              <h4 class="header-title mb-0">Support - Tickets, Documentation</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Support</li>
                </ol>
              </nav>
            </div>
          </div>

          <!-- Filters Row -->
          <div class="container-fluid mt-3 mb-4">
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-12">
                <div class="row g-3">
                  <div class="col-lg-4 col-md-6">
                    <input type="text" class="form-control" placeholder="Search Ticket ID">
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <select class="form-select">
                      <option selected="">Select Category</option>
                      <option>Technical</option>
                      <option>Billing</option>
                      <option>Account</option>
                      <option>Other</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Main Content -->
          <div class="col-md-12">

            <!-- 1. Tickets -->
            <div class="card mb-3">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-ticket-detailed me-2"></i>Tickets</h5>
                <a href="{{ route('user.support.create') }}" class="btn btn-dark btn-sm">
                  <i class="bi bi-plus-circle me-1"></i> Create New Ticket
                </a>
              </div>
              <div class="card-body">
                <table class="table table-striped align-middle">
                  <thead>
                    <tr>
                      <th>Ticket ID</th>
                      <th>Subject</th>
                      <th>Status</th>
                      <th>Priority</th>
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                      <td>#SUP-{{ $ticket->id }}</td>
                      <td>{{ $ticket->subject }}</td>
                      <td><span class="badge bg-{{ $ticket->status == 'open' ? 'warning text-dark' : ($ticket->status=='resolved'?'success':'secondary') }}">{{ ucfirst($ticket->status) }}</span></td>
                      <td><span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority=='medium'?'warning text-dark':'secondary') }}">{{ ucfirst($ticket->priority ?? 'medium') }}</span></td>
                      <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                      <td>
                        <a href="{{ route('user.support.show', $ticket) }}" class="btn btn-outline-dark btn-sm">
                          <i class="bi bi-eye me-1"></i> View
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center">No tickets found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 2. Documentation -->
            <div class="card mb-3">
              <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Documentation</h5>
              </div>
              <div class="card-body">
                <p class="text-white mb-2">Browse our guides and FAQs to resolve common issues:</p>
                <ul class="list-unstyled mb-0">
                  <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-file-earmark-text me-2"></i>How to reset your password</a></li>
                  <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-file-earmark-text me-2"></i>Understanding billing and invoices</a></li>
                  <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-file-earmark-text me-2"></i>Integrating APIs securely</a></li>
                  <li><a href="#" class="text-decoration-none text-white"><i class="bi bi-file-earmark-text me-2"></i>How to update your profile</a></li>
                </ul>
              </div>
            </div>

          </div> <!-- /col-md-12 -->

        </div> <!-- /row -->
      </div> <!-- /page-container -->
    </div> <!-- /page-content -->
  </div> <!-- /wrapper -->

 
</body>

@include('user.include.footer')