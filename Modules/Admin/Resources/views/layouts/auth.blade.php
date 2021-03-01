<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ admin_image('favicon.png') }}">
		<!-- App css -->
		<link href="{{ admin_css('bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ admin_css('app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="{{ admin_css('bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{ admin_css('app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />
		<!-- icons -->
		<link href="{{ admin_css('icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ admin_css('style.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="authentication-bg authentication-bg-pattern">
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                @yield('content')
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        <footer class="footer footer-alt">
            {{ date('Y') }} &copy; {{ config('app.name') }}
        </footer>
        <!-- Vendor js -->
        <script src="{{ admin_js('vendor.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ admin_js('app.min.js') }}"></script>
        <script src="{{ admin_js('scripts.js') }}"></script>
    </body>
</html>