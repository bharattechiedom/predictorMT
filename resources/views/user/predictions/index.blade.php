<?php

$page_title = "Failure Insights";

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

                  <h3 class="mb-1">AI Prediction Dashboard</h3>

            <p class="text-muted mb-0">
                Predict machine failures and maintenance using AI models.
            </p>

              

            </div>

          </div>


          <div class="container-fluid mt-4">



    <!-- KPI Cards -->

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0 bg-primary bg-opacity-10">

                <div class="card-body bg-white">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                AI Predictions
                            </small>

                            <h3 class="fw-bold text-primary">
                                254
                            </h3>

                        </div>

                        <i class="fas fa-brain fa-2x text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0 bg-danger bg-opacity-10">

                <div class="card-body bg-white">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Failure Risk
                            </small>

                            <h3 class="fw-bold text-danger">
                                18%
                            </h3>

                        </div>

                        <i class="fas fa-triangle-exclamation fa-2x text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0 bg-success bg-opacity-10">

                <div class="card-body bg-white">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Predictive Maintenance
                            </small>

                            <h3 class="fw-bold text-success">
                                12
                            </h3>

                        </div>

                        <i class="fas fa-screwdriver-wrench fa-2x text-success"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0 bg-warning bg-opacity-10">

                <div class="card-body bg-white">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Avg. RUL
                            </small>

                            <h3 class="fw-bold text-warning">
                                120 Days
                            </h3>

                        </div>

                        <i class="fas fa-hourglass-half fa-2x text-warning"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="row">

        <!-- AI Prediction -->

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-brain me-2"></i>

                        AI Prediction

                    </h5>

                </div>

                <div class="card-body bg-white">

                    <div class="table-responsive">

                        <table class="table table-hover">

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

                                    <td>
                                        <span class="badge bg-success">
                                            96%
                                        </span>
                                    </td>

                                    <td>
                                        5%
                                    </td>

                                    <td>
                                        99%
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            Healthy
                                        </span>
                                    </td>

                                </tr>

                                <tr>

                                    <td>Pump-02</td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            82%
                                        </span>
                                    </td>

                                    <td>
                                        25%
                                    </td>

                                    <td>
                                        96%
                                    </td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            Monitor
                                        </span>
                                    </td>

                                </tr>

                                <tr>

                                    <td>Fan-01</td>

                                    <td>
                                        <span class="badge bg-danger">
                                            65%
                                        </span>
                                    </td>

                                    <td>
                                        72%
                                    </td>

                                    <td>
                                        98%
                                    </td>

                                    <td>
                                        <span class="badge bg-danger">
                                            Failure Likely
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>



            <!-- Failure Prediction -->

            <div class="card shadow-sm border-0">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-chart-line me-2"></i>

                        Failure Prediction

                    </h5>

                </div>

                <div class="card-body bg-white">

                    <div id="failurePredictionChart" style="height:300px;"></div>

                </div>

            </div>

        </div>



        <!-- Right Side -->

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-tools me-2"></i>

                        Predictive Maintenance

                    </h5>

                </div>

                <div class="card-body bg-white">

                    <table class="table table-borderless">

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

                            <td>
                                <span class="badge bg-danger">
                                    High
                                </span>
                            </td>

                        </tr>

                        <tr>

                            <th>Due</th>

                            <td>Within 5 Days</td>

                        </tr>

                    </table>

                    <button class="btn btn-primary w-100">
                        Schedule Maintenance
                    </button>

                </div>

            </div>



            <div class="card shadow-sm border-0">

                <div class="card-header">

                    <h5 class="mb-0 text-white">

                        <i class="fas fa-hourglass-half me-2"></i>

                        Remaining Useful Life (RUL)

                    </h5>

                </div>

                <div class="card-body text-center bg-white">

                    <h1 class="display-4 fw-bold text-success">
                        120
                    </h1>

                    <h5 class="text-muted">
                        Days Remaining
                    </h5>

                    <hr>

                    <table class="table table-sm">

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

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row mt-4">

    <!-- Failure Probability Gauge -->
    <div class="col-lg-4">

        <div class="card shadow-sm border-0 h-100">

            <div class="card-header">
                <h5 class="mb-0 text-white">
                    <i class="fas fa-bullseye me-2"></i>
                    Failure Probability
                </h5>
            </div>

            <div class="card-body text-center bg-white">

                <div id="failureGauge" style="height:250px;"></div>

                <h2 class="fw-bold text-danger mb-1">
                    28%
                </h2>

                <span class="badge bg-warning text-dark px-3 py-2">
                    Medium Risk
                </span>

                <hr>

                <table class="table table-borderless table-sm mb-0">

                    <tr>
                        <th>Machine</th>
                        <td>Motor-01</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                Running
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Next Review</th>
                        <td>Today 05:00 PM</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>



    <!-- AI Confidence Score -->

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 h-100">

            <div class="card-header">

                <h5 class="mb-0 text-white">

                    <i class="fas fa-brain me-2"></i>

                    AI Confidence Score

                </h5>

            </div>

            <div class="card-body text-center bg-white">

                <div class="display-2 fw-bold text-success">

                    98%

                </div>

                <p class="text-muted">

                    AI model confidence for current prediction

                </p>

                <div class="progress mb-3" style="height:12px;">

                    <div class="progress-bar bg-success"
                         style="width:98%">
                    </div>

                </div>

                <table class="table table-borderless table-sm">

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

                </table>

            </div>

        </div>

    </div>



    <!-- Machine Risk Matrix -->

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 h-100">

            <div class="card-header">

                <h5 class="mb-0 text-white">

                    <i class="fas fa-table-cells-large me-2"></i>

                    Machine Risk Matrix

                </h5>

            </div>

            <div class="card-body bg-white">

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

                            <td>
                                <span class="badge bg-success">
                                    Low
                                </span>
                            </td>

                        </tr>

                        <tr>

                            <td>Pump-02</td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Medium
                                </span>
                            </td>

                        </tr>

                        <tr>

                            <td>Fan-01</td>

                            <td>
                                <span class="badge bg-danger">
                                    High
                                </span>
                            </td>

                        </tr>

                        <tr>

                            <td>Generator-01</td>

                            <td>
                                <span class="badge bg-primary">
                                    Stable
                                </span>
                            </td>

                        </tr>

                    </tbody>

                </table>

                <button class="btn btn-outline-primary w-100">

                    View Complete Risk Analysis

                </button>

            </div>

        </div>

    </div>

