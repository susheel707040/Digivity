@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Group Map With Course</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-sitemap"></i> Fee Group Map With Course</b></div>
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-12">
                    <table class="col-lg-6 mx-auto mg-t-10 mg-b-10">
                        <tr>
                            <td class="wd-15p"><b>Fee Group</b></td>
                            <td><b><sup>*</sup> :</b></td>
                            <td>
                                <select name="fee_group_id" id="fee_group_id" class="form-control">
                                    <option value="">---Select---</option>
                                    @foreach(feegrouplist([]) as $data)
                                        <option value="{{$data->id}}" @if(request()->route('feegroupid')==$data->id) selected @endif>{{$data->fee_group}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="wd-20p pd-l-10">
                                <button type="button" id="continueBtn" class="btn btn-primary">Continue <i
                                        class="fa fa-angle-right"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                @if(request()->route('feegroupid'))
                <form action="{{url('MasterAdmin/Finance/CreateFeeGroupMapWithCourse')}}" method="POST"
                      enctype="multipart/form-data" id="selectForm2"
                      data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <input type="hidden" value="{{request()->route('feegroupid')}}" id="fee_group_id" name="fee_group_id">
                    <div class="col-lg-12 pd-t-10 bd-1 bd-t">
                        <div class="card col-lg-6 mg-b-10 mx-auto p-0 ">
                            <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select Course
                                <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox1"> Select All</span>
                            </div>
                            <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10  tx-13 m-0 flex-fill">
                                <div class="col-lg-12 mg-t-15 mg-b-10">
                                    @foreach(courselist() as $data)
                                        <div class="badge pd-5 tx-11 bd bd-1 bd-info mg-2 text-left" style ="color:black"
                                             style=" width:23%;">
                                            <table>
                                                <tr>
                                                    <td><input type="checkbox" name="course_id[]" value="{{$data->id}}"
                                                               class="checkbox1"
                                                               @if(in_array($data->id,array_column($feegroupcourse,'course_id'))) checked @endif >
                                                    </td>
                                                    <td class="pd-l-5">{{$data->course}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 pd-t-10 pd-b-10 bd-1 bd-t">
                        <div class="col-lg-6 p-0 m-0 mx-auto">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Submit
                            </button>
                            <a href="{{url('MasterAdmin/Finance/DefineFeeGroupMapWithCourse')}}">
                                <button type="button" class="btn btn-white mg-r-30 float-left"><i
                                        class="fa fa-times"></i> Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
                    @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#continueBtn").click(function () {
            if($("#fee_group_id").val()!=0) {
                window.location.assign('/MasterAdmin/Finance/DefineFeeGroupMapWithCourse/' + $("#fee_group_id").val() + '/search');
            }else
            {
                window.location.assign('/MasterAdmin/Finance/DefineFeeGroupMapWithCourse');
            }
        });
    </script>
@endsection
