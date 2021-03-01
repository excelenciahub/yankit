<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ admin_image('favicon.png') }}">
        <!-- third party css -->
        <link href="{{ admin_plugin('datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_plugin('datetimepicker/datetimepicker.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- Sweet Alert-->
        <link href="{{ admin_plugin('sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="{{ admin_css('bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ admin_css('app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="{{ admin_css('bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{ admin_css('app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />
		<!-- icons -->
        <link href="{{ admin_css('icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_css('style.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="pro-user-name ml-1">
                                {{ auth()->guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                <!-- item-->
                                <a href="{{ route('admin.profile.index') }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Profile</span>
                                </a>
                                <!-- item-->
                                <a href="{{ route('admin.profile.change-password') }}" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Change Password</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <!-- item-->
                                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
                                {{ Form::open(['route'=>'admin.logout','id'=>'logout-form']) }}
                                {{ Form::close() }}
                            </div>
                        </li>
                    </ul>
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="#" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ admin_image('favicon.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ admin_image('logo.png') }}" alt="" height="20">
                            </span>
                        </a>
                    </div>
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <div class="h-100" data-simplebar>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul id="side-menu">
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i data-feather="airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.airport.index') }}">
                                    <i data-feather="server"></i>
                                    <span> Airport </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.package.index') }}">
                                    <i data-feather="package"></i>
                                    <span> Package </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.traveller.index') }}">
                                    <i data-feather="globe"></i>
                                    <span> Traveller </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sender.index') }}">
                                    <i data-feather="send"></i>
                                    <span> Sender </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.journey.index') }}">
                                    <i data-feather="layers"></i>
                                    <span> Journey </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.order.index') }}">
                                    <i data-feather="link"></i>
                                    <span> Order </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">@yield('breadcrumb')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- Start Body Part -->
                        @yield('content')
                        <!-- End Body Part -->
                    </div> <!-- container -->
                </div> <!-- content -->
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                Copyright &copy; {{ config('app.name') }} {{ date('Y') }}. All rights reserved.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <!-- Vendor js -->
        <script src="{{ admin_js('vendor.min.js') }}"></script>
        <!-- third party js -->
        <script src="{{ admin_plugin('datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ admin_plugin('datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ admin_plugin('datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ admin_plugin('datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ admin_plugin('select2/select2.min.js') }}"></script>
        <script src="{{ admin_plugin('flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ admin_plugin('datetimepicker/datetimepicker.js') }}"></script>
        <!-- Sweet Alerts js -->
        <script src="{{ admin_plugin('sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ admin_js('app.min.js') }}"></script>
        <script src="{{ admin_js('scripts.js') }}"></script>
        @yield('styles')
        @yield('scripts')
    </body>
</html>
