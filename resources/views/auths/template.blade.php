<!doctype html>
<html lang="en" class="fullscreen-bg">

      <head>
            <title>Login | E-Learning SKPK</title>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <!-- VENDOR CSS -->
            <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
            <!-- MAIN CSS -->
            <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
            <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
            <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
            <!-- GOOGLE FONTS -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

            <!-- ICONS -->
            <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
            <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}">
            <style>
                  body{
                        font-family: 'Josefin Sans', sans-serif;
                  }

                  .contentx{
                        margin-top: -390px;
                  }

                  .auth-box .right{
                        background-image: url('assets/img/skpk-place.jpeg');
                  }

                  .auth-box .right .overlay{
                        position: absolute;
                        top: 0;
                        display: block;
                        width: 100%;
                        height: 100%;
                        opacity: 0.8;
                        background:mediumseagreen;
                  }

                  .fnt{
                        font-size:large;
                  }

                  .mt-2{
                        margin-top: 10px;
                  }
            </style>
      </head>

      <body>
            <!-- WRAPPER -->
            @yield('content')
            <!-- END WRAPPER -->
      </body>
</html>