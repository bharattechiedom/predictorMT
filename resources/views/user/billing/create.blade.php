<?php
$page_title = "Add Payment Method";
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
              <h4 class="header-title mb-0">Add New Payment Method</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/billing/index.php">Billing</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Add Payment Method</li>
                </ol>
              </nav>
            </div>
            <div>
              <a href="index.php" class="btn btn-outline-dark btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back
              </a>
            </div>
          </div>

          <!-- Payment Form -->
          <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm p-4">
              <h5 class="mb-3"><i class="bi bi-credit-card-2-front me-2"></i>Enter Payment Details</h5>
              <form>
                <div class="mb-3">
                  <label class="form-label">Cardholder Name</label>
                  <input type="text" class="form-control" placeholder="Enter cardholder name">
                </div>

                <div class="mb-3">
                  <label class="form-label">Card Number</label>
                  <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" placeholder="MM/YY">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">CVV</label>
                    <input type="password" class="form-control" placeholder="•••">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Billing Address</label>
                  <input type="text" class="form-control" placeholder="123 Main Street, City, Country">
                </div>

                <div class="mb-3">
                  <label class="form-label">Payment Type</label>
                  <select class="form-select">
                    <option selected>Select Type</option>
                    <option>Credit Card</option>
                    <option>Debit Card</option>
                    <option>UPI</option>
                    <option>PayPal</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-dark w-100">
                  <i class="bi bi-save me-1"></i> Save Payment Method
                </button>
              </form>
            </div>
          </div>

        </div> <!-- /row -->
      </div> <!-- /page-container -->
    </div> <!-- /page-content -->
  </div> <!-- /wrapper -->

 
</body>
@include('user.include.footer')
