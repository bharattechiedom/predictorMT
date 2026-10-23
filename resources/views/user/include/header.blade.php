<!DOCTYPE html>
<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo isset($page_title) ? ucfirst($page_title) : 'predictorMt'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">

  <!-- App favicon -->

  <link rel="shortcut icon" href="{{ asset('public/assets/images/predictorMt-Technologies.png') }}">
  
  <!-- Vendor css -->

  <link href="{{ asset('public/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">

  <!-- App css -->

  <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">

  

  <!-- Icons css -->
     <link href="{{ asset('public/assets/css/remixicon.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">



  <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('public/assets/css/user-custom.css') }}" rel="stylesheet" type="text/css">



</head>



<body>



  <header class="header_top">

    <nav class="navbar navbar-expand-lg">

      <div class="container-fluid headr">

        <!-- Logo Left -->

        <!-- <a class="navbar-brand" href="{{ route('user.dashboard') }}">

          <img src="{{ asset('public/assets/images/predictorMt-logo.png') }}" alt="">

        </a> -->



        <!-- Toggle Button -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

          <span class="navbar-toggler-icon"></span>

        </button>



        <!-- Navbar Content -->

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

          <!-- Center Nav Links -->

          @php

          $currentRoute = Request::route()->getName();

          @endphp



          <!-- <ul class="navbar-nav mx-auto text-center">

            <li class="nav-item">

              <a class="nav-link {{ $currentRoute == 'user.dashboard' ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>

            </li>

            <li class="nav-item">

              <a class="nav-link {{ $currentRoute == 'user.machines.index' ? 'active' : '' }}" href="{{ route('user.machines.index') }}">Machines</a>

            </li>

            <li class="nav-item">

              <a class="nav-link {{ $currentRoute == 'user.sensors.index' ? 'active' : '' }}" href="{{ route('user.sensors.index') }}">Sensors</a>

            </li>

            <li class="nav-item">

              <a class="nav-link {{ $currentRoute == 'user.predictions.index' ? 'active' : '' }}" href="{{ route('user.predictions.index') }}">Predictions</a>

            </li>

            <li class="nav-item">

              <a class="nav-link {{ $currentRoute == 'user.maintenance-tasks.index' ? 'active' : '' }}" href="{{ route('user.maintenance-tasks.index') }}">Maintenance</a>

            </li>

            @if(Route::has('user.alerts.index'))

            <li class="nav-item">

              <a class="nav-link {{ str_contains($currentRoute, 'user.alerts') ? 'active' : '' }}" href="{{ route('user.alerts.index') }}">Alerts</a>

            </li>

            @endif

            @if(Route::has('user.reports.index'))

            <li class="nav-item">

              <a class="nav-link {{ str_contains($currentRoute, 'user.reports') ? 'active' : '' }}" href="{{ route('user.reports.index') }}">Reports</a>

            </li>

            @endif

            @if(Route::has('user.billing.index'))

            <li class="nav-item">

              <a class="nav-link {{ str_contains($currentRoute, 'user.billing') ? 'active' : '' }}" href="{{ route('user.billing.index') }}">Billing</a>

            </li>

            @endif

          </ul> -->

          <div class="btn_grp d-flex align-items-center gap-2">

          <div class="d-flex align-items-center p-0">


    <!-- Notification -->
    <div class="dropdown">

        <button class="btn position-relative p-0"
            data-bs-toggle="dropdown"
            aria-expanded="false">

            <i class="fas fa-bell fs-4"></i>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5
            </span>

        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow" style="width:350px;">

            <li>
                <h6 class="dropdown-header fw-bold">
                    <i class="fas fa-bell me-2"></i>
                    Notifications
                </h6>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item py-1" href="#">
                    <div class="d-flex">

                        <div class="me-3">
                            <i class="fas fa-temperature-high text-danger fs-5"></i>
                        </div>

                        <div>
                            <strong>High Temperature</strong><br>
                            <small class="text-muted">
                                Motor 01 reached 68°C
                            </small><br>
                            <small class="text-secondary">
                                2 min ago
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li>
                <a class="dropdown-item py-1" href="#">
                    <div class="d-flex">

                        <div class="me-3">
                            <i class="fas fa-gauge-high text-warning fs-5"></i>
                        </div>

                        <div>
                            <strong>Pressure Drop</strong><br>
                            <small class="text-muted">
                                Pump 02 pressure below threshold
                            </small><br>
                            <small class="text-secondary">
                                5 min ago
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li>
                <a class="dropdown-item py-1" href="#">
                    <div class="d-flex">

                        <div class="me-3">
                            <i class="fas fa-triangle-exclamation text-danger fs-5"></i>
                        </div>

                        <div>
                            <strong>Machine Fault</strong><br>
                            <small class="text-muted">
                                Conveyor stopped unexpectedly
                            </small><br>
                            <small class="text-secondary">
                                15 min ago
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li>
                <a class="dropdown-item py-1" href="#">
                    <div class="d-flex">

                        <div class="me-3">
                            <i class="fas fa-screwdriver-wrench text-info fs-5"></i>
                        </div>

                        <div>
                            <strong>Maintenance Due</strong><br>
                            <small class="text-muted">
                                Generator scheduled today
                            </small><br>
                            <small class="text-secondary">
                                30 min ago
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li>
                <a class="dropdown-item py-1" href="#">
                    <div class="d-flex">

                        <div class="me-3">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                        </div>

                        <div>
                            <strong>System Healthy</strong><br>
                            <small class="text-muted">
                                All MQTT services connected
                            </small><br>
                            <small class="text-secondary">
                                1 hour ago
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a href="#" class="dropdown-item text-center fw-semibold text-dark">
                    View All Notifications
                </a>
            </li>

        </ul>

    </div>

