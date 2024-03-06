@if(isset($receiptconfig)&&($receiptconfig->is_header=="yes"))
    @php
        $collaboration=[];
        if(isset($receiptconfig->course_id)){$collaboration=explode(",",$receiptconfig->course_id);}
        $schooldetail=$receiptconfig->SchoolDetails();
        if(in_array($student->course_id,$collaboration)){$schooldetail=$receiptconfig->CollaborateSchoolDetails();}
    @endphp
<div class="col-lg-12 p-0 mg-b-5">
<table cellspacing="0" cellpadding="0" class="table table-header table-borderless m-0 p-0 ">
    <tr class="header-tr">
        <td>
            <img height="{{$receiptconfig->logo_height}}" src="{{asset($schooldetail['school_logo'])}}">
        </td>
        <td>
            <h6 class="school-text p-0 m-0 {{ $schooldetail['define_class'] }}">{!! $schooldetail['school_name'] !!}</h6>
            <h6 class="school-body p-0 m-0 {{ $schooldetail['sm_define_class'] }}">{!! $schooldetail['school_middle_body'] !!}</h6>
        </td>
        <td>{!! $receiptconfig->header_addon !!}</td>
    </tr>
</table>
    <div class="col-lg-12 @if($receiptconfig->is_header_line=="yes") bd-b bd-1 @endif " style='border-bottom:2px solid black;'></div>
</div>
<style type="text/css">
.school-text { font-size:{{$schooldetail['font_size']}}; font-weight:{{$schooldetail['font_weight']}};
font-family:{{$schooldetail['font_family']}}; text-align:{{$schooldetail['text_align']}}; color:{{$schooldetail['color']}};
padding:{{$schooldetail['padding']}}; margin:{{$schooldetail['margin']}};  }

.header-tr td:first-child,.header-tr td:last-child {
    width: 1px;
    white-space: nowrap;
}

.school-body { font-size:{{$schooldetail['sm_font_size']}}; font-weight:{{$schooldetail['sm_font_weight']}};
    font-family:{{$schooldetail['sm_font_family']}}; text-align:{{$schooldetail['sm_text_align']}}; color:{{$schooldetail['sm_color']}};
    padding:{{$schooldetail['sm_padding']}}; margin:{{$schooldetail['sm_margin']}}; }
{!! $schooldetail['stylesheet'] !!}
</style>

@endif
