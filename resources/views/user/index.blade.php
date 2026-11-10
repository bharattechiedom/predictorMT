<?php $page_title = "predictorMt - home";

 ?>

 @include('user.include.header')

 @php
     $latestReading = $sensorReadings->last();
     $latestValues = data_get($latestReading, 'values', []);
 @endphp
                
 <main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>
            <div class="col-md-10">
                 <div class="page-content dashboard-page m-auto p-3 mt-5">
                    <div class="page-title-head d-flex align-items-center gap-2 bg-transparent shadow-none m-0">
                        <div class="flex-grow-1">
                            <h4 class="headings">KPIs, Live Data & Predictions Summary</h4>
                        </div>
                    </div>

                    <!-- KPI Cards -->
                    <div class="row cardBox g-3">

                        <!-- Total Machines -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #EAF4FF;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">Total Machines</p>
                                        <h3 class="fw-bold mb-0" id="total-machines">{{ $machines->count() }}</h3>
                                        <small class="text-muted">
                                            <i class="fas fa-industry"></i> Registered
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #0D6EFD;">
                                        <i class="fas fa-industry fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Running Machines -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #E9FFF3;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">Running</p>
                                        <h3 class="fw-bold mb-0" id="running-machines">{{ $runningMachineCount }}</h3>
                                        <small class="text-success">
                                            <i class="fas fa-circle"></i> Live
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #198754;">
                                        <i class="fas fa-play fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Faults -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #FFF4E8;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">Active Faults</p>
                                        <h3 class="fw-bold mb-0" id="dashboard-active-alerts">{{ $activeAlertsCount }}</h3>
                                        <small class="text-danger">
                                            <i class="fas fa-triangle-exclamation"></i> Critical
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #FD7E14;">
                                        <i class="fas fa-bug fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Sensors -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #F2F0FF;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">Sensors</p>
                                        <h3 class="fw-bold mb-0" id="dashboard-active-sensors">{{ $connectedSensorCount }}</h3>
                                        <small class="text-primary">
                                            <i class="fas fa-wifi"></i> Connected in last 5 min
                                        </small>
                                        <small class="text-warning d-block" id="dashboard-stale-sensors">
                                            {{ $staleSensorCount }} active sensor(s) stale
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #6F42C1;">
                                        <i class="fas fa-microchip fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MQTT Status -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #EAFBF8;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">HTTP ingestion</p>
                                        <h3 class="fw-bold mb-0">Available</h3>
                                        <small class="text-muted">
                                            <i class="fas fa-circle-info"></i> Authenticated API
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #20C997;">
                                        <i class="fas fa-satellite-dish fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Machine Health -->
                        <div class="col-xl-2 col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="background: #FFF0F3;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 fw-semibold">Machine Health</p>
                                        <h3 class="fw-bold mb-0" id="dashboard-health-percent">{{ $healthPercent }}%</h3>
                                        <small class="text-success">
                                            <i class="fas fa-heart-pulse"></i> Excellent
                                        </small>
                                    </div>

                                    <div class="rounded-circle d-flex align-items-center justify-content-center kpiCard"
                                        style="background: #DC3545;">
                                        <i class="fas fa-heart-pulse fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End KPI Cards -->
                     <div class="row mt-4">

                        <div class="col-lg-12">

                            <div class="card shadow-sm border-0">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-chart-area me-2"></i>
                                        Real-Time Sensor Analytics
                                    </h5>

                                    <span class="badge bg-success">
                                        Live
                                    </span>

                                </div>

                                <div class="card-body bg-white">

                                    <div id="realtimeAreaChart"></div>

                                </div>

                            </div>

                        </div>

                    </div>
                    
                    <div class="row mt-4">

                        <!-- Left Side : Live Sensor Charts -->
                        <div class="col-lg-8">

                            <div class="card shadow-sm border-0">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold text-white">
                                        <i class="fas fa-chart-line text-primary me-2"></i>
                                        Live Sensor Charts
                                    </h5>

                                    <span class="badge bg-success">
                                        <i class="fas fa-circle me-1"></i> Live
                                    </span>
                                </div>

                                <div class="card-body bg-white">

                                    <div class="row g-4">

                                        <!-- Temperature -->
                                    <div class="col-md-6">
                        <div class="border rounded p-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h6 class="mb-0">
                                    <i class="fas fa-temperature-high text-danger me-2"></i>
                                    Temperature
                                </h6>

                                <span class="badge bg-danger">{{ data_get($latestValues, 'temperature') !== null ? number_format((float) data_get($latestValues, 'temperature'), 1) . '°C' : '—' }}</span>

                            </div>

                            <div style="height:220px;">
                                <canvas id="temperatureChart"></canvas>
                            </div>

                        </div>
                    </div>


                                        <!-- Pressure -->
                                        <div class="col-md-6">
                                            <div class="border rounded p-3">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-gauge-high text-warning me-2"></i>
                                                        Pressure
                                                    </h6>

                                                    <span class="badge bg-warning text-dark">
                                                        {{ data_get($latestValues, 'pressure') !== null ? number_format((float) data_get($latestValues, 'pressure'), 1) . ' PSI' : '—' }}
                                                    </span>
                                                </div>

                                                <div style="height:220px;">
                        <canvas id="pressureChart"></canvas>
                    </div>
                                            </div>
                                        </div>

                                        <!-- Vibration -->
                                        <div class="col-md-6">
                                            <div class="border rounded p-3">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-wave-square text-info me-2"></i>
                                                        Vibration
                                                    </h6>

                                                    <span class="badge bg-info">
                                                        {{ data_get($latestValues, 'vibration') !== null ? number_format((float) data_get($latestValues, 'vibration'), 2) . ' mm/s' : '—' }}
                                                    </span>
                                                </div>

                                                <div style="height:220px;">
                        <canvas id="vibrationChart"></canvas>
                    </div>
                                            </div>
                                        </div>

                                        <!-- RPM -->
                                        <div class="col-md-6">
                                            <div class="border rounded p-3">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-rotate text-success me-2"></i>
                                                        RPM
                                                    </h6>

                                                    <span class="badge bg-success">
                                                        {{ data_get($latestValues, 'rpm') !== null ? number_format((float) data_get($latestValues, 'rpm')) . ' RPM' : '—' }}
                                                    </span>
                                                </div>

                                            <div style="height:220px;">
                        <canvas id="rpmChart"></canvas>
                    </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Right Side -->
                        <div class="col-lg-4">

                        <!-- Machine Health -->
                        <div class="card shadow-sm border-0 mb-4">

                            <div class="card-header">
                                <h5 class="mb-0 fw-bold text-white">
                                    <i class="fas fa-heart-pulse text-danger me-2"></i>
                                    Machine Health
                                </h5>
                            </div>

                            <div class="card-body text-center bg-white">

                                <div style="height:220px;">
                                    <canvas id="healthGauge"></canvas>
                                </div>

                                <h2 class="fw-bold text-success mt-3">
                                    {{ $healthPercent }}%
                                </h2>

                                <span class="badge bg-success px-3 py-2">
                                    {{ $healthPercent ? 'Healthy machines recorded' : 'No healthy machine status recorded' }}
                                </span>

                            </div>

                        </div>



                            <!-- Overall Score -->
                            <div class="card shadow-sm border-0 mb-4">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>
                                            <small class="text-white">
                                                Overall Score
                                            </small>

                                            <h2 class="fw-bold text-primary mb-0">
                                                {{ $healthPercent }}/100
                                            </h2>
                                        </div>

                                        <i class="fas fa-award fa-3x text-primary"></i>

                                    </div>

                                </div>

                            </div>

                            <!-- Active Alerts -->
                            <!-- <div class="card shadow-sm border-0 mb-4">

                                <div class="card-header bg-white">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-bell text-warning me-2"></i>
                                        Active Alerts
                                    </h6>
                                </div>

                                <div class="list-group list-group-flush">

                                    <div class="list-group-item d-flex justify-content-between">
                                        High Temperature
                                        <span class="badge bg-danger">Critical</span>
                                    </div>

                                    <div class="list-group-item d-flex justify-content-between">
                                        Pressure Drop
                                        <span class="badge bg-warning text-dark">Warning</span>
                                    </div>

                                    <div class="list-group-item d-flex justify-content-between">
                                        Bearing Vibration
                                        <span class="badge bg-info">Medium</span>
                                    </div>

                                    <div class="list-group-item d-flex justify-content-between">
                                        Motor Restarted
                                        <span class="badge bg-success">Resolved</span>
                                    </div>

                                </div>

                            </div> -->

                            <!-- Fault Count -->
                            <div class="card shadow-sm border-0">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <small class="text-white">
                                                Fault Count
                                            </small>

                                            <h2 class="fw-bold text-danger mb-0">
                                                {{ $activeAlertsCount }}
                                            </h2>

                                        </div>

                                        <i class="fas fa-triangle-exclamation fa-3x text-danger"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row mt-4">

                        <!-- Event Log -->
                        <div class="col-lg-8">

                            <div class="card shadow-sm border-0">

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-list-ul me-2"></i>
                                        Event Log
                                    </h5>

                                    <span class="badge bg-success">
                                        Live Events
                                    </span>
                                </div>

                                <div class="card-body bg-white p-0">

                                    <div class="table-responsive">

                                        <table class="table table-hover table-striped mb-0 align-middle">

                                            <thead class="table-light">

                                                <tr>

                                                    <th>Time</th>
                                                    <th>Machine</th>
                                                    <th>Event</th>
                                                    <th>Severity</th>
                                                    <th>Status</th>

                                                </tr>

                                            </thead>

                                            <tbody id="dashboard-events">

                                                @forelse ($events as $event)
                                                    <tr>
                                                        <td>{{ optional($event->created_at)->format('H:i') ?? '—' }}</td>
                                                        <td>{{ optional($event->machine)->name ?? 'Unknown machine' }}</td>
                                                        <td>{{ $event->message }}</td>
                                                        <td><span class="badge bg-{{ $event->level === 'critical' ? 'danger' : ($event->level === 'warning' ? 'warning text-dark' : 'info') }}">{{ ucfirst($event->level) }}</span></td>
                                                        <td><span class="badge bg-{{ $event->acknowledged_at ? 'success' : 'secondary' }}">{{ $event->acknowledged_at ? 'Acknowledged' : 'Open' }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="5" class="text-center text-muted py-4">No alerts recorded.</td></tr>
                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Machine Details -->

                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-microchip me-2"></i>
                                        Machine Details
                                    </h5>
                                </div>

                                <div class="card-body bg-white">

                                    <table class="table table-borderless mb-0">

                                        <tr>
                                            <td><strong>Machine ID</strong></td>
                                            <td>{{ $machines->first()?->serial_number ?? '—' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Machine Type</strong></td>
                                            <td>{{ $machines->first()?->machine_type ?? '—' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Location</strong></td>
                                            <td>{{ $machines->first()?->location ?? '—' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Runtime</strong></td>
                                            <td>—</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Health</strong></td>
                                            <td>
                                                <span class="badge bg-secondary">{{ ucfirst($machines->first()?->status ?? 'Not recorded') }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>Last Service</strong></td>
                                            <td>{{ $latestCompletedMaintenance?->completed_at?->format('M d, Y') ?? '—' }}</td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row mt-4">

                        <!-- Performance -->

                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-chart-column me-2"></i>
                                        Performance Summary
                                    </h5>
                                </div>

                                <div class="card-body bg-white">

                                    <div class="d-flex justify-content-between mb-3">

                                        <span>Efficiency</span>

                                        <strong class="text-success">
                                            {{ $healthPercent }}%
                                        </strong>

                                    </div>

                                    <div class="progress mb-3">

                                        <div class="progress-bar bg-success"
                                            style="width:{{ $healthPercent }}%">
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between mb-3">

                                        <span>Availability</span>

                                        <strong class="text-primary">
                                            {{ $activeSensorCount > 0 ? round($connectedSensorCount / $activeSensorCount * 100) : 0 }}%
                                        </strong>

                                    </div>

                                    <div class="progress mb-3">

                                        <div class="progress-bar bg-primary"
                                            style="width:{{ $activeSensorCount > 0 ? round($connectedSensorCount / $activeSensorCount * 100) : 0 }}%">
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between">

                                        <span>Reliability</span>

                                        <strong class="text-warning">
                                            {{ $healthPercent }}%
                                        </strong>

                                    </div>

                                    <div class="progress">

                                        <div class="progress-bar bg-warning"
                                            style="width:{{ $healthPercent }}%">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- MQTT -->

                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-satellite-dish me-2"></i>
                                        MQTT Connection
                                    </h5>
                                </div>

                                <div class="card-body bg-white">

                                    <ul class="list-group list-group-flush">

                                        <li class="list-group-item d-flex justify-content-between">
                                            Broker
                                            <span class="badge bg-{{ config('mqtt.enabled') ? 'warning text-dark' : 'secondary' }}">
                                                {{ config('mqtt.enabled') ? 'Enabled · connection not verified' : 'Disabled' }}
                                            </span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between">
                                            Publish Rate
                                            <strong>{{ config('mqtt.host') }}:{{ config('mqtt.port') }}</strong>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between">
                                            Subscriber
                                            <strong>Not available</strong>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between">
                                            Latency
                                            <strong>Not measured</strong>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <!-- Analytics -->

                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-chart-pie me-2"></i>
                                        System Analytics
                                    </h5>
                                </div>

                                <div class="card-body bg-white">

                                    <div class="d-flex justify-content-between mb-3">

                                        <span>Active Sensors</span>

                                        <strong>{{ $activeSensorCount }}</strong>

                                    </div>

                                    <div class="d-flex justify-content-between mb-3">

                                        <span>Running Machines</span>

                                        <strong class="text-success">
                                            {{ $runningMachineCount }}
                                        </strong>

                                    </div>

                                    <div class="d-flex justify-content-between mb-3">

                                        <span>Faults Today</span>

                                        <strong class="text-danger">
                                            {{ $alertsTodayCount }}
                                        </strong>

                                    </div>

                                    <div class="d-flex justify-content-between">

                                        <span>Alerts</span>

                                        <strong class="text-warning">
                                            {{ $activeAlertsCount }}
                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- Machine Status + Recent Alerts -->
                    <div class="row mt-4">

                        <!-- Machine Status -->
                        <div class="col-lg-8">

                            <div class="card shadow-sm border-0">

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-industry me-2"></i>
                                        Machine Status
                                    </h5>

                                    <span class="badge bg-success">
                                        {{ $machines->count() }} Machines
                                    </span>
                                </div>

                                <div class="card-body bg-white">

                                    <div class="row g-3">

                                        @forelse ($machines as $machine)
                                            @php
                                                $machineState = data_get($machine->metadata, 'simulation.status', $machine->status ?: 'unknown');
                                                $machineBadge = in_array($machineState, ['running', 'healthy', 'active']) ? 'success' : (in_array($machineState, ['fault', 'error', 'critical']) ? 'danger' : 'secondary');
                                            @endphp
                                            <div class="col-md-4">
                                                <div class="border rounded p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>{{ $machine->name }}</strong>
                                                        <span class="badge bg-{{ $machineBadge }}">{{ ucfirst($machineState) }}</span>
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $machine->machine_type ?: 'Machine type not recorded' }}
                                                        @if($machine->location) · {{ $machine->location }} @endif
                                                    </small>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center text-muted py-3">No machines have been registered.</div>
                                        @endforelse

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Recent Alerts -->
                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-bell me-2"></i>
                                        Recent Alerts
                                    </h5>
                                </div>

                                <div class="list-group list-group-flush">

                                    @forelse($events->take(5) as $event)
                                        <div class="list-group-item d-flex justify-content-between">
                                            <div>
                                                <i class="fas fa-circle text-{{ $event->acknowledged_at ? 'success' : ($event->level === 'critical' ? 'danger' : 'warning') }} me-2"></i>
                                                {{ $event->message }}
                                            </div>
                                            <small>{{ $event->created_at?->diffForHumans() ?? '—' }}</small>
                                        </div>
                                    @empty
                                        <div class="list-group-item text-muted">No recent alerts.</div>
                                    @endforelse

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Fault Timeline + Maintenance -->
                    <div class="row mt-4">

                        <!-- Fault Timeline -->
                        <div class="col-lg-8">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-clock-rotate-left me-2"></i>
                                        Fault Timeline
                                    </h5>
                                </div>

                                <div class="card-body bg-white">

                                    <table class="table table-hover align-middle">

                                        <thead>

                                            <tr>

                                                <th>Time</th>
                                                <th>Machine</th>
                                                <th>Fault</th>
                                                <th>Status</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse($events->take(5) as $event)
                                                <tr>
                                                    <td>{{ $event->created_at?->format('M d, H:i') ?? '—' }}</td>
                                                    <td>{{ $event->machine->name ?? 'Unknown machine' }}</td>
                                                    <td>{{ $event->message }}</td>
                                                    <td><span class="badge bg-{{ $event->acknowledged_at ? 'success' : ($event->level === 'critical' ? 'danger' : 'warning text-dark') }}">{{ $event->acknowledged_at ? 'Acknowledged' : ucfirst($event->level) }}</span></td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="text-center text-muted">No fault events recorded.</td></tr>
                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <!-- Maintenance Schedule -->
                        <div class="col-lg-4">

                            <div class="card shadow-sm border-0">

                                <div class="card-header">
                                    <h5 class="mb-0 text-white">
                                        <i class="fas fa-screwdriver-wrench me-2"></i>
                                        Maintenance Schedule
                                    </h5>
                                </div>

                                <div class="list-group list-group-flush">

                                    @forelse($upcomingMaintenance as $task)
                                        <div class="list-group-item d-flex justify-content-between">
                                            <span>{{ $task->machine->name ?? 'Machine' }}</span>
                                            <span class="badge bg-{{ $task->status === 'in_progress' ? 'warning text-dark' : 'primary' }}">{{ $task->scheduled_at?->format('M d') ?? ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                        </div>
                                    @empty
                                        <div class="list-group-item text-muted">No upcoming maintenance tasks.</div>
                                    @endforelse

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Payments & Subscriptions Section -->

                    <div class="row mt-4">

                        <div class="col-lg-8">

                            <div class="card bg-white">

                                <div class="card-body">

                                    <h5 class="card-title theme-heading-color">Recent Payments</h5>

                                    <div class="table-responsive">

                                            <table class="table table-hover table-bordered">

                                                <thead class="bg-light">

                                                    <tr>

                                                        <th>Date</th>

                                                        <th>Plan</th>

                                                        <th>Amount</th>

                                                        <th>Currency</th>

                                                        <th>Status</th>

                                                        <th>Session</th>

                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                </tbody>
                    </table>
                    </div>

                                    @if(!empty($payments) && $payments->count())

                                        <div class="table-responsive">

                                            <table class="table table-sm">

                                                <thead>

                                                    <tr>

                                                        <th>Date</th>

                                                        <th>Plan</th>

                                                        <th>Amount</th>

                                                        <th>Currency</th>

                                                        <th>Status</th>

                                                        <th>Session</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($payments as $p)

                                                        <tr>

                                                            <td>{{ $p->created_at ? $p->created_at->format('Y-m-d H:i') : '' }}</td>

                                                            <td>{{ $p->plan ? $p->plan->name : ($p->plan_id ? 'Plan #' . $p->plan_id : '-') }}</td>

                                                            <td>{{ $p->amount !== null ? number_format($p->amount,2) : '-' }}</td>

                                                            <td>{{ strtoupper($p->currency ?? config('app.currency','CAD')) }}</td>

                                                            <td>{{ ucfirst($p->status ?? '-') }}</td>

                                                            <td style="max-width:180px; word-break:break-all">{{ $p->stripe_session_id }}</td>

                                                        </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    @else

                                        <p class="text-muted">No payments found for your account.</p>

                                    @endif

                                </div>

                            </div>

                        </div>



                        <div class="col-lg-4">

                            <div class="card">

                                <div class="card-body">

                                    <h5 class="card-title text-white">Subscriptions</h5>

                                    @if(!empty($subscriptions) && $subscriptions->count())

                                        <ul class="list-group list-group-flush">

                                            @foreach($subscriptions as $s)

                                                <li class="list-group-item">

                                                    <strong>{{ $s->plan ? $s->plan->name : ('Plan #' . $s->plan_id) }}</strong>

                                                    <div class="small text-muted">Status: {{ ucfirst($s->status) }}</div>

                                                    <div class="small text-muted">Started: {{ $s->started_at ? $s->started_at->format('Y-m-d') : '-' }}</div>

                                                    <div class="small text-muted">Ends: {{ $s->ended_at ? $s->ended_at->format('Y-m-d') : 'N/A' }}</div>

                                                </li>

                                            @endforeach

                                        </ul>

                                    @else

                                        <p class="text-white">No active subscriptions for your company.</p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                </div>
                
                

           


            
            </div>
        </div>
    </div>
</main>



<script>
window.predictorReadings = @json($sensorReadings);
window.predictorHealthPercent = {{ $healthPercent }};
function renderDashboardEvents(events) {
    const body = document.getElementById('dashboard-events');
    body.replaceChildren();

    if (!events.length) {
        const row = body.insertRow();
        const cell = row.insertCell();
        cell.colSpan = 5;
        cell.className = 'text-center text-muted py-4';
        cell.textContent = 'No alerts recorded.';
        return;
    }

    const severityClasses = {critical: 'danger', warning: 'warning text-dark', info: 'info'};
    events.forEach(event => {
        const row = body.insertRow();
        const time = event.created_at ? new Date(event.created_at).toLocaleTimeString() : '—';
        [time, event.machine, event.message].forEach(value => {
            row.insertCell().textContent = value ?? '—';
        });

        const severity = row.insertCell().appendChild(document.createElement('span'));
        severity.className = `badge bg-${severityClasses[event.level] || 'secondary'}`;
        severity.textContent = event.level.charAt(0).toUpperCase() + event.level.slice(1);

        const state = row.insertCell().appendChild(document.createElement('span'));
        state.className = `badge bg-${event.acknowledged ? 'success' : 'secondary'}`;
        state.textContent = event.acknowledged ? 'Acknowledged' : 'Open';
    });
}

window.setInterval(async () => {
    try {
        const response = await fetch(@json(route('user.dashboard.sensor-readings')), {headers: {'Accept': 'application/json'}});
        if (!response.ok) throw new Error(`Dashboard data request failed (${response.status}).`);
        const data = await response.json();
        window.predictorReadings = data.readings;
        document.getElementById('total-machines').textContent = data.machineCount;
        document.getElementById('running-machines').textContent = data.runningMachineCount;
        document.getElementById('dashboard-active-sensors').textContent = data.connectedSensorCount;
        document.getElementById('dashboard-stale-sensors').textContent = `${data.staleSensorCount} active sensor(s) stale`;
        document.getElementById('dashboard-active-alerts').textContent = data.activeAlertsCount;
        document.getElementById('dashboard-health-percent').textContent = `${data.healthPercent}%`;
        renderDashboardEvents(data.events);
        window.predictorHealthPercent = data.healthPercent;
        if (typeof window.updatePredictorDashboardReadings === 'function') {
            window.updatePredictorDashboardReadings(data.readings);
        }
    } catch (error) {
        console.error('Unable to refresh the live dashboard.', error);
    }
}, 5000);
</script>

@include('user.include.footer')
