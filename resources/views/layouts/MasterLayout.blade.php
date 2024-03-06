<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{csrf_token()}}">
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

<title>E-Tab Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- vendor css -->
<link href="{{url('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<link href="{{url('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<link href="{{url('assets/lib/remixicon/fonts/remixicon.css')}}" rel="stylesheet">
<link href="{{url('assets/css/custom.css')}}" rel="stylesheet">

<!-- DashForge CSS -->
<link rel="stylesheet" href="{{url('assets/css/dashforge.css')}}">
<link rel="stylesheet" href="{{url('assets/css/dashforge.auth.css')}}">


    @if(isset(Auth::user()->uidisplay)&&(Auth::user()->uidisplay))
        @php
            $ui=Auth::user()->uidisplay;
        @endphp
        <style type="text/css">
            body { background:{{$ui->master_body_background}}; font-size:{{$ui->master_body_font_size}} !important; }
            .search-section{background:{{$ui->search_section_background}}; }
            .action-button-section{background:{{$ui->action_button_section_background}};}
            .navbar-header{ background: {{$ui->header_background}};}
            .navbar-menu .navbar-menu-sub{ background:{{$ui->header_dropdown_background}};}
            .navbar-right .dropdown-menu-right{ background:{{$ui->header_dropdown_background}}; }
            .digishiksha-navbar-header{ background:{{$ui->navbar_background}}; font-size:{{$ui->navbar_font_size}}; }
            .digishiksha-navbar-header .navbar-menu-sub { background:{{$ui->navbar_dropdown_background}}; font-size:{{$ui->navbar_font_size}}; }
            .digishiksha-navbar-header .navbar-menu-sub .dropdown-item {  color:{{$ui->navbar_dropdown_list_text_color}}; @if($ui->navbar_dropdown_list_border)border-bottom:1px solid {{$ui->navbar_dropdown_list_border}};@endif }
            .digishiksha-navbar-header .navbar-menu-sub .dropdown-item:hover,
            .digishiksha-navbar-header .navbar-menu-sub .dropdown-item:active{ background:{{$ui->navbar_dropdown_list_hover_background}}; color:{{$ui->navbar_dropdown_list_hover_text_color}}; }
            .panel-default>.panel-heading { background:{{$ui->panel_header_background}}; color:{{$ui->panel_header_text_color}}; font-size:{{$ui->panel_header_font_size}};   }
            .panel-body{ background:{{$ui->panel_body_background}}; margin: 0; }
            .panel{ @if($ui->panel_border_color)border:1px solid {{$ui->panel_border_color}};@endif }
            .modal-header{ background:{{$ui->modal_background}};  }
            .modal-header a,.modal-header h4,.modal-header p,.modal-header i{ color:{{$ui->modal_text_color}}; font-size:{{$ui->modal_header_font_size}};  }
            .modal-footer{ background:{{$ui->modal_footer_background}}; color:{{$ui->modal_footer_text_color}};}
            .modal-body{ background:{{$ui->modal_body_background}}; }
            .table { background:{{$ui->table_background}}; font-size:{{$ui->table_font_size}};   }
            .table thead tr th,.table tbody tr td { @if($ui->table_border)border:1px solid {{$ui->table_border}};  @endif }
            .table thead { background:{{$ui->table_thead_background}};  color:{{$ui->table_thead_text_color}};   }
            .table tbody { background:{{$ui->table_tbody_background}}; color:{{$ui->table_tbody_text_color}};   }
            .table tfoot { background:{{$ui->table_tfoot_background}}; color:{{$ui->table_tfoot_text_color}};   }
            {{$ui->custom_stylesheet}}
            .swal-footer {
                background-color: rgb(245, 248, 250);
                margin-top: 32px;
                border-top: 1px solid #E9EEF1;
                overflow: hidden;
            }
        </style>
    @endif


</head>

<body class="page-profile tx-12">
@include('layouts.header.MasterAdminHeaderLayout')
@include('layouts.Models.AddModels') <!--add crud modal (popup)-->
@include('layouts.Models.EditModels') <!--edit crud modal (popup)-->
@include('layouts.Models.change-year-model') <!-- change academic year and financial year-->
@include('layouts.Models.custom-model') <!--custom model -->
@include('layouts.loader.loader')
@if(isset($sms)&&($sms==1)) @include('app.erpmodule.MasterAdmin.Communication.modal-sms-index') @endif


<div class="content content-fixed pd-l-0 pd-b-0 pd-r-0">
@include('layouts.header.ModuleNavbar')
</div>

<div class="content content-fixed mg-t-10 pd-t-0">
    <div class="container-fluid">
        @yield('content')
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
      @if(Session::has($key))
         <div class="myAlert-right alert tx-15 alert-solid alert-{{ $key }}">
           <a href="#" class="close a-link" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get($key) }}
    </div>
@endif
@endforeach
    </div>
</div>

<footer class="footer">


    @if ($errors->any())
        <div class="myAlert-bottom alert tx-15 alert-solid alert-danger">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
            @endforeach
            <a href="#" class="close a-link" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif

        <div class="myAlert-bottom alert-js alert tx-15 alert-solid " style="display:none;">
            <a href="#" class="close a-link" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="alert-msg"></span>
        </div>

    <div>
        <span>&copy;  2023-2024 eTab  </span>
        <span class="text-capitalize tx-12">Created by - <a href=""> SkardTech PvtLtd</a></span>
    </div>
    <div>
        <nav class="nav">
            <a href="" class="nav-link pd-t-4 pd-b-4">Licenses</a>
            <a href="" class="nav-link pd-t-4 pd-b-4">Change Log</a>
            <a href="" class="nav-link pd-t-4 pd-b-4">Get Help</a>
        </nav>
    </div>
</footer>


<script>

    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
        return true;
    }
