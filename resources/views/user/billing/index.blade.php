<?php
$page_title = "Billing";
?>
 @include('user.include.header')

<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3 bg-white rounded shadow-sm">
        <div class="row">

            <!-- ======================= PAGE HEADER ======================= -->
          <div class="card-header d-flex flex-wrap align-items-center gap-2 mb-3">
            <div class="flex-grow-1">
              <h4 class="header-title mb-0">Billing - Plan, Usage, Invoices, Payment</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Billing</li>
                </ol>
              </nav>
            </div>
          </div>

          <!-- ======================= FILTERS ======================= -->
          <div class="container-fluid mt-3 mb-4">
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-12">
                <div class="row g-3">
                  <div class="col-lg-3 col-md-6">
                    <input type="text" class="form-control" placeholder="Invoice ID">
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <input type="date" class="form-control">
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <select class="form-select">
                      <option selected="">Select Plan</option>
                      <option>Basic</option>
                      <option>Pro</option>
                      <option>Enterprise</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- ======================= MAIN CONTENT ======================= -->
          <div class="col-md-12">

            <!-- 1️⃣ Subscription Plan -->
            <div class="card mb-4 border-0 shadow-sm">
              <div class="card-header bg-light border-bottom">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Subscription Plan</h5>
              </div>
              <div class="card-body">
                <p>Your current subscription details are as follows:</p>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped align-middle">
                    <tbody>
                      <tr>
                        <th>Plan Name</th>
                        <td>{{ $subscription?->plan?->name ?? 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Started</th>
                        <td>{{ $subscription?->started_at?->format('M d, Y') ?? 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Ended</th>
                        <td>{{ $subscription?->ended_at?->format('M d, Y') ?? 'N/A' }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td><span class="badge bg-{{ $subscription?->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($subscription?->status ?? 'N/A') }}</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <span class="btn btn-dark mt-3 disabled" aria-disabled="true"><i class="bi bi-pencil-square me-1"></i> Manage Subscription</span>
              </div>
            </div>

            <!-- 2️⃣ Usage Summary -->
            <div class="card mb-4 border-0 shadow-sm">
              <div class="card-header bg-light border-bottom">
                <h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Usage Summary</h5>
              </div>
              <div class="card-body">
                <p>Overview of your resource consumption for this month:</p>
                <ul class="list-group">
                  <li class="list-group-item">🏭 <strong>Machines:</strong> {{ $usage['machines'] }}{{ $subscription?->plan?->machines_included ? ' / ' . $subscription->plan->machines_included : '' }}</li>
                  <li class="list-group-item">📡 <strong>Sensors:</strong> {{ $usage['sensors'] }}</li>
                  <li class="list-group-item">📊 <strong>Readings this month:</strong> {{ number_format($usage['readings']) }}</li>
                  <li class="list-group-item">📨 <strong>Alerts this month:</strong> {{ number_format($usage['alerts']) }}</li>
                </ul>
                <span class="btn btn-outline-dark mt-3 disabled" aria-disabled="true"><i class="bi bi-graph-up me-1"></i> View Detailed Usage</span>
              </div>
            </div>

            <!-- 3️⃣ Invoices -->
            <div class="card mb-4 border-0 shadow-sm">
              <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Invoices</h5>
                <a href="{{ route('user.billing.index') }}" class="btn btn-sm btn-outline-secondary">Refresh</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover align-middle table-bordered">
                    <thead class="table-light">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($invoices as $invoice)
                      <tr>
                        <td>INV-{{ $invoice->id }}</td>
                        <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                        <td>${{ number_format($invoice->amount, 2) }}</td>
                        <td><span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status=='pending'?'warning text-dark':'danger') }}">{{ ucfirst($invoice->status) }}</span></td>
                        <td>
                          <a href="{{ route('user.billing.show', $invoice) }}" class="btn btn-sm btn-outline-primary me-1">View</a>
                          <span class="btn btn-sm btn-outline-secondary disabled" aria-disabled="true">PDF unavailable</span>
                        </td>
                      </tr>
                      @empty
                      <tr><td colspan="5" class="text-center">No invoices found</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- 4️⃣ Payment Methods -->
            <div class="card mb-4 border-0 shadow-sm">
              <div class="card-header bg-light border-bottom">
                <h5 class="mb-0"><i class="bi bi-credit-card-2-front me-2"></i>Payment Methods</h5>
              </div>
              <div class="card-body">
                <p class="mb-0">No saved payment method is available in this account.</p>
              </div>
            </div>

          </div> <!-- /col-md-12 -->

        </div> <!-- /row -->
      </div> <!-- /page-container -->
    </div> <!-- /page-content -->
  </div> <!-- /wrapper -->

  
</body>
@include('user.include.footer')
