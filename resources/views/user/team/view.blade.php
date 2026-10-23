<?php
$page_title = "View Team Member";
?>
 @include('user.include.header')

<body>
  <div class="wrapper active">
    <div class="page-content">
      <div class="page-container p-3">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card p-4 shadow-sm">

              <!-- Header -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i> Team Member Details</h4>
                <a href="index.php" class="btn btn-outline-dark btn-sm">
                  <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
              </div>
              <hr>

              <!-- Profile Info -->
              <div class="row mb-3">
                <div class="col-md-4 text-center">
                  <img src="../assets/images/avatar.png" alt="Profile" class="rounded-circle mb-3" width="120">
                  <h5 class="mb-1">Pankaj Kumar</h5>
                  <p class="text-muted mb-0">Manager</p>
                </div>
                <div class="col-md-8">
                  <table class="table table-borderless mb-0">
                    <tr>
                      <th width="35%">Email:</th>
                      <td>pankaj@example.com</td>
                    </tr>
                    <tr>
                      <th>Role:</th>
                      <td>Manager</td>
                    </tr>
                    <tr>
                      <th>Status:</th>
                      <td><span class="badge bg-success">Active</span></td>
                    </tr>
                    <tr>
                      <th>Date Joined:</th>
                      <td>15 May 2024</td>
                    </tr>
                    <tr>
                      <th>Last Login:</th>
                      <td>27 Oct 2025, 09:42 AM</td>
                    </tr>
                  </table>
                </div>
              </div>

              <hr>

              <!-- Permissions Section -->
              <h5 class="mt-3"><i class="bi bi-shield-lock me-2"></i> Permissions</h5>
              <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  View Data <span class="badge bg-success">Allowed</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Edit Data <span class="badge bg-success">Allowed</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Delete Data <span class="badge bg-danger">Denied</span>
                </li>
              </ul>

              <!-- Action Buttons -->
              <div class="d-flex justify-content-end">
                <a href="edit.php me-1" class="btn btn-dark me-2">
                  <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <button class="btn btn-outline-danger text-white me-1">
                  <i class="bi bi-trash me-1"></i> Delete
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

@include('user.include.footer')