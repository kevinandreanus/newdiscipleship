<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Discipleship APPS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Discipleship</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/icons/icon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/icons/icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('img/icons/icon-167x167.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/icon-180x180.png') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/baguetteBox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vanilla-dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.flexdatalist.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    @stack('custom-css')
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            color: white !important;
            border: 1px solid lightgrey !important;
            background-color: lightgrey !important;
            border-radius: 4px !important;
            padding: 5px !important;
            font-size: 12px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important;
            border: 1px solid lightgrey !important;
            background-color: rgba(110, 110, 250, 0.822) !important;
            border-radius: 4px !important;
            padding: 5px 5px !important;
            font-size: 12px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid lightgrey !important;
            background-color: white !important;
            background: rgb(68, 177, 245) !important;
            border-radius: 4px !important;
            padding: 5px 8px !important;
            font-size: 12px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
            border: 1px solid lightgrey !important;
            background-color: red !important;
            border-radius: 4px !important;
            background: rgba(6, 6, 255, 0.726) !important;
            padding: 5px 12px !important;
            font-size: 12px !important;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        .dataTables_info {
            margin-top: 5px !important;
            font-size: 12px !important;
        }

        table.dataTable th.dt-center,
        table.dataTable td.dt-center,
        table.dataTable td.dataTables_empty {
            font-size: 12px;
        }

        #editTable td {
            font-size: 12px !important;
        }

        #editTable_filter {
            font-size: 10px !important;
        }

        #editTable_length {
            font-size: 10px !important;
        }

        #editTable_paginate {
            margin-top: 10px !important;
        }

        #editTable thead {
            font-size: 12px !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <!-- Web App Manifest -->
    {{-- <link rel="manifest" href="manifest.json"> --}}
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- # Paste your Header Content from here -->
            <!-- # Header Five Layout -->
            <!-- # Copy the code from here ... -->
            <!-- Header Content -->
            <div
                class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Logo Wrapper -->
                <div class="logo-wrapper"><a href="/"><img src="{{ asset('img/core-img/logo.png') }}"
                            alt=""></a></div>
                <!-- Navbar Toggler -->
                <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
                    data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas"><span class="d-block"></span><span
                        class="d-block"></span><span class="d-block"></span></div>
            </div>
            <!-- # Header Five Layout End -->
        </div>
    </div>
    <!-- # Sidenav Left -->
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
        aria-labelledby="affanOffcanvsLabel">
        <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        <div class="offcanvas-body p-0">
            <!-- Side Nav Wrapper -->
            <div class="sidenav-wrapper">
                <!-- Sidenav Profile -->
                <div class="sidenav-profile bg-gradient">
                    <div class="sidenav-style1"></div>
                    <!-- User Thumbnail -->
                    <div class="user-profile">
                        @if (Auth::user())
                            <img src="{{ asset(Auth::user()->jemaat->profile_picture_url) }}" alt="">
                        @else
                            <img src="{{ asset('img/bg-img/2.jpg') }}" alt="">
                        @endif
                    </div>
                    <!-- User Info -->
                    <div class="user-info">
                        <h6 class="user-name mb-0">{{ Auth::user()->name ?? 'Guest' }}</h6>
                        {{-- <span>CEO, Designing World</span> --}}
                    </div>
                    <div class="div">
                        @if (Auth::user())
                            <a style="color: whitesmoke; font-size: 12px; cursor: pointer"
                                href="/edit-profile/{{ Crypt::encryptString(Auth::user()->id) }}"
                                id="viewProfile">View Profile</a>
                        @endif
                    </div>
                </div>
                <!-- Sidenav Nav -->
                <ul class="sidenav-nav ps-0">
                    <li><a href="/"><i class="fas fa-home"></i>Home</a></li>
                    <li>
                        @if (Auth::user())
                            <a href="/schedule/{{ Crypt::encryptString(Auth::user()->id) }}">
                                <i class="fas fa-calendar-alt"></i>Schedule
                            </a>
                        @else
                            <a href="/login">
                                <i class="fas fa-calendar-alt"></i>Schedule
                            </a>
                        @endif

                    </li>
                    <li><a href="/bible"><i class="fas fa-bible"></i>Bible
                            {{-- <span class="badge bg-success rounded-pill ms-2">100+</span> --}}
                        </a></li>
                    {{-- <li><a href="#"><i class="bi bi-cart-check"></i>Shop</a>
              <ul>
                <li><a href="page-shop-grid.html">Shop Grid</a></li>
                <li><a href="page-shop-list.html">Shop List</a></li>
                <li><a href="page-shop-details.html">Shop Details</a></li>
                <li><a href="page-cart.html">Cart</a></li>
                <li><a href="page-checkout.html">Checkout</a></li>
              </ul>
            </li> --}}
                    <li><a href="/assessment"><i class="fas fa-feather-alt"></i>Assessment</a></li>
                    <li><a href=""><i class="fas fa-cog"></i>Settings</a></li>
                    <li>
                        <div class="night-mode-nav"><i class="fas fa-moon"></i>Night Mode
                            <div class="form-check form-switch">
                                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                            </div>
                        </div>
                    </li>
                    @if (!Auth::user())
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                    @else
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i
                                    class="fas fa-sign-out-alt"></i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif

                </ul>
                <!-- Social Info -->
                <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a
                        href="#"><i class="bi bi-twitter"></i></a><a href="#"><i
                            class="bi bi-linkedin"></i></a></div>
                <!-- Copyright Info -->
                <div class="copyright-info">
                    <p>2021 &copy; Made by<a href="#">Love</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        @yield('content')
    </div>
    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav">
        <div class="container px-0">
            <!-- =================================== -->
            <!-- Paste your Footer Content from here -->
            <!-- =================================== -->
            <!-- Footer Content -->
            <div class="footer-nav position-relative">
                <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">
                            <i class="fas fa-home fa-xl"></i><span>Home</span></a></li>
                    <li class="{{ Request::is('schedule/*') ? 'active' : '' }}">
                        @if (Auth::user())
                            <a href="/schedule/{{ Crypt::encryptString(Auth::user()->id) }}">
                                <i class="fas fa-calendar-alt fa-xl"></i><span>Schedule</span>
                            </a>
                        @else
                            <a href="/login">
                                <i class="fas fa-calendar-alt fa-xl"></i><span>Schedule</span>
                            </a>
                        @endif

                    </li>
                    <li class="{{ Request::is('bible') || Request::is('bible/*') ? 'active' : '' }}"><a
                            href="/bible">
                            <i class="fas fa-bible fa-xl"></i><span>Bible</span></a></li>
                    <li class="{{ Request::is('assessment') || Request::is('assessment/*') ? 'active' : '' }}">
                        <a href="/assessment">
                            <i class="fas fa-feather-alt fa-xl"></i><span>Assessment</span></a>
                    </li>
                    <li><a href="">
                            <i class="fas fa-cog fa-xl"></i><span>Settings</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/slideToggle.min.js') }}"></script>
    <script src="{{ asset('js/internet-status.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/baguetteBox.min.js') }}"></script>
    {{-- <script src="{{ asset('js/countdown.js') }}"></script> --}}
    <script src="{{ asset('js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('js/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/magic-grid.min.js') }}"></script>
    <script src="{{ asset('js/dark-rtl.js') }}"></script>
    <script src="{{ asset('js/active.js') }}"></script>
    {{-- Custom JS --}}
    <script src="{{ asset('js/font-awesome.js') }}"></script>
    <script src="{{ asset('js/jquery.flexdatalist.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('custom-js')
    <!-- PWA -->
    {{-- <script src="js/pwa.js"></script> --}}
</body>

</html>
