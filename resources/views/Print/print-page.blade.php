<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    @php
        $data=dynamicreport(['page_name'=>'all']);
    @endphp
    <title></title>
</head>
<body>
@if(isset($data)&&($data->watermark))
    <div id="watermark-logo" style="background-image:url({{FileUrl($data->watermark)}})"></div>
@endif

@if(isset($data)&&$data->is_header=="yes"&&($header==1))
    <div class="header-body">
        <table cellspacing="0" id="header-table" cellpadding="0">
            <tr>
                @if(isset($data)&&$data->is_logo=="yes")
                    <td id="logo-td" class='text-center p-0 m-0'><img id="school-logo" height="@if(isset($data)){{$data->logo_height}}@endif" src="{{FileUrl($data->school_logo)}}"></td>
                @endif
                <td id="text-td" class='p-0 m-0'>
                    <h6 id="school-id" class="school-text p-0 m-0 {{ $data['s_define_class'] }}">@if(isset($data)){{$data->school_name}}@endif</h6>
                    <h6 id="school-body-id" class="school-body p-0 m-0 {{ $data['sm_define_class'] }}">{!! $data->school_middle_body !!}</h6>
                </td>
                <td id="second-logo-td"></td>
            </tr>
        </table>
    </div>
@endif
<div class="bodydata"></div>
@if(isset($data)&&$data->is_footer=="yes"&&($header==1))
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
    .header-body{
        position: relative;
        z-index: 1;
    }
    .bodydata{
        position: relative;
        z-index: 1;
    }

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

    .footer-body{
        position: relative;
        z-index: 1;
    }

    @media print {

    }

    #watermark-logo{
        position: fixed;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 50%;
        text-indent: -9999px;
        opacity:.1;
    }
    {!! $data['stylesheet'] !!}
</style>
</body>
</html>
