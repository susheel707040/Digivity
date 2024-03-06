@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Dynamic Report Setting</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/GlobalSetting/CreateDynamicReportSetting')}}" method="POST" enctype="multipart/form-data"
          data-parsley-validate="" novalidate="">
        {{csrf_field()}}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-cog"></i> Dynamic Report Setting</b></div>
                <div class="panel-body pd-b-10 pd-t-10 m-0 row">

                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Report Setting</b>
                        </div>
                        <div class="card-body pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Report Name <sup>*</sup> :</b></label><br>
                                <select name="page_name" id="report_name" class="form-control input-sm" required>
                                    <option value="">---Select---</option>
                                    <option value="all" @if(request()->route('pagename')=="all") selected @endif>All Pages</option>
                                    <option value="new" @if(request()->route('pagename')=="new") selected @endif>Add New Page</option>
                                </select>
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Report Name <span class="text-gray">(Optional)</span> </b>:</label><br>
                                <input type="text" value="@if(isset($data)){{$data->report_name}}@endif" name="report_name" placeholder="Enter Report Name" class="form-control input-sm">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Report Page Url <span class="text-gray">(Optional)</span> </b>:</label><br>
                                <input type="text" value="@if(isset($data)){{$data->report_url}}@endif" name="report_url" placeholder="Enter Page Url" class="form-control input-sm">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Report Title <span class="text-gray">(Optional)</span> </b>:</label><br>
                                <input type="text" value="@if(isset($data)){{$data->report_title}}@endif" name="report_title" placeholder="Enter Page Name" class="form-control input-sm">
                            </div>
                        </div>
                    </div>

                 @if(request()->route('pagename'))
                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Page Orientation &
                                Layout Setting</b></div>
                        <div class="card-body pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Page Orientation <sup>*</sup> :</b></label>
                                <select name="orientation" class="form-control">
                                    <option>Potrait</option>
                                    <option>Landscape</option>
                                </select>
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Page Layout <sup>*</sup> :</b></label>
                                <select name="page_layout" class="form-control">
                                    <option @if((isset($data))&&$data->page_layout=="a4") selected @endif>A4</option>
                                    <option @if((isset($data))&&$data->page_layout=="a4") selected @endif>A3</option>
                                    <option @if((isset($data))&&$data->page_layout=="a4") selected @endif>Legal</option>
                                    <option @if((isset($data))&&$data->page_layout=="a4") selected @endif>Custom</option>
                                </select>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Layout Font Size :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->layout_font_size}}@endif" name="layout_font_size" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Text Color :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->layout_text_color}}@endif" name="layout_text_color" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Watermark :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="watermark_status" value="1" @if(isset($data)&&($data->watermark_status==1)) checked @endif></td><td class="pd-l-5">Enable</td>
                                        <td class="pd-l-10"><input type="radio" name="watermark_status" value="0" @if(isset($data)&&($data->watermark_status==0)) checked @endif @if(!isset($data->watermark_status)) checked @endif></td><td class="pd-l-5">Disable</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Header and Footer Setting</b></div>
                        <div class="card-body pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Is Header Enable :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_header" value="yes" @if((isset($data))&&$data->is_header=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_header" value="no" type="radio" @if((isset($data))&&$data->is_header=="no") checked @endif></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Is Header Line Enable :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_header_line" value="yes" @if((isset($data))&&$data->is_header_line=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_header_line" value="no" @if((isset($data))&&$data->is_header_line=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Is Footer Enable :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_footer" value="yes" @if((isset($data))&&$data->is_footer=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_footer" value="no" @if((isset($data))&&$data->is_footer=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Is Footer Line Enable :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_footer_line" value="yes" @if((isset($data))&&$data->is_footer_line=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_footer_line" value="no" @if((isset($data))&&$data->is_footer_line=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-1 pd-l-1 pd-r-1">
                                <label><b>Is Logo Enable</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_logo" value="yes" @if((isset($data))&&$data->is_logo=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_logo" value="no" @if((isset($data))&&$data->is_logo=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Logo Height :</b></label>
                                <input type="text" name="logo_height"  value="@if(isset($data)){{$data->logo_height}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Is Row No :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="is_row" value="yes" @if((isset($data))&&$data->is_row=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                        <td class="pd-l-10"><input name="is_row" value="no" @if((isset($data))&&$data->is_row=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Header Information</b></div>
                        <div class="card-body pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">

                            <div class="col-lg-3">
                                <label><b>School Name <sup>*</sup> :</b>  </label>
                                <input type="text" name="school_name" value="@if(isset($data)){{$data->school_name}}@endif" placeholder="Enter School Name" class="form-control input-sm" required>
                                <span class="tx-10 m-0 p-0">#school-id</span>
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Font Size :</b></label>
                                <input type="text" name="s_font_size" value="@if(isset($data)){{$data->s_font_size}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Font Weight :</b></label>
                                <input type="text" name="s_font_weight" value="@if(isset($data)){{$data->s_font_weight}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Font Family :</b></label>
                                <input type="text" name="s_font_family" value="@if(isset($data)){{$data->s_font_family}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Text Align :</b></label>
                                <input type="text"  name="s_text_align" value="@if(isset($data)){{$data->s_text_align}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Color :</b></label>
                                <input type="text" name="s_color" value="@if(isset($data)){{$data->s_color}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Padding :</b></label>
                                <input type="text" name="s_padding" value="@if(isset($data)){{$data->s_padding}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Margin :</b></label>
                                <input type="text" name="s_margin" value="@if(isset($data)){{$data->s_margin}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-1 pd-l-5 pd-r-5">
                                <label><b>Define Class :</b></label>
                                <input type="text" name="s_define_class" value="@if(isset($data)){{$data->s_define_class}}@endif" class="form-control">
                            </div>
                            <div class="col-lg-12 bd-1 bd-t mg-t-15"></div>


                            <div class="col-lg-6 mg-t-10 ">
                                <label><b>School Middle Body (Contact & Other Information) <sup>*</sup> :</b></label>
                                <textarea name="school_middle_body" class="form-control" style="height:100px; ">@if(isset($data)){{$data->school_middle_body}}@endif</textarea>
                                <span class="tx-10 m-0 p-0">#school-body-id</span>
                            </div>
                            <div class="col-lg-6 mg-t-10 row">
                                <div class="col-lg-2 pd-l-5 pd-r-5">
                                    <label><b>Font Size :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_font_size}}@endif" name="sm_font_size" class="form-control">
                                </div>
                                <div class="col-lg-2 pd-l-5 pd-r-5">
                                    <label><b>Font Weight :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_font_weight}}@endif" name="sm_font_weight" class="form-control">
                                </div>
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Font Family :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_font_family}}@endif" name="sm_font_family" class="form-control">
                                </div>
                                <div class="col-lg-2 pd-l-5 pd-r-5">
                                    <label><b>Text Align :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_text_align}}@endif" name="sm_text_align" class="form-control">
                                </div>
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Color :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_color}}@endif" name="sm_color" class="form-control">
                                </div>
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Padding :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_padding}}@endif" name="sm_padding" class="form-control">
                                </div>
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Margin :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_margin}}@endif" name="sm_margin" class="form-control">
                                </div>
                                <div class="col-lg-3 pd-l-5 pd-r-5">
                                    <label><b>Define Class :</b></label>
                                    <input type="text" value="@if(isset($data)){{$data->sm_define_class}}@endif" name="sm_define_class" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12 pd-t-10 bd-1 bd-t mg-t-15"></div>
                            <div class="col-lg-12 m-0 row">
                                <div class="col-lg-3">
                                    <label><b>Choose School Logo :</b></label>
                                    <input type="file" id="reportschoolLogoUploadImage" name="school_logo" class="form-control" onchange="report_school_logo_preview()">
                                    <span class="tx-10 m-0 p-0">#school-logo</span>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <label><b>School Logo View :</b></label>
                                    <center>
                                    <div class="avatar avatar-xl d-none d-sm-block">
                                        @if(isset($data) && !empty($data->school_logo))
                                        <img id="report_school_logo_preview_image" src="{{url('uploads/report_school_logo_image/' .$data->school_logo)}}" class="rounded-circle" alt="">
                                        @else
                                        <img id="report_school_logo_preview_image" src="{{FileUrl($data->school_logo ?? '')}}" class="rounded-circle" alt="">
                                        @endif
                                    </div>
                                    </center>
                                </div>
                                <script>
                                    function report_school_logo_preview() {
                                        var report_school_logo_preview = document.getElementById('report_school_logo_preview_image');
                                        var file    = document.getElementById('reportschoolLogoUploadImage').files[0];
                                        var reader  = new FileReader();

                                        reader.onloadend = function () {
                                            report_school_logo_preview.src = reader.result;
                                        }

                                        if (file) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            report_school_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                        }
                                    }
                                </script>

                                <div class="col-lg-2 pd-l-5 pd-r-5">
                                    <label><b>Layout Watermark  :</b></label>
                                    <input type="file" id="reportwaterLogoUploadImage" name="watermark_file" class="form-control" onchange="report_water_logo_preview()">
                                    <span class="tx-10 m-0 p-0">#watermark-logo</span>
                                </div>

                                <div class="col-lg-2 text-center">
                                    <label><b>Watermark Logo View :</b></label>
                                    <center>
                                    <div class="avatar avatar-xl d-none d-sm-block">
                                        @if(isset($data) && !empty($data->watermark_file))
                                        <img id="report_water_logo_preview_image" src="{{url('uploads/report_water_mark_logo_image/' .$data->watermark_file)}}" class="rounded-circle" alt="">
                                        @else
                                        <img id="report_water_logo_preview_image"  src="{{FileUrl($data->watermark ?? '')}}" class="rounded-circle" alt="">
                                        @endif
                                    </div>
                                    </center>
                                </div>
                                <script>
                                    function report_water_logo_preview() {
                                        var report_water_logo_preview = document.getElementById('report_water_logo_preview_image');
                                        var file    = document.getElementById('reportwaterLogoUploadImage').files[0];
                                        var reader  = new FileReader();

                                        reader.onloadend = function () {
                                            report_water_logo_preview.src = reader.result;
                                        }

                                        if (file) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            report_water_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                        }
                                    }
                                </script>

                                <div class="col-lg-12">
                                    <label><b>Stylesheet Code : </b></label>
                                    <textarea name="stylesheet" class="form-control">@if(isset($data)){{$data->stylesheet}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Footer Information</b></div>
                        <div class="card-body  pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
                            <div class="col-lg-4 pd-l-5 pd-r-5">
                            <label><b>Footer Body :</b></label>
                            <textarea name="footer_body" class="form-control">@if(isset($data)){{$data->footer_body}}@endif</textarea>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Font Size :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->f_font_size}}@endif" name="f_font_size" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Align :</b></label>
                                <select name="f_align" class="form-control">
                                    <option>Left</option>
                                    <option>Center</option>
                                    <option>Right</option>
                                </select>
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Background Color :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->bg_color}}@endif" name="bg_color" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Text Color :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->text_color}}@endif" name="text_color" class="form-control">
                            </div>
                        </div>
                    </div>

                        <div class="col-lg-12">
                        <button class="btn btn-primary btn-lg float-right"><i class="fa fa-edit"></i> Update</button>
                    </div>
@endif
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        $("#report_name").on('change',function(){
            loader('block');
            if($(this).val()!=0){
                window.location.assign('/MasterAdmin/GlobalSetting/DynamicReportSetting/'+$(this).val()+'/search');
            }else{
                window.location.assign('/MasterAdmin/GlobalSetting/DynamicReportSetting');
            }
        });

    </script>
@endsection
