
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
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/image/dg-favicon.jpeg">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

   <!-- vendor css -->
   <link href="{{url('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet"> -->
    <link href="{{url('assets/lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{url('assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/dashforge.auth.css')}}">
  </head>
  <style>
    .df-logo2 {
    font-weight: 700;
    font-size: 35px;
    letter-spacing: -1px;
    color: inherit;
    align-items: center;
    position: relative;
    color: #031a61;
}
.logo {
    margin-left: -400px;
    margin-top: 10px;
}
  </style>
  <body style="background-color:#EEEEEE">
     <div class="container text-center">
      <div class="logo">
        <img src="../../assets/image/eTab_logo_bg_remove.png" alt="" height="100px" width="120px">
        <!-- <span class="df-logo2">digivity<span> -->
      </div>
      </div>

    <div class="content content-fixed content-auth mt-0">

      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class=" align-items-center d-none d-lg-flex" style="width:50%" >
            <div class="mx-wd-600">
              <img src="/assets/image/side.avif" class="side-img" alt="" >
            </div>
          </div><!--media-body-->
          <div class="sign-wrapper">
            <div class="wd-100p">
              <h3 class="tx-color-01 mg-b-5">Sign In</h3>
              <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="form-group">
                <label>Email address*</label>
                <input type="email" name="email" class="form-control" placeholder="yourname@yourmail.com">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password*</label>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
              </div>
              <button type="submit" class="btn btn-brand-02 w-100">Sign In</button>
            </form>
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div>
    <!-- content -->




    <script src="{{url('assets/lib/jquery/jquery.min.js')}}"></script>
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
