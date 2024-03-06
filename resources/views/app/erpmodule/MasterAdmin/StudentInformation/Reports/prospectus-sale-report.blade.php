@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Prospectus Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Prospectus Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/StudentInformation/ProspectusReport')}}" method="POST">
                {{csrf_field()}}
                    <div class="col-lg-12 row m-0 pd-l-0 pd-r-0 pd-b-15">
                    <div class="col-lg-1 pd-l-0 pd-r-5">
                        <label>Pros No. :</label>
                        <input type="text" value="{{request()->get('pros_no')}}" name="pros_no" autocomplete="off" class="form-control" placeholder="Enter Pros No.">
                    </div>
                    <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label>From Date :</label>
                            <input type="text" value="{{request()->get('from_date')}}" name="from_date" autocomplete="off" class="form-control date" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label>To Date :</label>
                            <input type="text" value="{{request()->get('to_date')}}" name="to_date" autocomplete="off" class="form-control date" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Class/Course :</label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Student Name :</label>
                        <input type="text" value="{{request()->get('first_name')}}" name="first_name" autocomplete="off" class="form-control" placeholder="Enter Student Name">
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Mobile No.</label>
                        <input type="text" value="{{request()->get('mobile_no')}}" name="mobile_no" autocomplete="off" class="form-control" placeholder="Enter Mobile No.">
                    </div>

                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <button type="submit" class="btn btn-primary btn-xs mg-t-20 rounded-5"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>
                </form>

                @if(request()->get('_token'))
                <div class="col-lg-12 bd-t bd-1 pd-t-10 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle',['sms'=>1])</span></div>
                <div class="col-lg-12 pd-l-0 pd-r-0  pd-t-10">
                    <table id="example2" class="table datatable table-bordered tx-11">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th class="text-center">Sl.No.</th>
                            <th>Pros. No.</th>
                            <th>Date</th>
                            <th>Class/Course</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Father Name</th>
                            <th>Contact No.</th>
                            <th>Residence Address</th>
                            <th>Transport</th>
                            <th>Paid Amt.</th>
                            <th>Pay Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($prospectus as $data)
                        <tr>
                            <td class="text-center"><input type="checkbox" class="checkbox1" value="{{$data->id}}"></td>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$data->pros_no}}</td>
                            <td>{{nowdate($data->admission_date,'d-M-Y')}}</td>
                            <td>{{$data->CourseName()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{ucwords($data->gender)}}</td>
                            <td>{{$data->dob()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->mobile_no}}</td>
                            <td>{{$data->residence_address}}</td>
                            <td>{{$data->transport_id}}</td>
                            <td class="text-right">{{$data->paid_amt}}</td>
                            <td class="text-center">
                                @if($data->pay_status=="pending")
                                <span class="badge-warning pd-3 rounded-5">{{ucwords($data->pay_status)}}</span>
                                @elseif($data->pay_status=="paid")
                                    <span class="badge-success pd-3 rounded-5">{{ucwords($data->pay_status)}}</span>
                                @elseif($data->pay_status=="fail")
                                    <span class="badge-dark pd-3 rounded-5">{{ucwords($data->pay_status)}}</span>
                                @elseif($data->pay_status=="cancel")
                                    <span class="badge-danger pd-3 rounded-5">{{ucwords($data->pay_status)}}</span>
                                @endif
                            </td>
                            <td>
                                <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                    <button class="badge container-fluid pd-t-7 pd-b-7 border-primary tx-11 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black">Quick Action</button>
                                    <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                        @if(($data->pay_status=="pending")||($data->pay_status=="fail"))<a href="{{url('MasterAdmin/StudentInformation/ProspectusPayment/'.$data->id.'/Entry')}}"><li class="dropdown-item"><i class="fa fa-rupee-sign"></i> Pay Fee</li></a>@endif
                                        <a href="{{url('MasterAdmin/StudentInformation/EditViewProspectus/'.$data->id.'/edit')}}"><li class="dropdown-item" url=""><i class="fa fa-pen"></i> Edit Detail</li></a>
                                        <a><li hidden onclick="" class="dropdown-item"><i class="fa fa-eye"></i> Preview</li></a>
                                        <a><li hidden onclick="" class="dropdown-item"><i class="fa fa-cog"></i> Status Update</li></a>
                                        <a><li hidden class="dropdown-item text-danger"><b><i class="fa fa-trash"></i> Remove</b></li></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>


@endsection