</div>


          <div class="dropdown userDropdown-toggle">
            <button class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> User
            </button>

            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                  <i class="bi bi-speedometer2"></i> Dashboard
                </a>
              </li>
              <li>
                <a href="{{ route('user.profile') }}" class="dropdown-item"> 
                  <i class="fa fa-user"></i> Profile
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('user.logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </div>

          <!-- <div class="dropdown">
            <button class="btn_join dropdown-toggle acc-btn"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">
             
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                  Dashboard
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('user.logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item logout">
                    Logout
                  </button>
                </form>
              </li>
            </ul>
          </div> -->



            <!-- Profile Button -->

            <!-- <a href="{{ route('user.profile') }}" class="btn-custom me-2 d-flex align-items-center">

              <div class="icon-circle me-2">

                <i class="fa fa-user"></i>

              </div>

              <span>Profile</span>

            </a> -->



            <!-- Logout Button -->

            <!-- <form method="POST" action="{{ route('user.logout') }}" style="display: inline;">

              @csrf

              <button type="submit" class="btn-custom d-flex align-items-center" style="background: none; border: none; cursor: pointer;">

                <div class="icon-circle me-2">

                  <i class="fa fa-sign-out"></i>

                </div>

                <span>Log Out</span>

              </button>

            </form> -->

          </div>





        </div>

      </div>

    </nav>

  </header>

  <!-- Begin page -->

  <div class="wrapper active">



    <!-- Menu -->

    <!-- Sidenav Menu Start -->

    <div class="sidenav-menu show">



      <!-- Brand Logo -->
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">

          <img src="{{ asset('public/assets/user/images/footer-logo.png') }}" alt="">

        </a>



      <!-- Full Sidebar Menu Close Button -->

      <button class="button-close-fullsidebar">

        <i class="ri-close-line align-middle"></i>

      </button>



      <div data-simplebar="init" class="simplebar-scrollable-y">

        <div class="simplebar-wrapper active" style="margin: 0px;">

          <div class="simplebar-height-auto-observer-wrapper">

            <div class="simplebar-height-auto-observer"></div>

          </div>

          <div class="simplebar-mask show">

            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">

              <div class="simplebar-content-wrapper active" tabindex="0" role="region"

                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">

                <div class="simplebar-content show" style="padding: 0px;">



                  <!--- Sidenav Menu -->

                  <ul class="side-nav">

                    <li class="side-nav-item">
                      <a href="{{ route('user.dashboard') }}" class="side-nav-link {{ $currentRoute == 'user.dashboard' ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-gauge-high"></i></span>
                          <span class="menu-text">Dashboard</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <a href="{{ route('user.machines.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'machines') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-microchip"></i></span>
                          <span class="menu-text">Machine Management</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <a href="{{ route('user.sensors.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'sensors') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-wave-square"></i></span>
                          <span class="menu-text">Sensor Management</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <a href="simulation.blade.php" class="side-nav-link">
                          <span class="menu-icon"><i class="fas fa-flask"></i></span>
                          <span class="menu-text">Simulation</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <a href="{{ route('user.maintenance-tasks.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'maintenance') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-screwdriver-wrench"></i></span>
                          <span class="menu-text">Fault & Maintenance</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <a href="{{ route('user.predictions.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'prediction') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                          <span class="menu-text">Predictions</span>
                      </a>
                  </li>

                  @if(Route::has('user.alerts.index'))
                  <li class="side-nav-item">
                      <a href="{{ route('user.alerts.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'user.alerts') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-triangle-exclamation"></i></span>
                          <span class="menu-text">Alert</span>
                      </a>
                  </li>
                  @endif

                  @if(Route::has('user.reports.index'))
                  <li class="side-nav-item">
                      <a href="{{ route('user.reports.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'user.reports') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-chart-column"></i></span>
                          <span class="menu-text">Data & Reports</span>
                      </a>
                  </li>
                  @endif

                  @if(Route::has('user.billing.index'))
                  <li class="side-nav-item">
                      <a href="{{ route('user.billing.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'user.billing') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-credit-card"></i></span>
                          <span class="menu-text">Billing</span>
                      </a>
                  </li>
                  @endif

                  @if(Route::has('user.team.index'))
                  <li class="side-nav-item">
                      <a href="{{ route('user.team.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'user.team') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-users"></i></span>
                          <span class="menu-text">Team</span>
                      </a>
                  </li>
                  @endif

                  @if(Route::has('user.support.index'))
                  <li class="side-nav-item">
                      <a href="{{ route('user.support.index') }}" class="side-nav-link {{ str_contains($currentRoute, 'user.support') ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-headset"></i></span>
                          <span class="menu-text">Support</span>
                      </a>
                  </li>
                  @endif

                  <li class="side-nav-item">
                      <a href="{{ route('user.profile') }}" class="side-nav-link {{ $currentRoute == 'user.profile' ? 'active' : '' }}">
                          <span class="menu-icon"><i class="fas fa-gear"></i></span>
                          <span class="menu-text">Settings</span>
                      </a>
                  </li>

                  <li class="side-nav-item">
                      <form method="POST" action="{{ route('user.logout') }}">
                          @csrf
                          <button type="submit" class="dropdown-item logout text-danger py-2 px-3">
                              <i class="fas fa-right-from-bracket me-2"></i> Logout
                          </button>
                      </form>
                  </li>



                    

                  </ul>

                  <div class="clearfix"></div>

                </div>

              </div>

            </div>

          </div>

          <div class="simplebar-placeholder" style="width: 240px; height: 826px;"></div>

        </div>

        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">

          <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>

        </div>

        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">

          <div class="simplebar-scrollbar"

            style="height: 527px; transform: translate3d(0px, 0px, 0px); display: block;"></div>

        </div>

      </div>

    </div>

    <!-- Sidenav Menu End -->



    <!-- Topbar Start -->



    <!-- Topbar End -->