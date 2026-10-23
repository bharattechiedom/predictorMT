<?php
$page_title = "Team Management";
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
              <h4 class="header-title mb-0">Team - Role Management, Permissions</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Team Management</li>
                </ol>
              </nav>
            </div>
            <div>
              <a href="add.php" class="btn btn-dark">
                <i class="bi bi-person-plus me-1"></i> Add New Member
              </a>
            </div>
          </div>

            <!-- Team members -->
            <div class="card mb-3">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Team Members</h5>
                <a href="{{ route('user.team.create') }}" class="btn btn-dark btn-sm">
                  <i class="bi bi-person-plus me-1"></i> Add Member
                </a>
              </div>
              <div class="card-body">
                <div class="row g-3">
                  @forelse($users as $member)
                  <div class="col-md-4">
                    <div class="d-flex align-items-center">
                      <img src="{{ $member->avatar_url ?? asset('assets/img/avatars/default.png') }}" alt="" class="avatar me-3">
                      <div>
                        <div class="fw-bold">{{ $member->name }}</div>
                        <div class="text-muted">{{ ucfirst($member->role ?? 'member') }}</div>
                        <div class="mt-1">
                          <a href="{{ route('user.team.show', $member) }}" class="btn btn-sm btn-outline-dark">View</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <div class="col-12">
                    <p class="text-center mb-0">No team members found.</p>
                  </div>
                  @endforelse
                </div>
                <div class="mt-3">
                  {{ $users->links() ?? '' }}
                </div>
              </div>
            </div>
                        <td>Priya Verma</td>
                        <td>priya@predictormt.com</td>
                        <td><span class="badge bg-secondary">Manager</span></td>
                        <td>Manage Reports, Assign Tasks</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
 <a href="edit.php">
                          <button class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></button>
                          </a>                         
                           <a href="view.php">
                          <button class="btn btn-sm btn-outline-dark"><i class="bi bi-eye"></i></button>
                          </a>
                           <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Amit Patel</td>
                        <td>amit@predictormt.com</td>
                        <td><span class="badge bg-info text-dark">Technician</span></td>
                        <td>Update Logs, Execute Tasks</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
 <a href="edit.php">
                          <button class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></button>
                          </a>             
                           <a href="view.php">
                          <button class="btn btn-sm btn-outline-dark"><i class="bi bi-eye"></i></button>
                          </a>
                                       <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Role Permissions Section -->
          <div class="col-md-12 mt-4">
            <div class="card border-0 shadow-sm">
              <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Role-Based Permissions</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <h6 class="fw-bold">Admin</h6>
                    <ul class="list-unstyled">
                      <li>✔ Full Access</li>
                      <li>✔ Add/Remove Members</li>
                      <li>✔ Change Permissions</li>
                      <li>✔ View All Reports</li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <h6 class="fw-bold">Manager</h6>
                    <ul class="list-unstyled">
                      <li>✔ Assign & Review Tasks</li>
                      <li>✔ Manage Project Timelines</li>
                      <li>❌ Cannot Delete Admins</li>
                      <li>✔ Generate Reports</li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <h6 class="fw-bold">Technician</h6>
                    <ul class="list-unstyled">
                      <li>✔ Update Logs</li>
                      <li>✔ Execute Maintenance Tasks</li>
                      <li>❌ Cannot Manage Users</li>
                      <li>❌ Cannot Access Billing</li>
                    </ul>
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