</div>


          <!-- Filters Row -->

          <div class="container-fluid mt-3 mb-4">

            <div class="row align-items-center">

              <div class="col-lg-8 col-md-12">

                <div class="row g-3">

                  <div class="col-lg-3 col-md-6">

                    <input type="text" class="form-control" placeholder="Failure ID">

                  </div>

                  <div class="col-lg-3 col-md-6">

                    <input type="date" class="form-control">

                  </div>

                  <div class="col-lg-3 col-md-6">

                    <select class="form-select">

                      <option selected="">Facility</option>

                      <option>Plant A</option>

                      <option>Plant B</option>

                      <option>Plant C</option>

                    </select>

                  </div>

                </div>

              </div>



              <!-- Right Buttons -->

             

            </div>

          </div>



          <!-- Main Cards Section -->

          <div class="col-md-12">



            <!-- 1. Failure Timeline -->

            <div class="card mb-3">

              <div class="card-header bg-light">

                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Failure Timeline</h5>

              </div>

              <div class="card-body bg-white">

                <p class="text-white mb-2">Chronological sequence of events leading to failure:</p>

                <ul class="list-unstyled mb-0 text-white">

                  <li><strong>12 Sep 2025:</strong><span class="text-white"> Temperature fluctuations detected </span></li>

                  <li><strong>14 Sep 2025:</strong> <span class="text-white"> Battery performance dropped below threshold </span></li>

                  <li><strong>18 Sep 2025:</strong> <span class="text-white"> Signal interruptions observed </span></li>

                  <li><strong>20 Sep 2025:</strong> <span class="text-white">Device shutdown and failure recorded </span></li>

                </ul>

              </div>

            </div>



            <!-- 2. Recommendations -->

            <div class="card mb-3">

              <div class="card-header bg-light">

                <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Recommendations</h5>

              </div>

              <div class="card-body bg-white">

                <ul class="list-unstyled mb-0 text-white">

                  <li class="text-white">✔ Replace batteries in Sensor Cluster B immediately.</li>

                  <li class="text-white">✔ Schedule preventive maintenance in Facility B within 48 hours.</li>

                  <li class="text-white">✔ Update firmware version to latest release (v2.4.1).</li>

                  <li class="text-white">✔ Monitor data transmission intervals every 6 hours.</li>

                </ul>

              </div>

            </div>



            <!-- 3. ML Explanation -->

            <div class="card mb-3">

              <div class="card-header bg-light">

                <h5 class="mb-0"><i class="bi bi-cpu me-2"></i>ML Explanation</h5>

              </div>

              <div class="card-body bg-white">

                <p class="text-white ">

                  Machine Learning Model <strong>“FailurePredict-v3”</strong> identified a <strong>92% probability</strong> 

                  of failure based on:

                </p>

                <ul class="list-unstyled text-white">

                  <li>• <strong>Sensor Drift:</strong> <span class="text-white"> 45% influence </span></li>

                  <li>• <strong>Temperature Variation:</strong> <span class="text-white"> 30% influence </span></li>

                  <li>• <strong>Battery Health:</strong> <span class="text-white"> 15% influence </span></li>

                  <li>• <strong>Firmware Latency:</strong> <span class="text-white"> 10% influence </span></li>

                </ul>

              

              </div>

            </div>



          </div> <!-- /col-md-12 -->



        </div> <!-- /row -->

      </div> <!-- /page-container -->

    </div> <!-- /page-content -->

  </div> <!-- /wrapper -->



 

</body>

@include('user.include.footer')

<script>

document.addEventListener("DOMContentLoaded", function () {

    var options = {

        series: [
            {
                name: "Failure Probability",
                data: [5, 8, 12, 18, 22, 28, 35]
            }
        ],

        chart: {
            type: "area",
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
            curve: "smooth",
            width: 3
        },

        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },

        colors: ["#dc3545"],

        xaxis: {
            categories: [
                "Mon",
                "Tue",
                "Wed",
                "Thu",
                "Fri",
                "Sat",
                "Sun"
            ]
        },

        yaxis: {
            min: 0,
            max: 40,
            title: {
                text: "Failure Risk (%)"
            }
        },

        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "%";
                }
            }
        }

    };

    var chart = new ApexCharts(
        document.querySelector("#failurePredictionChart"),
        options
    );

    chart.render();

});

</script>
<script>

document.addEventListener("DOMContentLoaded", function () {

    if(document.querySelector("#failureGauge")){

        var options = {

            series: [28],

            chart: {
                height: 280,
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
                            fontSize: '18px',
                            offsetY: -10
                        },

                        value: {
                            fontSize: '32px',
                            fontWeight: 700,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }

                    }

                }

            },

            colors: ['#dc3545'],

            labels: ['Failure Risk']

        };

        var chart = new ApexCharts(
            document.querySelector("#failureGauge"),
            options
        );

        chart.render();

    }

});

</script>