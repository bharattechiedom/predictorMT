


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta -->
    <title>PredictorMT | AI-Powered Predictive Maintenance & Industrial IoT Solutions</title>

    <meta name="title" content="PredictorMT | AI-Powered Predictive Maintenance & Industrial IoT Solutions">
    <meta name="description" content="PredictorMT provides AI-powered predictive maintenance, industrial IoT monitoring, machine simulation, sensor analytics, MQTT integration, and real-time dashboards to improve equipment reliability and reduce downtime.">
    <meta name="keywords" content="PredictorMT, Predictive Maintenance, Industrial IoT, AI Monitoring, Machine Health, Sensor Analytics, MQTT, Smart Factory, Industry 4.0, Equipment Monitoring">
    <meta name="author" content="PredictorMT Tech Solutions Inc.">
    <meta name="robots" content="noindex, nofollow">
    <!-- Canonical -->
    <link rel="canonical" href="https://predictormt.ca/">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('public/assets/images/favicon.png') }}">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="PredictorMT | AI-Powered Predictive Maintenance">
    <meta property="og:description"
        content="Real-time machine monitoring, AI-powered predictive maintenance, industrial IoT solutions, and intelligent analytics.">
    <meta property="og:url" content="https://predictormt.ca/">
    <meta property="og:image" content="https://predictormt.ca/assets/images/og-image.jpg">
    <meta property="og:site_name" content="PredictorMT">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="PredictorMT | AI-Powered Predictive Maintenance">
    <meta name="twitter:description"
        content="Industrial IoT, AI monitoring, machine analytics, predictive maintenance, and smart factory solutions.">
    <meta name="twitter:image" content="https://predictormt.ca/assets/images/og-image.jpg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cal+Sans&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/slicknav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/mousecursor.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet">

</head>


<body>



 <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset('public/assets/images/favicon.png') }}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
	<header class="main-header">
		<div class="header-sticky">
			<nav class="navbar navbar-expand-lg mx-0 mx-md-5">
				<div class="container-fluid">
					<!-- Logo Start -->
          <a class="navbar-brand" href="{{ route('home') }}">
              <img src="{{ asset('public/assets/images/logo.png') }}" alt="Logo" height="80">
            </a>
            <!-- Logo End -->

                    <!-- Main Menu Start -->
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            @php

                            $currentRoute = Request::route()->getName();

                            @endphp
                            <ul class="navbar-nav">
                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == '/' ? 'active' : '' }}" href="{{ route('home') }}">Home</a> </li>
                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == 'about' ? 'active' : '' }}" href="{{ route('about') }}">About</a> </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ $currentRoute == 'product' ? 'active' : '' }}"
                                  href="{{ route('product') }}"
                                  data-toggle="dropdown"
                                  role="button"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                  Product
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark">
                                  <li><a class="dropdown-item" href="{{ route('product') }}">Maintanance & Solution</a></li>
                                  <li><a class="dropdown-item" href="{{ route('product') }}">Industrial Electronics</a></li>
                                  <li><a class="dropdown-item" href="{{ route('product') }}">Data & Analytics Software</a></li>

                                </ul>
                              </li>




                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == 'solution' ? 'active' : '' }}" href="{{ route('solution') }}">Solution</a> </li>

                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == 'service' ? 'active' : '' }}" href="{{ route('service') }}">Services</a> </li>

                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ $currentRoute == 'industries' ? 'active' : '' }}"
                                  href="{{ route('industries') }}"
                                  data-toggle="dropdown"
                                  role="button"
                                  aria-haspopup="true"
                                  aria-expanded="false">
                                  Industries
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark">
                                  <li><a class="dropdown-item" href="{{ route('industries') }}">Mining
                                      Exploration</a></li>
                                  <li><a class="dropdown-item" href="{{ route('industries') }}">Trucking
                                      Companies</a></li>
                                  <li><a class="dropdown-item" href="{{ route('industries') }}">Our
                                      Manufacturers</a></li>
                                  <li><a class="dropdown-item" href="{{ route('industries') }}">Agriculture
                                      Equipment</a></li>
                                  <li><a class="dropdown-item" href="{{ route('industries') }}">Our
                                      Warehousing</a></li>
                                </ul>
                              </li>


                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == 'why_predictor' ? 'active' : '' }}" href="{{ route('why_predictor') }}">Why PredictorMT</a> </li>

                              <li class="nav-item"> <a class="nav-link {{ $currentRoute == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a> </li>


                            </ul>
                        </div>
                        
                        <!-- Header Btn Start -->
                        <div class="header-btn">
                            <a class="btn-default" href="{{ route('demo') }}">Request A Demo</a>
                            @auth

          <div class="dropdown">
            <button class="btn_join dropdown-toggle acc-btn"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              My Account
            </button>

            <ul class="dropdown-menu dropdown-menu-end accountDropdown">
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
          </div>


          @else

          <a href="{{ route('signin') }}" class="btn-default">

            <i class="fa fa-user"></i> Sign In

          </a>

          @endauth
                        </div>
                        <!-- Header Btn End -->
                    </div>
					<!-- Main Menu End -->
					<div class="navbar-toggle"></div>
				</div>
			</nav>
			<div class="responsive-menu"></div>
		</div>
	</header>
	<!-- Header End -->
