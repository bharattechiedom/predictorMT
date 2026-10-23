<?php
$page_title = "View Ticket";
?>
 @include('user.include.header')

<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3 bg-white rounded shadow-sm">
        <div class="row">

          <div class="card-header d-flex flex-wrap align-items-center gap-2 mb-3">
            <div class="flex-grow-1">
              <h4 class="header-title mb-0">View Ticket Details</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item"><a href="/analysis/index.php">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="/support/index.php">Support</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View Ticket</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="col-md-10 mx-auto">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="mb-3"><i class="bi bi-ticket-detailed me-2"></i> Ticket #SUP-1012</h5>
                <p><strong>Subject:</strong> Unable to login to dashboard</p>
                <p><strong>Category:</strong> Technical</p>
                <p><strong>Priority:</strong> <span class="badge bg-danger">High</span></p>
                <p><strong>Status:</strong> <span class="badge bg-warning text-dark">Open</span></p>
                <hr>
                <h6>Description:</h6>
                <p>The user is unable to log in to their account. The login page reloads without showing any error message. Issue started after the last system update.</p>
              </div>
            </div>

            <div class="card">
              <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-chat-left-text me-2"></i>Support Replies</h6>
              </div>
              <div class="card-body">
                <div class="border p-3 mb-2 rounded bg-light">
                  <strong>Support Team:</strong>
                  <p>Please clear your browser cache and try again. If the problem persists, let us know your browser version.</p>
                  <small class="text-white">27 Oct 2025, 12:45 PM</small>
                </div>

                <div class="border p-3 rounded">
                  <strong>You:</strong>
                  <p>I tried clearing cache, still unable to log in.</p>
                  <small class="text-white">27 Oct 2025, 1:10 PM</small>
                </div>

                <form class="mt-4">
                  <div class="mb-3">
                    <label class="form-label">Your Reply</label>
                    <textarea rows="4" class="form-control" placeholder="Type your response..."></textarea>
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">
                      <i class="bi bi-send me-1"></i>Send Reply
                    </button>
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