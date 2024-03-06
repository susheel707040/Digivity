<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <title>E-Tab</title>
    @include('layouts.external-css-import')
    <script type="text/javascript" src="{{url('/assets/lib/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript"  src="{{url('/assets/lib/alert/alert-js.js')}}"></script>
</head>
<body class="page-profile tx-12">
@include('layouts.loader.loader') <!--loader import-->
@yield('content')

<div class="myAlert-bottom alert-js alert tx-15 alert-solid " style="display:none;">
    <a href="#" class="close a-link" data-dismiss="alert" aria-label="close">&times;</a>
    <span class="alert-msg"></span>
</div>
</body>

<script type="text/javascript" src="{{url('/assets/javascript/AjaxFormCreate.js')}}"></script>
<script type="text/javascript">
    function Alert(result){
        $(".alert-js").show();
        $(".alert-js").addClass("alert-"+result['status']);
        $(".alert-msg").html(result['message']);
        setTimeout(function(){ $(".alert-js").hide(); }, 5000);
    }
</script>
<script type="text/javascript">
    $(document).ready(function (){
        loader('none');
    });
    //dynamical all checkbox checked
    $(".CheckAll").click(function () {
        $("." + $(this).val()).prop('checked', $(this).prop('checked'));
    });
</script>
</html>
