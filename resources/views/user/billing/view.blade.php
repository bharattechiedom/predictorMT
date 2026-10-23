<?php
$page_title = "Invoice Details";
?>
 @include('user.include.header')

<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3 bg-white rounded shadow-sm">
        <div class="row">

          <!-- ======================= PAGE HEADER ======================= -->
          <div class="card-header d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
              <h4 class="header-title mb-0">Invoice Details</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item"><a href="index.php">Billing</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Invoice #INV-2025-001</li>
                </ol>
              </nav>
            </div>
            <div>
              <a href="index.php" class="btn btn-outline-dark me-2"><i class="bi bi-arrow-left me-1"></i> Back</a>
              <button class="btn btn-dark"><i class="bi bi-download me-1"></i> Download PDF</button>
            </div>
          </div>

          <!-- ======================= INVOICE CARD ======================= -->
          <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                  <!-- Company & Client Info -->
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <h5 class="fw-bold mb-2">From:</h5>
                      <p class="mb-0">Tech Solutions Pvt. Ltd.<br>
                        123, Business Park,<br>
                        Delhi, India<br>
                        <strong>Email:</strong> billing@predictorMt.com
                      </p>
                    </div>
                    <div class="col-md-6 text-md-end mt-4 mt-md-0">
                      <h5 class="fw-bold mb-2">Billed To:</h5>
                      <p class="mb-0">{{ $invoice->company?->name ?? 'Client' }}<br>
                        {{ $invoice->company?->country ?? '' }}<br>
                        <strong>Email:</strong> {{ $invoice->company?->email ?? 'N/A' }}
                      </p>
                    </div>
                  </div>

                  <!-- Invoice Info -->
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <p><strong>Invoice ID:</strong> INV-{{ $invoice->id }}</p>
                    </div>
                    <div class="col-md-4">
                      <p><strong>Date Issued:</strong> {{ $invoice->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-4">
                      <p><strong>Status:</strong> <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status=='pending'?'warning text-dark':'danger') }}">{{ ucfirst($invoice->status) }}</span></p>
                    </div>
                  </div>

                  <!-- Table -->
                  <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                      <thead class="table-light">
                        <tr>
                          <th>Description</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $items = $invoice->lines ?? [];
                        @endphp
                        @forelse($items as $item)
                        <tr>
                          <td>{{ $item['description'] ?? 'Subscription' }}</td>
                          <td>{{ $item['quantity'] ?? 1 }}</td>
                          <td>${{ number_format($item['unit_price'] ?? $invoice->amount, 2) }}</td>
                          <td>${{ number_format(($item['quantity'] ?? 1) * ($item['unit_price'] ?? $invoice->amount), 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                          <td>Subscription</td>
                          <td>1</td>
                          <td>${{ number_format($invoice->amount,2) }}</td>
                          <td>${{ number_format($invoice->amount,2) }}</td>
                        </tr>
                        @endforelse
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-end">Subtotal</th>
                          <td>${{ number_format($invoice->amount, 2) }}</td>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-end">Tax</th>
                          <td>${{ number_format($invoice->tax ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-end">Total</th>
                          <td><strong>${{ number_format($invoice->amount + ($invoice->tax ?? 0), 2) }}</strong></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <!-- Payment Info -->
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="fw-bold">Payment Method:</h6>
                      <p>{{ $invoice->payment_method ?? 'N/A' }}<br>
                        Transaction ID: {{ $invoice->external_invoice_id ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <h6 class="fw-bold">Thank you for your business!</h6>
                      <p>If you have any questions, contact us at
                        <a href="mailto:billing@techsolutions.com" class="text-white">billing@predictorMt.com</a>.
                      </p>
                    </div>
                  </div>

                </div>
              </div>
          </div>

        </div> <!-- /row -->
      </div> <!-- /page-container -->
    </div> <!-- /page-content -->
  </div> <!-- /wrapper -->

 
</body>

@include('user.include.footer')
