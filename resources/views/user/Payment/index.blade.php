<?php
$page_title = "Payment";
?>

@include('user.include.header')

<div class="page-content">


    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="headings">Overview</h4>
        </div>
    </div>
    <div class="container py-2">
        <div class="row g-3">
            <!-- Total charging station -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">Total
                                    charging
                                    station</p>
                                <h2 class="mb-0 " style="text-align:left">12</h2>

                            </div>
                            <div>
                                <div class="progress-circle blue">
                                    <span>50%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total charger (in use) -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">Total
                                    charger
                                    (in use)</p>
                                <h2 class="mb-0 " style="text-align:left">10</h2>

                            </div>
                            <div>
                                <div class="progress-circle purple">
                                    <span>47%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total users -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">Total
                                    users</p>
                                <h2 class="mb-0 " style="text-align:left">25</h2>

                            </div>
                            <div>
                                <div class="progress-circle green">
                                    <span>45%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Electricity consumed (in kw) -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">
                                    Electricity
                                    consumed (in kw)</p>
                                <h2 class="mb-0 " style="text-align:left">20</h2>

                            </div>
                            <div>
                                <div class="progress-circle gray">
                                    <span>34%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total new users -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">Total
                                    new users
                                </p>
                                <h2 class="mb-0 " style="text-align:left">14</h2>

                            </div>
                            <div>
                                <div class="progress-circle teal">
                                    <span>64%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total duration -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">Total
                                    duration
                                </p>
                                <h2 class="mb-0 " style="text-align:left">2</h2>

                            </div>
                            <div>
                                <div class="progress-circle orange">
                                    <span>52%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- No. of charged vehicle -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left" style="font-size:14px;text-align:left">No. of
                                    charged
                                    vehicle</p>
                                <h2 class="mb-0 " style="text-align:left">23</h2>

                            </div>
                            <div>
                                <div class="progress-circle yellow">
                                    <span>55%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total charger (available) -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left"
                                    style="font-size:14px;text-align:left ;text-align:left">
                                    Total charger
                                    (available)</p>

                                <h2 class="mb-0 " style="text-align:left">15</h2>
                            </div>
                            <div>
                                <div class="progress-circle red">
                                    <span>61%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total booking request -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 " style="text-align:left"
                                    style="font-size:14px;text-align:left; text-align:left">Total booking
                                    request</p>
                                <h2 class="mb-0 " style="text-align:left">23</h2>


                            </div>
                            <div>
                                <div class="progress-circle blue2">
                                    <span>49%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slot available -->

        </div> <!-- Chart Placeholder -->
        <!-- Graphs Section -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card"></div>
                <div class="card-body">
                    <div id="chartContainer" style="height: 300px;"></div>
                </div>
            </div>
            <!-- Pie Chart Placeholder -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="mb-2">Total Revenue</h6>
                        <div id="pieChart" style="height: 250px;"></div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Total Rev. Users</span>
                                <span>2250/Kw</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Total Revenue</span>
                                <span>$3,150</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Slot avail.</span>
                                <span>82%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="text-white">Charging Booking Details</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Booking ID</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>User type</th>
                                <th>Vehical Name</th>
                                <th>Charger Name</th>
                                <th>Uses Data</th>
                                <th>Payments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Res - 1001</td>
                                <td>01:00am</td>
                                <td>2hr</td>
                                <td>Residence</td>
                                <td>Tesla</td>
                                <td>Standard range w/ccs</td>
                                <td>7.9 Kw</td>
                                <td>$ 20.00</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Emp - 2002</td>
                                <td>02:00pm</td>
                                <td>2hr</td>
                                <td>Public</td>
                                <td>Tesla</td>
                                <td>Standard range w/ccs</td>
                                <td>7.9 Kw</td>
                                <td>$ 22.00</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Res - 1002</td>
                                <td>03:00pm</td>
                                <td>2hr</td>
                                <td>Residence</td>
                                <td>Tesla</td>
                                <td>Standard range w/ccs</td>
                                <td>7.9 Kw</td>
                                <td>$ 21.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@include('user.include.footer')