<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="{{ asset('public/assets/images/predictorMt-Technologies.png') }}">

    <title>Predictormt - Dashboard</title>

    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/dashboard.css') }}" rel="stylesheet">
   

</head>

<body>

    <div class="container-fluid dashboard-page">

        <div class="row">

            <!-- Sidebar -->

            <div class="col-md-3 col-lg-2 px-0">

                <div class="sidebar">

                    <div class="p-3">

                        <h4 class="text-center mb-4">

                          

                           <a class="navbar-brand" href="{{ route('user.dashboard') }}">

          <img src="{{ asset('public/assets/user/images/footer-logo.png') }}" alt="">

        </a>

                        </h4>

                        <nav class="nav flex-column">

                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">

                                <i class="fa-solid fa-table-columns"></i>

                                Dashboard

                            </a>

                            

                            <div class="nav-section">

                                <h6 class="nav-section-title">Core Data</h6>

                                <a class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}" href="{{ route('admin.companies.index') }}">

                                    <i class="fas fa-building me-2"></i>

                                    Companies

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}" href="{{ route('admin.plans.index') }}">

                                    <i class="fas fa-tags me-2"></i>

                                    Plans

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">

                                    <i class="fas fa-users me-2"></i>

                                    Users

                                </a>

                            </div>



                            <div class="nav-section">

                                <h6 class="nav-section-title">Machines & Sensors</h6>

                                <a class="nav-link {{ request()->routeIs('admin.machines.*') ? 'active' : '' }}" href="{{ route('admin.machines.index') }}">

                                    <i class="fas fa-cogs me-2"></i>

                                    Machines

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.sensors.*') ? 'active' : '' }}" href="{{ route('admin.sensors.index') }}">

                                    <i class="fas fa-microchip me-2"></i>

                                    Sensors

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.sensor-readings.*') ? 'active' : '' }}" href="{{ route('admin.sensor-readings.index') }}">

                                    <i class="fas fa-chart-line me-2"></i>

                                    Sensor Readings

                                </a>

                            </div>



                            <div class="nav-section">

                                <h6 class="nav-section-title">Predictions & Alerts</h6>

                                <a class="nav-link {{ request()->routeIs('admin.predictions.*') ? 'active' : '' }}" href="{{ route('admin.predictions.index') }}">

                                    <i class="fas fa-brain me-2"></i>

                                    Predictions

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.alerts.*') ? 'active' : '' }}" href="{{ route('admin.alerts.index') }}">

                                    <i class="fas fa-exclamation-triangle me-2"></i>

                                    Alerts

                                </a>

                            </div>



                            <div class="nav-section">

                                <h6 class="nav-section-title">Maintenance</h6>

                                <a class="nav-link {{ request()->routeIs('admin.maintenance-tasks.*') ? 'active' : '' }}" href="{{ route('admin.maintenance-tasks.index') }}">

                                    <i class="fas fa-wrench me-2"></i>

                                    Maintenance Tasks

                                </a>

                            </div>



                            <div class="nav-section">

                                <h6 class="nav-section-title">Billing & Support</h6>

                                <a class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}" href="{{ route('admin.subscriptions.index') }}">

                                    <i class="fas fa-credit-card me-2"></i>

                                    Subscriptions

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}" href="{{ route('admin.invoices.index') }}">

                                    <i class="fas fa-file-invoice me-2"></i>

                                    Invoices

                                </a>

                                <a class="nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">

                                    <i class="fas fa-ticket-alt me-2"></i>

                                    Support Tickets

                                </a>

                            </div>



                            <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">

                            <a class="nav-link" href="{{ route('admin.logout') }}" 

                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                <i class="fas fa-sign-out-alt me-2"></i>

                                Logout

                            </a>

                        </nav>

                    </div>

                </div>

            </div>