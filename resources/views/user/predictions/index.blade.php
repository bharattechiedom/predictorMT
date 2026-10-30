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
                                Predict machine failures and maintenance using AI models.
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
                                            <h3 class="fw-bold text-primary mb-0">254</h3>
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
                                            <p class="text-muted mb-1">Failure Risk</p>
                                            <h3 class="fw-bold text-danger mb-0">18%</h3>
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
                                            <h3 class="fw-bold text-success mb-0">12</h3>
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
                                            <p class="text-muted mb-1">Average RUL</p>
                                            <h3 class="fw-bold text-warning mb-0">120 Days</h3>
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
                                                    <th>Health</th>
                                                    <th>Failure Probability</th>
                                                    <th>Confidence</th>
                                                    <th>Prediction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Motor-01</td>
                                                    <td><span class="badge bg-success">96%</span></td>
                                                    <td>5%</td>
                                                    <td>99%</td>
                                                    <td><span class="badge bg-success">Healthy</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Pump-02</td>
                                                    <td><span class="badge bg-warning text-dark">82%</span></td>
                                                    <td>25%</td>
                                                    <td>96%</td>
                                                    <td><span class="badge bg-warning text-dark">Monitor</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Fan-01</td>
                                                    <td><span class="badge bg-danger">65%</span></td>
                                                    <td>72%</td>
                                                    <td>98%</td>
                                                    <td><span class="badge bg-danger">Failure Likely</span></td>
                                                </tr>
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
                                                    <td>Motor-01</td>
                                                </tr>
                                                <tr>
                                                    <th>Recommendation</th>
                                                    <td>Replace Bearing</td>
                                                </tr>
                                                <tr>
                                                    <th>Priority</th>
                                                    <td><span class="badge bg-danger">High</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Due</th>
                                                    <td>Within 5 Days</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn theme-btn w-100">
                                        <i class="fa-solid fa-calendar-check me-1"></i>
                                        Schedule Maintenance
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Failure Prediction Chart and RUL --}}
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
                                        Remaining Useful Life
                                    </h5>
                                </div>

                                <div class="card-body text-center mt-3">
                                    <h2 class="display-4 fw-bold text-success mb-1">120</h2>
                                    <p class="text-muted mb-3">Days Remaining</p>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Machine</th>
                                                    <td>Motor-01</td>
                                                </tr>
                                                <tr>
                                                    <th>Health</th>
                                                    <td>96%</td>
                                                </tr>
                                                <tr>
                                                    <th>Confidence</th>
                                                    <td>98%</td>
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

                                    <h3 class="fw-bold text-danger mb-2">28%</h3>
                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        Medium Risk
                                    </span>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Machine</th>
                                                    <td>Motor-01</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><span class="badge bg-success">Running</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Next Review</th>
                                                    <td>Today 05:00 PM</td>
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
                                        AI Confidence Score
                                    </h5>
                                </div>

                                <div class="card-body text-center mt-3">
                                    <div class="display-2 fw-bold text-success">98%</div>

                                    <p class="text-muted">
                                        AI model confidence for current prediction
                                    </p>

                                    <div class="progress mb-4" style="height: 12px;">
                                        <div class="progress-bar bg-success"
                                             role="progressbar"
                                             style="width: 98%;"
                                             aria-valuenow="98"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm text-start mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Model</th>
                                                    <td>LSTM v2.1</td>
                                                </tr>
                                                <tr>
                                                    <th>Dataset</th>
                                                    <td>120K Records</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Trained</th>
                                                    <td>29 Jul 2026</td>
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
                                                <tr>
                                                    <td>Motor-01</td>
                                                    <td><span class="badge bg-success">Low</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Pump-02</td>
                                                    <td><span class="badge bg-warning text-dark">Medium</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Fan-01</td>
                                                    <td><span class="badge bg-danger">High</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Generator-01</td>
                                                    <td><span class="badge bg-primary">Stable</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary w-100">
                                        View Complete Risk Analysis
                                    </button>
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
                                    <strong>12 Sep 2025:</strong>
                                    Temperature fluctuations detected.
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>14 Sep 2025:</strong>
                                    Battery performance dropped below threshold.
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>18 Sep 2025:</strong>
                                    Signal interruptions observed.
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>20 Sep 2025:</strong>
                                    Device shutdown and failure recorded.
                                </li>
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
                                <li class="list-group-item px-0">
                                    <i class="fa-solid fa-check text-success me-2"></i>
                                    Replace batteries in Sensor Cluster B immediately.
                                </li>
                                <li class="list-group-item px-0">
                                    <i class="fa-solid fa-check text-success me-2"></i>
                                    Schedule preventive maintenance in Facility B within 48 hours.
                                </li>
                                <li class="list-group-item px-0">
                                    <i class="fa-solid fa-check text-success me-2"></i>
                                    Update firmware to the latest release (v2.4.1).
                                </li>
                                <li class="list-group-item px-0">
                                    <i class="fa-solid fa-check text-success me-2"></i>
                                    Monitor data transmission intervals every 6 hours.
                                </li>
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
                            <p>
                                Machine Learning Model <strong>“FailurePredict-v3”</strong>
                                identified a <strong>92% probability</strong> of failure based on:
                            </p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <strong>Sensor Drift:</strong> 45% influence
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Temperature Variation:</strong> 30% influence
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Battery Health:</strong> 15% influence
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Firmware Latency:</strong> 10% influence
                                </li>
                            </ul>
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
                data: [5, 8, 12, 18, 22, 28, 35]
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
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            yaxis: {
                min: 0,
                max: 40,
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
            series: [28],
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
