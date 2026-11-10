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
              <h4 class="header-title mb-0">Team Members and Roles</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Team Management</li>
                </ol>
              </nav>
            </div>
          </div>

            <!-- Team members -->
            <div class="card mb-3">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Team Members</h5>
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

          <!-- Role Permissions Section -->
          <div class="col-md-12 mt-4">
            <div class="card border-0 shadow-sm">
              <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Role Distribution</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  @forelse($roleCounts as $role => $count)
                    <div class="col-md-4">
                      <h6 class="fw-bold">{{ ucfirst($role ?: 'Member') }}</h6>
                      <p class="mb-0 text-muted">{{ $count }} team {{ \Illuminate\Support\Str::plural('member', $count) }}</p>
                    </div>
                  @empty
                    <div class="col-12"><p class="text-muted mb-0">No team roles are available.</p></div>
                  @endforelse
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