</script>
<script src="{{url('assets/lib/jquery/jquery.min.js')}}"></script>

    <script src="{{url('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <script src="{{url('assets/lib/feather-icons/feather.min.js')}}"></script>
    <script src="{{url('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{url('assets/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{url('assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{url('assets/javascript/commanJs.js')}}"></script>
<script src="{{url('assets/javascript/select-box-list.js')}}"></script>
<script src="{{url('assets/lib/multiselect/bootstrap-multiselect.min.js')}}"></script>
<script src="{{url('assets/lib/print/jquery.printPage.js')}}"></script>
<script type="text/javascript" src="{{url('assets/javascript/AjaxFormCreate.js')}}"></script>



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


<script>

    // JavaScript code to show the modal
    $(document).ready(function () {
        $('#yearModelsTable').on('click', function () {
            $('#editYearModels').modal('show');
        });
    });
</script>


<!--model open on load page-->
<script type='text/javascript'>
    $(document).ready(function () {
        @if(Session::get('keyid'))
        $("#{{Session::get('keyid')}}").modal('show');
        var EditViewUrl = "{{url(Session::get('url'))}}";
        if (EditViewUrl != 0) {
            editmodalfn(EditViewUrl);
        }
        {{Session::forget(['keyid','url'])}}
        @endif

        $(".BtnEditUrl").bind( "click", function( event ) {
            var EditViewUrl = $(this).val();
            if (EditViewUrl != 0) {
                $("#editModels").modal('show');
                editmodalfn(EditViewUrl);
            } else {
                alert("Sorry, Edit Url Not Found!, Please Reload Page");
                window.location.reload();
            }
        });
        function editmodalfn(EditViewUrl) {
            $("#ModelLoadData").html("<div class='text-center text-secondary mg-t-30'><div class='spinner-border text-primary'></div> <div class='tx-15 mg-l-10'><b>Please wait few seconds...</b></div></div>");
            $("#ModelLoadData").load(EditViewUrl, function (responseText, textStatus, XMLHttpRequest) {
                    if (textStatus == "error") {
                        $("#ModelLoadData").html(responseText);
                    }
                $("form").submit(function(event) {
                    loader('block');
                });
                }
            );
        }


        //model show top side
        $('.modal').on('show.bs.modal', function (event) {
            var idx = $('.modal:visible').length;
            $(this).css('z-index', 1040 + (10 * idx));
        });
        $('.modal').on('shown.bs.modal', function (event) {
            var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
            $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
            $('.modal-backdrop').not('.stacked').addClass('stacked');
        });

    });
</script>
@if(isset($ui->table_datatable)&&($ui->table_datatable!="no")||(!isset($ui->table_datatable)))
<script>
    /**
     * responsive table search static
     */
    $(function () {
        'use strict'
        $('#example2').DataTable({
            responsive: true,
            "iDisplayLength": @if(isset($ui->table_datatable_pagination)){{$ui->table_datatable_pagination}}@else{{"10"}}@endif,
            sPaginationType : 'full_numbers',
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: 'MENU items/page',
            },
            "autoWidth": true,
            "footerCallback": function ( row, data, start, end, display ) {
                if($(this).attr('datasum')=="true") {
                    function parseCurrency( num ) {
                        return parseFloat( num.replace( /,/g, '') );
                    }
                    var api = this.api();
                    var nb_cols = api.columns().nodes().length;
                    var col = $(this).attr('colsum');
                    col=col.split(',');
                    $.each(col, function(key,val) {
                        var pageTotal = api
                            .column(val, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return Number(a) + Number(parseCurrency(b));
                            }, 0);
                        // Update footer
                        $(api.column(val).footer()).html(pageTotal.toFixed(2));
                    });
                }
            }
        });
    });
