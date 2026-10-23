<?php
$page_title = "Create New Ticket";
?>

@include('user.include.header')
<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3 bg-white rounded shadow-sm">
        <div class="row">
          <div class="card-header d-flex flex-wrap align-items-center gap-2 mb-3">
            <div class="flex-grow-1">
              <h4 class="header-title mb-0">Create New Ticket</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="/support/index.php">Support</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Create Ticket</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="col-md-8 mx-auto">
            <div class="card">
              <div class="card-body">
                <form>
                  <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" placeholder="Enter issue subject">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select">
                      <option selected disabled>Select Category</option>
                      <option>Technical</option>
                      <option>Billing</option>
                      <option>Account</option>
                      <option>Other</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Priority</label>
                    <select class="form-select">
                      <option selected disabled>Select Priority</option>
                      <option>Low</option>
                      <option>Medium</option>
                      <option>High</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea rows="5" class="form-control" placeholder="Describe your issue..."></textarea>
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-send me-1"></i>Submit Ticket</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</body>

@include('user.include.footer')