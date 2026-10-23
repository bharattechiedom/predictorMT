<!doctype html>



<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{{ asset('assets/user/images/favicon.ico') }}" />

  <title>PredictorMT Tech Solution INC.</title>

  <link href="{{ asset('public/assets/user/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/user/css/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/user/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('public/assets/user/css/animate.css') }}" rel="stylesheet">

  <link href="{{ asset('public/assets/user/css/owl-carousel.css') }}" rel="stylesheet">

  <link href="{{ asset('public/assets/user/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/user/css/responsive.css') }}" rel="stylesheet">
</head>

<body>



  <header class="header_top">

    <nav class="navbar navbar-expand-lg">
      <div class="container headr justify-content-between">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset('public/assets/user/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">

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
        <div class="btn_grp">

          <a class="btnLogin" href="{{ route('demo') }}">Request A Demo</a>




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

          <a href="{{ route('signin') }}" class="btnLogin btn_join">

            <i class="fa fa-user" style="color: white; margin-right: 6px;"></i> Sign In

          </a>

          @endauth



        </div>
    </nav>
    </div>

  </header>