</script>
    @endif

<script type="text/javascript">
    $(document).on("click", '#send_communication_sms', function() {
        var studentids = [];
        var receiverbody="";
        var row=0;
        $('.student_id:checked').each(function() {
            row++;
            studentids.push($(this).val());
            receiverbody +="<tr><td class='text-center'>"+row+"</td><td>"+$(this).attr('data-name')+"</td><td>"+$(this).attr('data-contact-no')+"</td></tr>";
            $(".parameter_section").append("<input type='hidden' class='parameterid' name='parameter_"+$(this).attr('data-contactid')+"' value='"+$(this).attr('data-parameter')+"'>");

        });
        $('.parameter_value').each(function() {
           });
        $(".receiver_body").html(receiverbody);
        $(".receiver_count").html(studentids.length);
        $(".receiver").html('Student');
        if(studentids&&(studentids!=0)) {
            $(".studentid").val(studentids);
        }
        if($(".studentid")){
            if($(".studentid").val()==0){
                swal ("Oops","Please Select Atleast One Student","error" ).then(function() {
                    swal.close();
                    $("#text_message").focus();
                });
                return false;
            }
        }
        $("#smsPageModal").modal('show');
    });
</script>
<script type="text/javascript">
    $(".file-choose").on('change',function (){
        var modelid=$(this).attr('modelid');
        $(".alert-msg-ajax").show();
        $(".alert-msg-ajax").html('');
        $("."+$(this).attr('alertmsg')).html("<center><div class='text-danger tx-12 pd-t-10'><i class='fa fa-spinner fa-spin'></i><b>Please wait few seconds...</b></div></center>");
        var result=formrequest('form.'+$(this).attr('formid'),null,null);
        if(result['result']==1){
            $("."+$(this).attr('filename')).attr('src',result['profilepath']);
            $("."+$(this).attr('alertmsg')).html("<center><div class='text-success tx-12 pd-t-10'><i class='fa fa-check'></i><b>"+result['message']+"</b></div></center>");
            $(this).val('');
        }else
        if(result['result']==0){
            $("."+$(this).attr('alertmsg')).html("<center><div class='text-danger tx-12 pd-t-10'><i class='fa fa-close'></i><b>"+result['message']+"</b></div></center>");
            $(this).val('');
        }
        setInterval(function(){ $(".alert-msg-ajax").hide(); },5000);
    });
</script>
<script type="text/javascript">
    function Alert(result){
        $(".alert-js").show();
        $(".alert-js").addClass("alert-"+result['status']);
        $(".alert-msg").html(result['message']);
        setTimeout(function(){ $(".alert-js").hide(); }, 5000);
    }
    $(function() {
        $('.multiselect')
            .multiselect({
                allSelectedText: 'All',
                maxHeight: 200,
                includeSelectAllOption: true
            })
            .multiselect('selectAll', true)
            .multiselect('updateButtonText');
    });
</script>

<script>
    $(document).ready(function() {
        // let course_id;

        // let course_sections_mapping = @php echo json_encode(coursesectionlist()); @endphp
        // let selected_section_id = parseInt(@php echo request()->get('section_id'); @endphp)


        let course_id;
        let course_sections_mapping = {!! json_encode(coursesectionlist()) !!};
        let selected_section_id = parseInt({{ request()->get('section_id') }});


        $('#course_id').on('change', function() {
            course_id = parseInt(this.value);

                let selected_course_sections = course_sections_mapping.filter(course => course['id'] === course_id)

                $('#section_id').html($("<option></option>")
                    .attr("value", "")
                    .attr("selected", "selected")
                    .text("-- Select Section --"));

                $.each(selected_course_sections[0]["sections"], function(key, value) {
                    $('#section_id')
                        .append($("<option></option>")
                            .attr("value", value.id)
                            .prop("selected", value.id == selected_section_id ? true :  false)
                            .text(value.section));
                });

                selected_section_id = "";
        });
        $('#course_id').trigger('change');

    });
</script>


</body>
</html>
