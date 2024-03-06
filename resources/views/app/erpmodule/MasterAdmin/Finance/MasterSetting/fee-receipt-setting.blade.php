@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Receipt Setting</li>
        </ol>
    </nav>
    <script type="text/javascript" src="{{url('/assets/lib/colorpicker/spectrum.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/assets/lib/colorpicker/spectrum.css')}}">
    @php
    $receiptfor=['fee_receipt'=>'Fee Receipt'];
    $receiptformat=['a5-receipt-format'=>'A5 Receipt Format','a6-receipt-format'=>'A6 Receipt Format','a6-receipt-format-1'=>'A6 Receipt Format 1'];
    @endphp

    <form @if(isset($data->id)) action="{{url('MasterAdmin/Finance/EditFeeReceiptSetting/'.$data->id.'/edit')}}" @else action="{{url('MasterAdmin/Finance/CreateFeeReceiptSetting')}}" @endif method="POST" enctype="multipart/form-data"  data-parsley-validate="" novalidate="">
        {{csrf_field()}}
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cog"></i> Fee Receipt Setting</b></div>
            <div class="panel-body pd-10 pd-b-10 row m-0">
                <div class="col-lg-10">
                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Receipt Setting</b>
                    </div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-12 m-0 flex-fill">
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt For <sup>*</sup> :</b></label>
                            <select name="config_for" id="config_for" class="form-control input-sm" required>
                                <option value="">---Select---</option>
                                @foreach($receiptfor as $key=>$value)
                                <option value="{{$key}}" @if(isset($data)&&$data->config_for==$key) selected @endif>{{$value}}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt Format <sup>*</sup> </b>:</label>
                            <select name="rec_format" id="rec_format" required class="form-control">
                                <option value="">---Select---</option>
                                @foreach($receiptformat as $key=>$value)
                                <option value="{{$key}}" @if(isset($data)&&$data->rec_format==$key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt Copy Print <sup>*</sup> </b>:</label>
                            <select name="rec_copy_qty" id="rec_copy_qty" required class="form-control">
                                @for($i=1;$i<50;$i++)
                                    <option value="{{$i}}" @if(isset($data)&&$data->rec_copy_qty==$i) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Title <sup>*</sup> :</b></label>
                            <input type="text" name="rec_title" value="@if(isset($data)){{$data->rec_title}}@endif" id="rec_title" placeholder="Enter Receipt Title" class="form-control input-sm" required>
                        </div>
                        <div class="col-lg-4 pd-l-5 pd-r-5">
                            <label><b>Hard Copy For <span class="text-gray">(Optional)</span> </b>:</label>
                            <input type="text"  name="rec_hard_copy" value="@if(isset($data)){{$data->rec_hard_copy}}@endif" placeholder="Enter Hard Copy For" class="form-control input-sm">
                            <span class="text-gray">Example : Office Use Copy @ Parent Copy</span>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt Font Size :</b></label>
                            <input type="text" name="rec_font_size" value="@if(isset($data)){{$data->rec_font_size}}@endif" placeholder="Enter Font-size"  class="form-control input-sm">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Apply Receipt Copy No.</b></label>
                            <input type="text" name="apply_rec_copy_no" value="@if(isset($data)){{$data->apply_rec_copy_no}}@endif" placeholder="like : 1,2" class="form-control input-sm">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Concession Amt. Show :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="concession_amt_show" value="yes" @if(isset($data)&&($data->concession_amt_show=="yes")) checked @endif @if(!isset($data)) checked @endif></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input name="concession_amt_show" value="no" type="radio" @if(isset($data)&&($data->concession_amt_show=="no")) checked @endif></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Late Fee Amt. Show :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="late_amt_show" value="yes"  @if(isset($data)&&($data->late_amt_show=="yes")) checked @endif @if(!isset($data)) checked @endif></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input type="radio" name="late_amt_show" value="no"  @if(isset($data)&&($data->late_amt_show=="no")) checked @endif></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Paid Amt. Show :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="paid_amt_show" value="yes" @if(isset($data)&&($data->paid_amt_show=="yes")) checked @endif @if(!isset($data)) checked @endif></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input name="paid_amt_show" type="radio" value="no" @if(isset($data)&&($data->paid_amt_show=="no")) checked @endif></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Balance Amt. Show :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="bal_amt_show" value="yes" @if(isset($data)&&($data->bal_amt_show=="yes")) checked @endif @if(!isset($data)) checked @endif></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input type="radio" name="bal_amt_show" value="no" @if(isset($data)&&($data->bal_amt_show=="no")) checked @endif></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Header and Footer Setting</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-12 m-0 flex-fill">
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
                        <div class="col-lg-2 pd-l-1 pd-r-1">
                            <label><b>Is Logo Enable</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="is_logo" value="yes" @if((isset($data))&&$data->is_logo=="yes") checked @endif @if((!isset($data)))checked @endif></td><td class="pd-l-2">Yes</td>
                                    <td class="pd-l-10"><input name="is_logo" value="no" @if((isset($data))&&$data->is_logo=="no") checked @endif type="radio"></td><td pd-l-2>No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Logo Height :</b></label>
                            <input type="text" name="logo_height"  value="@if(isset($data)){{$data->logo_height}}@endif" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Header Information</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-12 m-0 flex-fill">

                        <div class="col-lg-3">
                            <label><b>School Name <sup>*</sup> :</b></label>
                            <input type="text" name="school_name" value="@if(isset($data)){{$data->school_name}}@endif" placeholder="Enter School Name" class="form-control input-sm" required>
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Font Size :</b></label>
                            <input type="text" name="s_font_size" value="@if(isset($data)){{$data->s_font_size}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Font Weight</b></label>
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
                            <input type="text" name="s_color" value="@if(isset($data)){{$data->s_color}}@endif" class="form-control color-picker">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Padding :</b></label>
                            <input type="text" name="s_padding" value="@if(isset($data)){{$data->s_padding}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Margin :</b></label>
                            <input type="text" name="s_margin" value="@if(isset($data)){{$data->s_margin}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Define Class</b></label>
                            <input type="text" name="s_define_class" value="@if(isset($data)){{$data->s_define_class}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-12 bd-1 bd-t mg-t-15"></div>


                        <div class="col-lg-6 mg-t-10 ">
                            <label><b>School Middle Body (Contact & Other Information) <sup>*</sup> :</b></label>
                            <textarea name="school_middle_body" class="form-control" style="height:100px; ">@if(isset($data)){{$data->school_middle_body}}@endif</textarea>
                        </div>
                        <div class="col-lg-6 mg-t-10 row">
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Font Size :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->sm_font_size}}@endif" name="sm_font_size" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-0 pd-r-0">
                                <label><b>Font Weight</b></label>
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
                                <input type="text" value="@if(isset($data)){{$data->sm_color}}@endif" name="sm_color" class="form-control color-picker">
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
                            <div class="col-lg-2">
                                <label><b>Choose School Logo :</b></label>
                                <input type="file" id="schoolLogoUploadImage" name="school_logo" class="form-control" onchange="school_logo_preview()">
                            </div>
                            <div class="col-lg-2 text-center">
                                <div class="avatar mx-auto avatar-xl d-none d-sm-block">
                                    @if(isset($data) && !empty($data->school_logo))
                                    <img id="school_logo_preview_image" src="{{url('uploads/school_logo_image/' .$data->school_logo)}}" class="rounded-circle" alt="">
                                    @else
                                    <img id="school_logo_preview_image" src="{{url('assets/images/user_no_image.png')}}" class="rounded-circle" alt="">
                                    @endif
                                    </div>
                            </div>
                            <script>
                                function school_logo_preview() {
                                    var school_logo_preview = document.getElementById('school_logo_preview_image');
                                    var file    = document.getElementById('schoolLogoUploadImage').files[0];
                                    var reader  = new FileReader();

                                    reader.onloadend = function () {
                                        school_logo_preview.src = reader.result;
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        school_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                    }
                                }
                            </script>
                            <div class="col-lg-2">
                                <label><b> Watermark Logo:</b></label>
                                <input type="file" id="waterMarkLogoUploadImage" name="watermark_logo" class="form-control" onchange="water_mark_logo_preview()">
                            </div>

                            <div class="col-lg-2 text-right">
                                <div class="avatar mx-auto avatar-xl d-none d-sm-block">
                                    @if(isset($data) && !empty($data->watermark_logo))
                                    <img id="water_mark_logo_preview_image" src="{{url('uploads/watermark_logo_image/' .$data->watermark_logo)}}" class="rounded-circle" alt="">
                                    @else
                                    <img id="water_mark_logo_preview_image" src="{{url('assets/images/user_no_image.png')}}" class="rounded-circle" alt="">
                                    @endif
                                    </div>
                            </div>
                            <script>
                                function water_mark_logo_preview() {
                                    var water_mark_logo_preview = document.getElementById('water_mark_logo_preview_image');
                                    var file    = document.getElementById('waterMarkLogoUploadImage').files[0];
                                    var reader  = new FileReader();

                                    reader.onloadend = function () {
                                        water_mark_logo_preview.src = reader.result;
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        water_mark_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                    }
                                }
                            </script>
                            <div class="col-lg-4 pd-l-0 pd-r-0">
                                <label><b>Stylesheet Code :</b></label>
                                <textarea name="stylesheet" class="form-control">@if(isset($data)){{$data->stylesheet}}@endif</textarea>
                                <span class="text-gray tx-8">
                            Use class  : table-header, receipt-master-body, table-receipt, table-footer
                        </span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Collaboration School Header Information </b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-12 m-0 flex-fill">
                        <div class="col-lg-12 row m-0">
                            <table cellpadding="0" cellspacing="0" class="m-0 p-0">
                                <tr>
                                    <td><input type="checkbox" name="clb_school" value="yes" @if(isset($data->clb_school)&&($data->clb_school=='yes')) checked @endif></td><td class="pd-l-5"><b>Collaboration School Enable</b></td>
                                    <td class="pd-l-20"><b>Collaboration Course ID :</b></td>
                                    <td class="pd-l-5"><input type="text" placeholder="Like : 1,2,3" class="form-control input-sm" value="@if(isset($data)){{$data->course_id}}@endif" name="course_id"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <label><b>School Name <sup>*</sup> :</b></label>
                            <input type="text" name="clb_school_name" value="@if(isset($data)){{$data->clb_school_name}}@endif" placeholder="Enter School Name" class="form-control input-sm">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Font Size :</b></label>
                            <input type="text" name="clb_s_font_size" value="@if(isset($data)){{$data->clb_s_font_size}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Font Weight</b></label>
                            <input type="text" name="clb_s_font_weight" value="@if(isset($data)){{$data->clb_s_font_weight}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Font Family :</b></label>
                            <input type="text" name="clb_s_font_family" value="@if(isset($data)){{$data->clb_s_font_family}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Text Align :</b></label>
                            <input type="text"  name="clb_s_text_align" value="@if(isset($data)){{$data->clb_s_text_align}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Color :</b></label>
                            <input type="text" name="clb_s_color" value="@if(isset($data)){{$data->clb_s_color}}@endif" class="form-control color-picker">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Padding :</b></label>
                            <input type="text" name="clb_s_padding" value="@if(isset($data)){{$data->clb_s_padding}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Margin :</b></label>
                            <input type="text" name="clb_s_margin" value="@if(isset($data)){{$data->clb_s_margin}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Define Class</b></label>
                            <input type="text" name="clb_s_define_class" value="@if(isset($data)){{$data->clb_s_define_class}}@endif" class="form-control">
                        </div>
                        <div class="col-lg-12 bd-1 bd-t mg-t-15"></div>


                        <div class="col-lg-6 mg-t-10 ">
                            <label><b>School Middle Body (Contact & Other Information) <sup>*</sup> :</b></label>
                            <textarea name="clb_school_middle_body" class="form-control" style="height:100px; ">@if(isset($data)){{$data->clb_school_middle_body}}@endif</textarea>
                        </div>
                        <div class="col-lg-6 mg-t-10 row">
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Font Size :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_font_size}}@endif" name="clb_sm_font_size" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-0 pd-r-0">
                                <label><b>Font Weight</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_font_weight}}@endif" name="clb_sm_font_weight" class="form-control">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Font Family :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_font_family}}@endif" name="clb_sm_font_family" class="form-control">
                            </div>
                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Text Align :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_text_align}}@endif" name="clb_sm_text_align" class="form-control">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Color :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_color}}@endif" name="clb_sm_color" class="form-control color-picker">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Padding :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_padding}}@endif" name="clb_sm_padding" class="form-control">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Margin :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_margin}}@endif" name="clb_sm_margin" class="form-control">
                            </div>
                            <div class="col-lg-3 pd-l-5 pd-r-5">
                                <label><b>Define Class :</b></label>
                                <input type="text" value="@if(isset($data)){{$data->clb_sm_define_class}}@endif" name="clb_sm_define_class" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 pd-t-10 bd-1 bd-t mg-t-15"></div>
                        <div class="col-lg-12 m-0 row">
                            <div class="col-lg-2">
                                <label><b>CLB School Logo :</b></label>
                                <input type="file" id="ClbSchoolLogoUploadImage" name="clb_school_logo" class="form-control" onchange="clb_school_logo_preview()">
                            </div>
                            <div class="col-lg-2 text-center">
                                <div class="avatar mx-auto avatar-xl d-none d-sm-block">
                                    @if(isset($data) && !empty($data->clb_school_logo))
                                    <img id="clb_school_logo_preview_image" src="{{url('uploads/clb_school_logo_image/' .$data->clb_school_logo)}}" class="rounded-circle" alt="">
                                    @else
                                    <img id="clb_school_logo_preview_image" src="{{url('assets/images/user_no_image.png')}}" class="rounded-circle" alt="">
                                    @endif
                                </div>
                            </div>
                            <script>
                                function clb_school_logo_preview() {
                                    var clb_school_logo_preview = document.getElementById('clb_school_logo_preview_image');
                                    var file    = document.getElementById('ClbSchoolLogoUploadImage').files[0];
                                    var reader  = new FileReader();

                                    reader.onloadend = function () {
                                        clb_school_logo_preview.src = reader.result;
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        clb_school_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                    }
                                }
                            </script>
                            <div class="col-lg-2">
                                <label><b>Clb Watermark Logo:</b></label>
                                <input type="file" id="ClbWaterMarkLogo" name="clb_watermark_logo" class="form-control" onchange="clb_water_mark_logo_preview()">
                            </div>
                            <div class="col-lg-2 text-right">
                                <div class="avatar mx-auto avatar-xl d-none d-sm-block">
                                    @if(isset($data) && !empty($data->clb_watermark_logo))
                                    <img id="Clb_Water_Mark_logo_preview_image" src="{{url('uploads/clb_watermark_logo_image/' .$data->clb_watermark_logo)}}" class="rounded-circle" alt="">
                                    @else
                                    <img id="Clb_Water_Mark_logo_preview_image" src="{{url('assets/images/user_no_image.png')}}" class="rounded-circle" alt="">
                                    @endif
                                    </div>
                            </div>
                            <script>
                                function clb_water_mark_logo_preview() {
                                    var clb_water_mark_logo_preview = document.getElementById('Clb_Water_Mark_logo_preview_image');
                                    var file    = document.getElementById('ClbWaterMarkLogo').files[0];
                                    var reader  = new FileReader();

                                    reader.onloadend = function () {
                                        clb_water_mark_logo_preview.src = reader.result;
                                    }

                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        clb_water_mark_logo_preview.src = "{{ url('assets/images/no-image-available.png') }}";
                                    }
                                }
                            </script>
                            <div class="col-lg-4 pd-l-0 pd-r-0">
                                <label><b>Stylesheet Code :</b></label>
                                <textarea name="clb_stylesheet" class="form-control">@if(isset($data)){{$data->clb_stylesheet}}@endif</textarea>
                                <span class="text-gray tx-8">
                            Use class  : table-header, receipt-master-body, table-receipt, table-footer
                        </span>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Footer Information</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
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
                            @php $footeralign=['left'=>'Left','center'=>'Center','right'=>'Right']; @endphp
                            <select name="f_align" class="form-control">
                                @foreach($footeralign as $key=>$value)
                                    <option value="{{$key}}" @if(isset($data)&&$data->f_align==$key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Background Color :</b></label>
                            <input type="text" value="@if(isset($data)){{$data->bg_color}}@endif" name="bg_color" class="form-control color-picker">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Text Color :</b></label>
                            <input type="text" value="@if(isset($data)){{$data->text_color}}@endif" name="text_color" class="form-control color-picker">
                        </div>
                    </div>
                </div>


                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Receipt Note  :</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">
                        <div class="col-lg-6 pd-l-5 pd-r-5">
                        <label><b>Receipt Note <span class="text-gray">(Optinal)</span> : </b></label>
                        <textarea class="form-control" name="receipt_note" style=" height:120px; ">@if(isset($data->receipt_note)) {{$data->receipt_note}} @endif</textarea>
                        </div>

                        <div class="col-lg-6 pd-l-5 pd-r-5">
                            <label><b>Header Other Addon Text</b></label>
                            <textarea class="form-control" name="header_addon" style=" height:120px; ">@if(isset($data->header_addon)) {{$data->header_addon}} @endif</textarea>
                        </div>
                    </div>
                </div>
                </div>


                <div class="col-lg-2 vhr pd-l-5 pd-r-5">
                    <div class="col-lg-12 float-left">
                        <button class="btn btn-primary btn-block btn-lg float-right"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </form>
    <script>
        $('.color-picker').spectrum({
            type: "text",
            showInput: "true",
            showInitial: "true"
        });
    </script>

@endsection
