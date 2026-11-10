<?php
$page_title = "Alerts & Notifications";

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
              <h4 class="header-title mb-0">Notifications, Severity Levels, Acknowledgment</h4>
              <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb p-0">
                  <li class="breadcrumb-item">
                    <a href="/analysis/index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Alerts & Notifications</li>
                </ol>
              </nav>
            </div>
          </div>

          <!-- Filters -->
          <form method="GET" action="{{ route('user.alerts.index') }}">
          <div class="container-fluid mt-3 mb-4">
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-12">
                <div class="row g-3">
                  <div class="col-lg-4 col-md-6">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Alert ID or message">
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                  </div>
                  <div class="col-lg-4 col-md-6">
                    <select name="severity" class="form-select">
                      <option value="">All Severities</option>
                      @foreach(['critical' => 'Critical', 'warning' => 'Warning', 'info' => 'Info'] as $value => $label)
                        <option value="{{ $value }}" {{ request('severity') === $value ? 'selected' : '' }}>{{ $label }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-12"><button class="btn btn-outline-dark" type="submit">Apply Filters</button></div>
                </div>
              </div>
            </div>
          </div>
          </form>

          <!-- Notifications Section -->
          <div class="col-md-12">

            <!-- 1. Active Alerts -->
            <div class="card mb-3">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2 text-danger"></i>Active Alerts</h5>
                <a href="{{ route('user.alerts.index') }}" class="btn btn-sm btn-outline-secondary">Refresh</a>
              </div>
              <div class="card-body">
                @if($alerts->count())
                <ul class="list-group">
                  @foreach($alerts as $alert)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      <strong>#{{ $alert->id }}</strong> - {{ $alert->message }}
                      <div class="text-muted small">{{ $alert->created_at->diffForHumans() }} • {{ $alert->origin }}</div>
                    </div>
                    <div class="text-end">
                      <span class="badge bg-{{ $alert->level == 'critical' ? 'danger' : ($alert->level=='warning' ? 'warning text-dark' : 'info text-dark') }}">{{ ucfirst($alert->level) }}</span>
                      <div class="mt-2 d-flex gap-2 justify-content-end">
                        @if(!$alert->acknowledged_at)
                        <form method="POST" action="{{ route('user.alerts.acknowledge', $alert) }}">
                          @csrf
                          <button class="btn btn-sm btn-success">Acknowledge</button>
                        </form>
                        @else
                        <span class="small text-muted">Acknowledged {{ $alert->acknowledged_at->diffForHumans() }}</span>
                        @endif
                        <a href="{{ route('user.alerts.show', $alert) }}" class="btn btn-sm btn-outline-secondary">View</a>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                @else
                <p class="text-center">No alerts found.</p>
                @endif
                <div class="mt-3">{{ $alerts->links() }}</div>
              </div>
            </div>

            <!-- 2. Severity Overview -->
            <div class="card mb-3">
              <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-bar-chart-line me-2"></i>Severity Overview</h5>
              </div>
              <div class="card-body text-white">
                <p>Overview of current system alerts by severity level:</p>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">🔴 <strong>Critical:</strong> {{ $severityCounts->get('critical', 0) }} active issues</li>
                  <li class="list-group-item">🟠 <strong>Warning:</strong> {{ $severityCounts->get('warning', 0) }} active issues</li>
                  <li class="list-group-item">🔵 <strong>Info:</strong> {{ $severityCounts->get('info', 0) }} active issues</li>
                </ul>
              </div>
            </div>

            <!-- 3. Acknowledgment & Response -->
            <div class="card mb-3">
              <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-check-circle me-2 text-success"></i>Acknowledgment & Response</h5>
              </div>
              <div class="card-body text-white">
                <p>Engineers assigned are shown on the task card — use the Alerts list to acknowledge and route issues.</p>
                <div class="text-muted">Use the table above to quickly acknowledge alerts and view details.</div>
              </div>
            </div>

          </div> <!-- /col-md-12 -->

        </div> <!-- /row -->
      </div> <!-- /page-container -->
    </div> <!-- /page-content -->
  </div> <!-- /wrapper -->

</body>

@include('user.include.footer')