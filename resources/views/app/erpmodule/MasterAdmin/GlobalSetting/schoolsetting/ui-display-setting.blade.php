@extends('layouts.MasterLayout')
@section('content')
    <script type="text/javascript" src="{{url('/assets/lib/colorpicker/spectrum.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/assets/lib/colorpicker/spectrum.css')}}">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">UI/Display Setting</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-desktop"></i> UI/Display Setting</b></div>
            <div class="panel-body pd-b-10 pd-t-10 row ">
                <form class="row m-0" action="{{url('/MasterAdmin/GlobalSetting/CreateUIDisplay')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-10">
                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Master UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Master Body Background :</b></label><br>
                            <input type="text" autocomplete="off" value="@if(isset($uidisplay->master_body_background)){{$uidisplay->master_body_background}}@endif" name="master_body_background" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Master Body Font Size :</b></label><br>
                            <select class="form-control input-sm" name="master_body_font_size">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                <option value="{{$i}}px" @if(isset($uidisplay->master_body_font_size)&&($uidisplay->master_body_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Search Section Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->search_section_background)){{$uidisplay->search_section_background}}@endif" name="search_section_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Action Button Section Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->action_button_section_background)){{$uidisplay->action_button_section_background}}@endif" name="action_button_section_background" autocomplete="off" class="color-picker form-control">
                        </div>
                    </div>
                </div>


                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Header UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Header Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->header_background)){{$uidisplay->header_background}}@endif" name="header_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Header Font Size :</b></label><br>
                            <select name="header_font_size" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}px" @if(isset($uidisplay->header_font_size)&&($uidisplay->header_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Header Dropdown Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->header_dropdown_background)){{$uidisplay->header_dropdown_background}}@endif" name="header_dropdown_background" autocomplete="off" class="color-picker form-control">
                        </div>
                    </div>
                </div>


                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Navbar UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13 flex-fill">
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Navbar Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_background)){{$uidisplay->navbar_background}}@endif" name="navbar_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Navbar Font Size :</b></label><br>
                            <select name="navbar_font_size" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}px" @if(isset($uidisplay->navbar_font_size)&&($uidisplay->navbar_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Navbar Icon Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_icon_color)){{$uidisplay->navbar_icon_color}}@endif" name="navbar_icon_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Navbar DropDown Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_dropdown_background)){{$uidisplay->navbar_dropdown_background}}@endif" name="navbar_dropdown_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DropDown List Border Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_dropdown_list_border)){{$uidisplay->navbar_dropdown_list_border}}@endif" name="navbar_dropdown_list_border" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DropDown List Hover Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_dropdown_list_hover_background)){{$uidisplay->navbar_dropdown_list_hover_background}}@endif" name="navbar_dropdown_list_hover_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DropDown List Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_dropdown_list_text_color)){{$uidisplay->navbar_dropdown_list_text_color}}@endif" name="navbar_dropdown_list_text_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DropDown List Hover Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->navbar_dropdown_list_hover_text_color)){{$uidisplay->navbar_dropdown_list_hover_text_color}}@endif" name="navbar_dropdown_list_hover_text_color" autocomplete="off" class="color-picker form-control">
                        </div>

                    </div>
                </div>


                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Modals UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Modal Header Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->modal_background)){{$uidisplay->modal_background}}@endif" name="modal_background" autocomplete="off" class="color-picker form-control">
                        </div>

                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Modal Header Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->modal_text_color)){{$uidisplay->modal_text_color}}@endif" name="modal_text_color" autocomplete="off" class="color-picker form-control">
                        </div>

                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Master Header Font Size :</b></label><br>
                            <select name="modal_header_font_size" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}px" @if(isset($uidisplay->modal_header_font_size)&&($uidisplay->modal_header_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>


                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Modal Body Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->modal_body_background)){{$uidisplay->modal_body_background}}@endif" name="modal_body_background" autocomplete="off" class="color-picker form-control">
                        </div>

                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Modal Footer Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->modal_footer_background)){{$uidisplay->modal_footer_background}}@endif" name="modal_footer_background" autocomplete="off" class="color-picker form-control">
                        </div>

                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Modal Footer Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->modal_footer_text_color)){{$uidisplay->modal_footer_text_color}}@endif" name="modal_footer_text_color" autocomplete="off" class="color-picker form-control">
                        </div>


                    </div>
                </div>

                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Panel UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Panel Header Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->panel_header_background)){{$uidisplay->panel_header_background}}@endif" name="panel_header_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Panel Header Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->panel_header_text_color)){{$uidisplay->panel_header_text_color}}@endif" name="panel_header_text_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Panel Header Font-Size :</b></label><br>
                            <select name="panel_header_font_size" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}px" @if(isset($uidisplay->panel_header_font_size)&&($uidisplay->panel_header_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                         </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Panel Body Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->panel_body_background)){{$uidisplay->panel_body_background}}@endif" name="panel_body_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Panel Border Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->panel_border_color)){{$uidisplay->panel_border_color}}@endif" name="panel_border_color" autocomplete="off" class="color-picker form-control">
                        </div>

                    </div>
                </div>

                <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                    <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Table UI/Display</b></div>
                    <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_background)){{$uidisplay->table_background}}@endif" name="table_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Font-Size :</b></label><br>
                            <select name="table_font_size" class="form-control input-sm">
                                <option value="">---Select---</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}px" @if(isset($uidisplay->table_font_size)&&($uidisplay->table_font_size==$i."px")) selected @endif>{{$i}}px</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Thead Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_thead_background)){{$uidisplay->table_thead_background}}@endif" name="table_thead_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Thead Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_thead_text_color)){{$uidisplay->table_thead_text_color}}@endif" name="table_thead_text_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Tbody Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_tbody_background)){{$uidisplay->table_tbody_background}}@endif" name="table_tbody_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Tbody Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_tbody_text_color)){{$uidisplay->table_tbody_text_color}}@endif" name="table_tbody_text_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Tfoot Background :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_tfoot_background)){{$uidisplay->table_tfoot_background}}@endif" name="table_tfoot_background" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Tfoot Text Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_tfoot_text_color)){{$uidisplay->table_tfoot_text_color}}@endif" name="table_tfoot_text_color" autocomplete="off" class="color-picker form-control">
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DataTable :</b></label><br>
                            <table>
                                <tr>
                                    <td><input type="radio" name="table_datatable" value="yes" @if(isset($uidisplay->table_datatable)&&($uidisplay->table_datatable=="yes")) checked @endif @if(!isset($uidisplay->table_datatable)) checked @endif></td><td class="pd-l-5">Enable</td>
                                    <td class="pd-l-10"><input type="radio" name="table_datatable" @if(isset($uidisplay->table_datatable)&&($uidisplay->table_datatable=="no")) checked @endif value="no"></td><td class="pd-l-5">Disable</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>DataTable Pagination :</b></label><br>
                            @php
                            $pagination=['10','25','50','100','200','500','1000','2000','5000','10000','50000','100000'];
                            @endphp
                            <select name="table_datatable_pagination" class="form-control">
                                @foreach($pagination as $data)
                                <option @if(isset($uidisplay->table_datatable_pagination)&&($uidisplay->table_datatable_pagination==$data)) selected @endif>{{$data}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 pd-l-5 pd-r-5">
                            <label><b>Table Border Color :</b></label><br>
                            <input type="text" value="@if(isset($uidisplay->table_border)){{$uidisplay->table_border}}@endif" name="table_border" autocomplete="off" class="color-picker form-control">
                        </div>
                    </div>
                </div>

                        <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                            <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>UI/Display Stylesheet</b></div>
                            <div class="card-body m-0 pd-b-10 row pd-l-5 pd-t-5 tx-13  flex-fill">
                                <label><b>Custom Stylesheet :</b></label>
                                <textarea class="form-control" name="custom_stylesheet" placeholder="Enter Stylesheet Code" style=" height:200px; ">@if(isset($uidisplay->custom_stylesheet)){{$uidisplay->custom_stylesheet}}@endif</textarea>
                            </div>
                        </div>


                </div>

                <div class="col-lg-2 vhr">
                    <button class="btn btn-primary btn-lg btn-block "><i class="fa fa-edit"></i> Update UI</button>
                    <a href="{{url('/MasterAdmin/GlobalSetting/ResetUI')}}"><button type="button" class="btn btn-danger btn-lg btn-block mg-t-20"><i class="fa fa-edit"></i> Reset UI</button></a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.color-picker').spectrum({
            type: "text",
            showInput: "true",
            showInitial: "true"
        });
    </script>

@endsection
