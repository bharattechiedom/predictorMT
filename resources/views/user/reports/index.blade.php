<?php
$page_title = "Reports";
?>
@include('user.include.header')

<div class="wrapper active">
	<div class="page-content">
		<div class="page-container p-3">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="mb-0">Reports</h4>
				</div>
				<div class="card-body">
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
				</div>
			</div>
		</div>
	</div>
</div>

@include('user.include.footer')
