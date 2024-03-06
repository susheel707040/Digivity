@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Student Information Setting</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-cog"></i> Student Information Setting</b></div>
        <div class="panel-body pd-b-15 tx-13">
            <form action="{{url('MasterAdmin/StudentInformation/StudentInfoSettingStore')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row pd-0 m-0">
                    <div class="col-lg-10 pd-l-0 mg-t-10">
                    <div class="card">
                        <div class="card-header bg-gray-100"><b><i class="fa fa-desktop"></i> Student Registration Setting</b>
                        </div>
                        <div class="card-body row pd-5 pd-t-5 pd-b-5 tx-13 m-0 flex-fill">
                            <div class="col-lg-2 p-1 m-0">
                                <label><b>Prefix <span class="text-gray">(Optional)</span> :</b></label>
                                <input type="text" autocomplete="off" value="" name="admission_prefix" id="admission_prefix" placeholder="Enter Prefix" class="form-control1 input-sm">
                            </div>
                            <div class="col-lg-3 p-1 m-0 ">
                                <label><b>Admission No. Start <span class="text-gray">(Optional)</span> :</b></label>
                                <input type="text" autocomplete="off" name="admission_no_start" id="admission_no_start" placeholder="Enter Admission No. Start" class="form-control1 input-sm">
                            </div>
                            <div class="col-lg-2 p-1 m-0">
                                <label><b>Suffix <span class="text-gray">(Optional)</span> :</b></label>
                                <input type="text" autocomplete="off" name="admission_suffix" id="admission_suffix" placeholder="Enter Suffix" class="form-control1 input-sm">
                            </div>
                        </div>
                    </div>

                        <div class="card mg-t-10">
                            <div class="card-header bg-gray-100"><b><i class="fa fa-desktop"></i> Student Prospectus Setting</b>
                            </div>
                            <div class="card-body row pd-5 pd-t-5 pd-b-5 tx-13 m-0 flex-fill">
                                <div class="col-lg-2 m-0">
                                    <label><b>Prefix <span class="text-gray">(Optional)</span> :</b></label>
                                    <input type="text" name="prospectus_prefix" id="admission_prefix" placeholder="Enter Prefix" class="form-control1 input-sm">
                                </div>
                                <div class="col-lg-3 m-0 ">
                                    <label><b>Admission No. Start <span class="text-gray">(Optional)</span> :</b></label>
                                    <input type="text" name="prospectus_no_start" id="admission_no_start" placeholder="Enter Admission No. Start" class="form-control1 input-sm">
                                </div>
                                <div class="col-lg-2 m-0">
                                    <label><b>Suffix <span class="text-gray">(Optional)</span> :</b></label>
                                    <input type="text" name="prospectus_suffix" id="admission_suffix" placeholder="Enter Suffix" class="form-control1 input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 vhr">
                        <button type="submit" class="btn btn-primary btn-block mg-t-10"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
