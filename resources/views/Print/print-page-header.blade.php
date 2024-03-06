@php
    $data=dynamicreport(['page_name'=>'all']);
@endphp
@if(!isset($stylenull))
    <style>
        body{font-family: Arial,Helvetica, sans-serif;font-size:12px;}
        .header-body{ width:100%; }
        .tabledata{ width:100%; border-top:1px solid gray; margin-top:5px;  border-right:1px solid black;  }
        .tabledata thead tr th{ padding:2px 2px;  background-color:gray;  font-weight:bold; border-left:1px solid black;   border-bottom:1px solid black; }
        .tabledata thead tr td{ padding:2px 2px; background-color:gray;  font-weight:bold; border-left:1px solid black;   border-bottom:1px solid black; }
        .tabledata tbody tr td{ padding:2px 2px; border-left:1px solid black;   border-bottom:1px solid black;   }
        .tabledata tfoot tr th{ padding:2px 2px;  background-color:gray;  font-weight:bold; border-left:1px solid black;   border-bottom:1px solid black; }
        .tabledata tfoot tr td{ padding:2px 2px;  background-color:gray;  font-weight:bold; border-left:1px solid black;   border-bottom:1px solid black; }
        .col-hide { display: none;}
        .text-center{ text-align:center; }
        .text-left{ text-align:left; }
        .text-right{ text-align:right; }
        .bg-light tr th{ background-color:#A6ACAF;}
        .bg-normal-light td{background-color:#D7DBDD;}
        .footer-body{ width:100%; position:fixed; bottom:0px;  }
        table {width:100%; border-right:1px solid gray;}
        table tr th{border-left:1px solid gray; border-bottom:1px solid gray; }
        table tr td{border-left:1px solid gray; border-bottom:1px solid gray;}
        .header-body table {width:100%; border:0;}
        .header-body table tr td{border:0;}
        .header-body table tr th{border:0;}
        .bg-light{ background-color:whitesmoke; }
        .p-0{padding:0;}
        .m-0{margin:0;}
    </style>
@endif

@if(isset($data)&&$data->is_header=="yes"&&($header==1))
    <div class="header-body">
        <table cellspacing="0" cellpadding="0">
            <tr>
                @if(isset($data)&&$data->is_logo=="yes")
                    <td class='text-center p-0 m-0'><img height="@if(isset($data)){{$data->logo_height}}@endif" src="{{FileUrl($data->school_logo)}}"></td>
                @endif
                <td class='p-0 m-0'>
                    <h6 class="school-text p-0 m-0 {{ $data['s_define_class'] }}">@if(isset($data)){{$data->school_name}}@endif</h6>
                    <h6 class="school-body p-0 m-0 {{ $data['sm_define_class'] }}">{!! $data->school_middle_body !!}</h6>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
@endif
<div class="bodydata"></div>
@if(isset($data)&&$data->is_footer=="yes"&&($footer==1))
    <div class="footer-body">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td>@if(isset($data)){{$data->footer_body}}@endif</td>
            </tr>
        </table>
    </div>
@endif
<div class="stylesheet"></div>
<style type="text/css">
    .school-text { font-size:{{$data['s_font_size']}}; font-weight:{{$data['s_font_weight']}};
        font-family:{{$data['s_font_family']}}; text-align:{{$data['s_text_align']}}; color:{{$data['s_color']}};
        padding:{{$data['s_padding']}}; margin:{{$data['s_margin']}};  }

    .header-tr td:first-child,.header-tr td:last-child {
        width: 1px;
        white-space: nowrap;
    }

    .school-body { font-size:{{$data['sm_font_size']}}; font-weight:{{$data['sm_font_weight']}};
        font-family:{{$data['sm_font_family']}}; text-align:{{$data['sm_text_align']}}; color:{{$data['sm_color']}};
        padding:{{$data['sm_padding']}}; margin:{{$data['sm_margin']}}; }
    {!! $data['stylesheet'] !!}
</style>
