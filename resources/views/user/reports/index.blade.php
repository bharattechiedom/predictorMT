<?php
$page_title = "Reports";
?>
@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>
            <div class="col-md-10">
              <div class="page-content m-auto mt-5">

					<div class="page-container">
						<div class="card shadow-none">
							<div class="card-header d-flex justify-content-between align-items-center px-0">
								<h3 class="mb-0">Reports</h3>
							</div>
							<!-- <div class="card-body">
								<div class="row g-3">
									<div class="col-md-3">
										<div class="card p-3">
											<h6>Machines</h6>
											<h3>{{ $report['machinesCount'] ?? 0 }}</h3>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card p-3">
											<h6>Sensors</h6>
											<h3>{{ $report['sensorsCount'] ?? 0 }}</h3>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card p-3">
											<h6>Open Predictions</h6>
											<h3>{{ $report['openPredictions'] ?? 0 }}</h3>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card p-3">
											<h6>Upcoming Tasks</h6>
											<h3>{{ $report['upcomingTasks'] ?? 0 }}</h3>
										</div>
									</div>
								</div>
							</div> -->
						</div>
						
				<div class="card-body">
					<div class="row g-3">

						<!-- Machines -->
						<div class="col-md-3 col-sm-6">
							<div class="card border-0 shadow-none rounded-2 p-3 bg-primary-subtle">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-primary fw-semibold mb-2">Machines</h6>
										<h3 class="fw-bold text-dark mb-0 fs-2">
											{{ $report['machinesCount'] ?? 0 }}
										</h3>
										<small class="text-muted">Total Machines</small>
									</div>
									<div class="text-primary">
										<i class="fas fa-industry fa-2x"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Sensors -->
						<div class="col-md-3 col-sm-6">
							<div class="card border-0 shadow-none rounded-2 p-3 bg-success-subtle">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-success fw-semibold mb-2">Sensors</h6>
										<h3 class="fw-bold text-dark mb-0 fs-2">
											{{ $report['sensorsCount'] ?? 0 }}
										</h3>
										<small class="text-muted">Total Sensors</small>
									</div>
									<div class="text-success">
										<i class="fas fa-microchip fa-2x"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Open Predictions -->
						<div class="col-md-3 col-sm-6">
							<div class="card border-0 shadow-none rounded-2 p-3 bg-warning-subtle">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-warning-emphasis fw-semibold mb-2">
											Open Predictions
										</h6>
										<h3 class="fw-bold text-dark mb-0 fs-2">
											{{ $report['openPredictions'] ?? 0 }}
										</h3>
										<small class="text-muted">Pending Predictions</small>
									</div>
									<div class="text-warning-emphasis">
										<i class="fas fa-chart-line fa-2x"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Upcoming Tasks -->
						<div class="col-md-3 col-sm-6">
							<div class="card border-0 shadow-none rounded-2 p-3 bg-danger-subtle">
								<div class="d-flex justify-content-between align-items-center">
									<div>
										<h6 class="text-danger fw-semibold mb-2">
											Upcoming Tasks
										</h6>
										<h3 class="fw-bold text-dark mb-0 fs-2">
											{{ $report['upcomingTasks'] ?? 0 }}
										</h3>
										<small class="text-muted">Scheduled Tasks</small>
									</div>
									<div class="text-danger">
										<i class="fas fa-calendar-check fa-2x"></i>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

					</div>
					<div class="card border-1 shadow-none mt-4 mb-3">
    <div class="card-header bg-white border-0 p-3 pb-1">
        <h5 class="fw-bold mb-1">Report Analytics</h5>
        <small class="text-muted">Overview of system statistics</small>
    </div>
    <div class="card-body">
        <canvas id="reportChart" height="100"></canvas>
    </div>
</div>

				</div>
				


			</div>
		</div>
	</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('reportChart');

new Chart(ctx, {
    type: 'bar',

    data: {
        labels: [
            'Machines',
            'Sensors',
            'Open Predictions',
            'Upcoming Tasks'
        ],

        datasets: [{
            label: 'Total Count',

            data: [
                {{ $report['machinesCount'] ?? 0 }},
                {{ $report['sensorsCount'] ?? 0 }},
                {{ $report['openPredictions'] ?? 0 }},
                {{ $report['upcomingTasks'] ?? 0 }}
            ],

            backgroundColor: [
                'rgba(59, 130, 246, 0.75)',
                'rgba(34, 197, 94, 0.75)',
                'rgba(245, 158, 11, 0.75)',
                'rgba(239, 68, 68, 0.75)'
            ],

            borderRadius: 8,
            borderSkipped: false,
            barThickness: 45
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: true,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                },
                grid: {
                    color: '#f1f1f1'
                }
            },

            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

@include('user.include.footer')
