<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="/eTabFavicon.png"> --}}
    <link rel="icon" type="image/png" sizes="20x32" href="{{ asset('/assets/img/eTabFavicon.png') }}" >
    <title>eTab School/College ERP - LOGIN</title>
    <!-- vendor css -->
    <link href="{{asset('/assets/lib/%40fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/dashforge.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/dashforge.Auth.css')}}">
</head>
<body style="background-image:url({{asset('images/background.png')}});">
@include('layouts.loader.loader')
<header class="navbar navbar-header navbar-header-fixed">
    <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="https://digishiksha.in" target="_blank" tabindex="-1" class="df-logo mt-1 mb-0"><img width='45px' height="45px" src="{{ asset('/assets/img/eTabLogo.jpg') }}"><span>&nbsp e</span><span>Tab</span>
        {{-- <span class="badge mt-1 ml-1 badge-danger text-white"><b>PRO</b></span></a> --}}
    </div><!-- navbar-brand -->
    {{-- <div id="navbarMenu" class="navbar-menu-wrapper"> --}}
        {{-- <div class="navbar-menu-header"> --}}
            {{-- <a href="" tabindex="-1" class="df-logo">Digi<span>Shiksha</span></a> --}}
            {{-- <a id="mainMenuClose" href="#"><i data-feather="x"></i></a> --}}
        {{-- </div><!-- navbar-menu-header --> --}}
        {{-- <ul class="nav navbar-menu"> --}}
            {{-- <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> About Company</a> --}}
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Awards</a> --}}
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Media Coverage</a> --}}
            {{-- </li> --}}

            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Clients</a> --}}
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Software Downloads</a> --}}
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="#" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Support</a> --}}
            {{-- </li> --}}
            {{-- <li class="nav-item"> --}}
                {{-- <a href="" tabindex="-1" class="nav-link"><i data-feather="pie-chart"></i> Contact Us</a> --}}
            {{-- </li> --}}

        {{-- </ul> --}}
    {{-- </div><!--navbar-menu-wrapper--> --}}
    {{-- <div class="navbar-right"> --}}
        {{-- <a href="https://digishiksha.in" target="_blank" tabindex="-1" class="btn btn-buy"> --}}
            {{-- <i data-feather="shopping-bag"></i> <span>Buy Now</span></a> --}}
    {{-- </div><!--navbar-right--> --}}
    <div class="navbar-right">
        <a href="https://digishiksha.in" target="_blank" tabindex="-1" class="btn btn-buy">
            {{-- <i data-feather="shopping-bag"></i>  --}}<span>Contact us</span></a>
    </div><!--navbar-right-->
</header><!--navbar-->

@yield('content')

<footer class="footer text-white"  style=" background-image: url('{{ url('/assets/img/digivityLogo.jpg') }}'); opacity: 0.8;">
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="myAlert-bottom alert tx-15 alert-solid alert-{{ $key }}">
                <a href="#" class="close a-link" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get($key) }}
            </div>
        @endif
    @endforeach
    @if ($errors->any())
        <div class="row myAlert-bottom alert tx-12 alert-solid alert-danger">
            <a href="#" class="close a-link position-absolute aligned-right" style=" right:20px; " data-dismiss="alert" aria-label="close">&times;</a>
            @foreach ($errors->all() as $error)
                <div class="col-11 p-0 m-0"><i class="fa fa-warning"></i> {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div>
        <span>Copyright &copy; 2023-2029 - eTab v1.0.0. </span>
        <span>Created by <a target="_blank" tabindex="-1" href="https://inkubis.in">eTab tech soln. (P) Ltd.</a></span>
    </div>
    <div>
        <nav class="nav">
            <a href="" tabindex="-1" class="nav-link text-white">Licenses</a>
            <a href="" tabindex="-1" class="nav-link text-white">Change Log</a>
            <a href="" tabindex="-1" class="nav-link text-white">Get Help</a>
        </nav>
    </div>
</footer>

<script src="{{url('/assets/lib/jquery/jquery.min.js')}}"></script>
<script src="{{url('/assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/assets/lib/feather-icons/feather.min.js')}}"></script>
<script src="{{url('/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{url('/assets/lib/prismjs/prism.js')}}"></script>
<script src="{{url('/assets/lib/parsleyjs/parsley.min.js')}}"></script>
<script src="{{url('/assets/lib/js-cookie/js.cookie.js')}}"></script>
<script src="{{url('/assets/js/dashforge.settings.js')}}"></script>
<script src="{{url('/assets/js/dashforge.js')}}"></script>
<script src="{{url('/assets/js/commanJs.js')}}"></script>
<script>
    $(document).ready(function() {
        loader('none');
        $("form").submit(function(event) {
            loader('block');
        });
    });
</script>
<script>
    $(function(){
        'use strict'
    });
</script>
<script>
    setTimeout(function () {
        $(".myAlert-bottom").hide();
    }, 8000);
</script>

</body>
</html>
