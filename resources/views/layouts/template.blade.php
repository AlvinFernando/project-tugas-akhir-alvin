<!doctype html>
<html lang="en">
    <head>
        <title>@yield('sub-judul')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist-custom.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro&family=Teko:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200&display=swap" rel="stylesheet">

        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}">
        <style>
            body{
                font-family: 'Readex Pro', sans-serif;
            }

            .metric .icon{
                background-color: black;
            }
            .text-light{
                color: white;
            }

            .float-right{
                float: right;
            }

            .mt-2{
                margin-top: 18px;
            }

            .mb-2{
                margin-bottom: 24px;
            }

            .ml-mb{
                margin-left: 10px;
                margin-bottom: -10px;
            }

            .navbar-default .brand{
                padding: 10px 30px;
                margin-top: 15px;
                margin-left: 20px;
            }

            .mb-auto{
                margin-bottom: auto;
            }

            .float-right .mb-auto{
                margin-left: 100px;
            }

            .myhover{
                background-color: rgb(129, 214, 0);
                color:#ffffff;
            }
            .myhover:hover{
                background-color: rgb(190, 255, 93);
                color:#1d1d1d;
            }

            .back-hover{
                color: rgb(32, 32, 32);
            }
            .back-hover:hover{
                color: rgb(62, 216, 42);
            }
        </style>
    </head>

    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <!-- NAVBAR -->
            @include('layouts.includes._navbar')
            <!-- END NAVBAR -->
            <!-- LEFT SIDEBAR -->
            @include('layouts.includes._sidebar')
            <!-- END LEFT SIDEBAR -->
            <!-- MAIN -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                        <!-- OVERVIEW -->
                        <div class="panel panel-headline">
                            @yield('panel-heading')
                            <div class="panel-body">
                            @yield('content')
                            </div>
                        </div>
                        <!-- END OVERVIEW -->
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix"></div>
            <footer>
                <div class="container">
                    <p class="copyright">&copy; 2022 <a href="https://www.themeineed.com" target="_blank">Copyright</a>. @ Alvin Fernando</p>
                </div>
            </footer>
        </div>
        <!-- END WRAPPER -->

        <!-- Javascript -->
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/chartist/js/chartist.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
        <script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
        <script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if(Session::has('success'))
            <script>
                toastr.success("{!! Session::get('success') !!}")
            </script>
        @endif
        @if(Session::has('error'))
            <script>
                toastr.error("{!! Session::get('error') !!}")
            </script>
        @endif
    </body>
</html>
