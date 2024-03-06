<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

    <!-- vendor css -->
    <link href="{{url('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet"> -->
    <link href="{{url('assets/lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/dashforge.auth.css')}}">
  </head>
  <body>

  <div class="content content-fixed">
  @yield('content')
  </div>


    <script src="{{aurl'assets/lib/jquery/jquery .min.js')}}"></script>
    <script src="{{url('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/lib/feather-icons/feather.min.js')}}"></script>
    <script src="{{url('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{url('assets/js/dashforge.js')}}"></script>

    <!-- append theme customizer -->
    <script src="{{url('assets/lib/js-cookie/js.cookie.js')}}"></script>
    <script src="{{url('assets/js/dashforge.settings.js')}}"></script>
    <script>
      $(function(){
        'use script'

        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }
      })
    </script>
  </body>
</html>
