@php
    $page_title = 'Failure Insights';
@endphp

@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>

            {{-- Main Content --}}
            <div class="col-md-10">
                <div class="page-content m-auto p-3 mt-5">

                    {{-- Page Header --}}
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">AI Prediction Dashboard</h3>
                            <p class="text-muted mb-0">
                                Review failure predictions recorded for your machines.
                            </p>
                        </div>
                    </div>

                    {{-- KPI Cards --}}
                    <div class="row g-3 mb-4">

                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <div>
                                            <p class="text-muted mb-1">AI Predictions</p>
                                            <h3 class="fw-bold text-primary mb-0">{{ $predictionCount }}</h3>
                                        </div>
                                        <i class="fa-solid fa-brain fs-2 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <div>
                                            <p class="text-muted mb-1">Average Failure Risk</p>
                                            <h3 class="fw-bold text-danger mb-0">{{ $averageProbability }}%</h3>
                                        </div>
                                        <i class="fa-solid fa-triangle-exclamation fs-2 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <div>
                                            <p class="text-muted mb-1">Predictive Maintenance</p>
                                            <h3 class="fw-bold text-success mb-0">{{ $scheduledMaintenanceCount }}</h3>
                                        </div>
                                        <i class="fa-solid fa-screwdriver-wrench fs-2 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center gap-3">
                                        <div>
                                            <p class="text-muted mb-1">Open Predictions</p>
                                            <h3 class="fw-bold text-warning mb-0">{{ $openPredictionCount }}</h3>
                                        </div>
                                        <i class="fa-solid fa-hourglass-half fs-2 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Predictions and Maintenance --}}
                    <div class="row g-3 mb-4">

                        {{-- AI Prediction Table --}}
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-brain me-2"></i>
                                        AI Predictions
                                    </h5>
                                </div>

                                <div class="card-body p-0 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Machine</th>
                                                    <th>Predicted Failure</th>
                                                    <th>Failure Probability</th>
                                                    <th>Model Version</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($predictions as $prediction)
                                                    <tr>
                                                        <td>{{ $prediction->machine->name ?? '—' }}</td>
                                                        <td>{{ $prediction->predicted_failure_at?->format('M d, Y') ?? 'Not recorded' }}</td>
                                                        <td>{{ number_format((float) $prediction->probability * 100, 1) }}%</td>
                                                        <td>{{ $prediction->model_version ?: 'Not recorded' }}</td>
                                                        <td><span class="badge bg-{{ $prediction->status === 'resolved' ? 'success' : ($prediction->status === 'open' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst($prediction->status) }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="5" class="text-center">No predictions have been recorded.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Predictive Maintenance --}}
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-screwdriver-wrench me-2"></i>
                                        Predictive Maintenance
                                    </h5>
                                </div>

                                <div class="card-body p-0 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-3">
                                            <tbody>
                                                <tr>
                                                    <th>Machine</th>
                                                    <td>{{ $highestRiskPrediction?->machine?->name ?? '—' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Recommendation</th>
                                                    <td>{{ $highestRiskPrediction?->component ?: 'No prediction available' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Priority</th>
                                                    <td>{{ $highestRiskPrediction ? number_format((float) $highestRiskPrediction->probability * 100, 1) . '%' : '—' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Due</th>
                                                    <td>{{ $highestRiskPrediction?->predicted_failure_at?->format('M d, Y') ?? 'Not recorded' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <a href="{{ route('user.maintenance-tasks.create') }}" class="btn theme-btn w-100">
                                        <i class="fa-solid fa-calendar-check me-1"></i>
                                        Schedule Maintenance
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Failure Prediction Trend and Predicted Date --}}
                    <div class="row g-3 mb-4">

                        <div class="col-lg-8">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-chart-line me-2"></i>
                                        Failure Prediction Trend
                                    </h5>
                                </div>

                                <div class="card-body p-0 mt-3">
                                    <div id="failurePredictionChart" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-hourglass-half me-2"></i>
                                        Predicted Failure Date
                                    </h5>
                                </div>

                                <div class="card-body text-center mt-3">
                                    <h2 class="display-4 fw-bold text-success mb-1">{{ $highestRiskPrediction?->predicted_failure_at?->format('M d') ?? '—' }}</h2>
                                    <p class="text-muted mb-3">Date stored with highest-risk prediction</p>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Machine</th>
                                                    <td>{{ $highestRiskPrediction?->machine?->name ?? '—' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Health</th>
                                                    <td>{{ $highestRiskPrediction ? number_format((float) $highestRiskPrediction->probability * 100, 1) . '%' : '—' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Confidence</th>
                                                    <td>{{ $highestRiskPrediction?->model_version ?: 'Not recorded' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Risk Analysis Cards --}}
                    <div class="row g-3 mb-4">

                        {{-- Failure Probability --}}
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-bullseye me-2"></i>
                                        Failure Probability
                                    </h5>
                                </div>

                                <div class="card-body text-center mt-3">
                                    <div id="failureGauge" style="height: 250px;"></div>

                                    <h3 class="fw-bold text-danger mb-2">{{ $highestRiskPrediction ? number_format((float) $highestRiskPrediction->probability * 100, 1) . '%' : '—' }}</h3>
                                    <span class="badge bg-warning text-dark px-3 py-2">{{ $highestRiskPrediction ? 'Highest Recorded Risk' : 'No Prediction' }}</span>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Machine</th>
                                                    <td>{{ $highestRiskPrediction?->machine?->name ?? '—' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><span class="badge bg-secondary">{{ ucfirst($highestRiskPrediction?->status ?? 'N/A') }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Next Review</th>
                                                    <td>{{ $highestRiskPrediction?->predicted_at?->format('M d, Y H:i') ?? '—' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- AI Confidence --}}
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-brain me-2"></i>
                                        Prediction Model
                                    </h5>
                                </div>

                                <div class="card-body text-center mt-3">
                                    <div class="display-2 fw-bold text-success">{{ $highestRiskPrediction?->model_version ?: '—' }}</div>

                                    <p class="text-muted">
                                        Confidence data is not stored for these predictions.
                                    </p>

                                    <div class="progress mb-4" style="height: 12px;"><div class="progress-bar bg-secondary" role="progressbar" style="width: 0%;"></div></div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Model</th>
                                                    <td>{{ $highestRiskPrediction?->model_version ?: 'Not recorded' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Dataset</th>
                                                    <td>{{ number_format($predictionCount) }} predictions</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Trained</th>
                                                    <td>{{ $highestRiskPrediction?->predicted_at?->format('M d, Y') ?? 'Not recorded' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Machine Risk Matrix --}}
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-none h-100">
                                <div class="card-header p-0 mt-2">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fa-solid fa-table-cells-large me-2"></i>
                                        Machine Risk Matrix
                                    </h5>
                                </div>

                                <div class="card-body p-0 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Machine</th>
                                                    <th>Risk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($riskPredictions as $prediction)
                                                    <tr>
                                                        <td>{{ $prediction->machine->name ?? '—' }}</td>
                                                        <td><span class="badge bg-{{ $prediction->probability >= 0.7 ? 'danger' : ($prediction->probability >= 0.3 ? 'warning text-dark' : 'success') }}">{{ number_format((float) $prediction->probability * 100, 1) }}%</span></td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="2">No risk data available.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <a href="{{ route('user.predictions.index') }}" class="btn btn-outline-primary w-100">View Predictions</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Failure Filters --}}
                    <div class="card border-0 shadow-none mb-4">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-filter me-2"></i>
                                Failure Investigation
                            </h5>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <div class="row g-3">
                                <div class="col-lg-4 col-md-6">
                                    <label for="failureId" class="form-label fw-semibold">
                                        Failure ID
                                    </label>
                                    <input type="text"
                                           id="failureId"
                                           class="form-control"
                                           placeholder="Enter Failure ID">
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label for="failureDate" class="form-label fw-semibold">
                                        Failure Date
                                    </label>
                                    <input type="date" id="failureDate" class="form-control">
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label for="facility" class="form-label fw-semibold">
                                        Facility
                                    </label>
                                    <select id="facility" class="form-select">
                                        <option value="" selected>All Facilities</option>
                                        <option value="Plant A">Plant A</option>
                                        <option value="Plant B">Plant B</option>
                                        <option value="Plant C">Plant C</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Failure Timeline --}}
                    <div class="card border-0 shadow-none mb-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-clock-rotate-left me-2"></i>
                                Failure Timeline
                            </h5>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <p class="text-muted">
                                Chronological sequence of events leading to failure:
                            </p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                @forelse($chartPredictions->reverse() as $prediction)
                                    <li class="list-group-item px-0">
                                        <strong>{{ $prediction->predicted_at?->format('M d, Y H:i') ?? 'Date unavailable' }}:</strong>
                                        {{ $prediction->machine->name ?? 'Machine' }} —
                                        {{ $prediction->component ?: 'failure risk' }},
                                        {{ number_format((float) $prediction->probability * 100, 1) }}% probability.
                                    </li>
                                @empty
                                    <li class="list-group-item px-0">No prediction history is available.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    {{-- Recommendations --}}
                    <div class="card border-0 shadow-none mb-3">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-regular fa-lightbulb me-2"></i>
                                Recommendations
                            </h5>
                        </div>

                        <div class="card-body p-0 mt-3">
                            <ul class="list-group list-group-flush">
                                @forelse($riskPredictions as $prediction)
                                    <li class="list-group-item px-0">
                                        <i class="fa-solid fa-check text-success me-2"></i>
                                        Review {{ $prediction->component ?: 'failure risk' }} for
                                        {{ $prediction->machine->name ?? 'the machine' }}:
                                        {{ number_format((float) $prediction->probability * 100, 1) }}% recorded probability.
                                    </li>
                                @empty
                                    <li class="list-group-item px-0">No recommendations are available without recorded predictions.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    {{-- ML Explanation --}}
                    <div class="card border-0 shadow-none mb-4">
                        <div class="card-header p-0 mt-2">
                            <h5 class="fw-bold mb-0">
                                <i class="fa-solid fa-microchip me-2"></i>
                                ML Explanation
                            </h5>
                        </div>

                        <div class="card-body p-0 mt-3">
                            @if($highestRiskPrediction)
                                <p>
                                    Recorded prediction for <strong>{{ $highestRiskPrediction->machine->name ?? 'Machine' }}</strong>
                                    has a <strong>{{ number_format((float) $highestRiskPrediction->probability * 100, 1) }}% probability</strong>
                                    @if($highestRiskPrediction->component)
                                        for {{ $highestRiskPrediction->component }}.
                                    @endif
                                    Model: <strong>{{ $highestRiskPrediction->model_version ?: 'not recorded' }}</strong>.
                                </p>
                                @if($highestRiskPrediction->explanation)
                                    <ul class="list-group list-group-flush">
                                        @foreach($highestRiskPrediction->explanation as $key => $value)
                                            <li class="list-group-item px-0"><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ is_scalar($value) ? $value : json_encode($value) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No explanation details were stored for this prediction.</p>
                                @endif
                            @else
                                <p class="text-muted">No prediction has been recorded.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

@include('user.include.footer')

{{-- ApexCharts --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Failure Prediction Area Chart
    const predictionElement = document.querySelector('#failurePredictionChart');

    if (predictionElement && typeof ApexCharts !== 'undefined') {
        const predictionOptions = {
            series: [{
                name: 'Failure Probability',
                data: @json($chartPredictions->map(fn ($prediction) => (float) $prediction->probability * 100)->values())
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            colors: ['#dc3545'],
            xaxis: {
                categories: @json($chartPredictions->map(fn ($prediction) => $prediction->predicted_at?->format('M d') ?? 'Unknown')->values())
            },
            yaxis: {
                min: 0,
                max: 100,
                title: {
                    text: 'Failure Risk (%)'
                },
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value + '%';
                    }
                }
            }
        };

        new ApexCharts(predictionElement, predictionOptions).render();
    }

    // Failure Probability Gauge
    const gaugeElement = document.querySelector('#failureGauge');

    if (gaugeElement && typeof ApexCharts !== 'undefined') {
        const gaugeOptions = {
            series: [{{ $highestRiskPrediction ? (float) $highestRiskPrediction->probability * 100 : 0 }}],
            chart: {
                height: 250,
                type: 'radialBar'
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    hollow: {
                        size: '65%'
                    },
                    track: {
                        background: '#f1f1f1'
                    },
                    dataLabels: {
                        name: {
                            show: true,
                            fontSize: '16px',
                            offsetY: -10
                        },
                        value: {
                            fontSize: '28px',
                            fontWeight: 700,
                            formatter: function (value) {
                                return value + '%';
                            }
                        }
                    }
                }
            },
            colors: ['#dc3545'],
            labels: ['Failure Risk']
        };

        new ApexCharts(gaugeElement, gaugeOptions).render();
    }
});
</script>
