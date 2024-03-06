@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
            <li class="breadcrumb-item active" aria-current="page">Satff Mark Attendance</li>
        </ol>
    </nav>
        <div class="row p-0 m-0">
            <div class="col-lg-12 p-0 m-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-check"></i> Staff Mark Attendance</b></div>
                    <div class="panel-body pd-b-0 row">
                        <form action="{{url('MasterAdmin/Attendance/StaffMarkAttendance')}}" method="POST"  data-parsley-validate="" novalidate="">
                            {{csrf_field()}}
                            <div class=" row pd-b-10  m-0">
                                <div class="col-lg-2 pd-l-0">
                                    <label><b>Department :</b></label>
                                    <select class="form-control input-sm" required="required" id="department_select" selectid="{{ request()->get('department_id') }}">
                                        <option value="">---Select---</option>
                                        @foreach(staffdepartmentlist() as $data)
                                        <option value="{{$data->id}}">{{$data->department}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label><b>Designation :</b></label>
                                    <select class="form-control input-sm" required="required" id="designation_select" selectid="{{ request()->get('designation_id') }}">
                                        <option value="">---Select---</option>
                                        @foreach(satffdesignationlist() as $data)
                                        <option value="{{$data->id}}">{{$data->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label><b>Attendance Date :</b></label>
                                    <input type="text" placeholder="Enter Date (dd-mm-yy)" value="{{date('d-m-Y')}}"
                                           autocomplete="off" class="date form-control input-sm" required>
                                </div>
                                <div class="col-lg-3">
                                    <label><b>Order By :</b></label>
                                    <select class="form-control input-sm">
                                        <option value="">-----Select----</option>
                                        <option value="">Staff Order by Ascending order</option>
                                    </select>
                                 {{--'selectid' =>request()->get('sortby') --}}
                                </div>
                                <div class="col-lg-2 mg-t-20">
                                    <button type="submit" class="btn btn-primary btn-sm">Continue <i class="fa fa-angle-right"></i></button>
                                </div>
                            </div>
                        </form>

              @if(request()->get('_token'))
             <form action="{{url('MasterAdmin/Attendance/CreateStaffMarkAttendance/1/1/10-02-2020/create')}}" class="col-lg-12 p-0 m-0" method="POST">
             {{csrf_field()}}
              <div class="col-lg-12 bd-1 bd-t row p-0 m-0">
                <div class="col-lg-10 pd-l-0">
                    <table class="table table-bordered mg-t-10 tx-12">
                        <thead class="bg-light">
                        <tr>
                            <td class="text-center align-middle"><b>S.No.</b></td>
                            <td class="text-center align-middle"><b>Staff No.</b></td>
                            <td class="text-center align-middle"><b>Staff Name</b></td>
                            <td><b>Father Name</b></td>
                            <td class="align-middle"><b>Mobile</b></td>
                            <td class="text-center align-middle">
                                <table class="table-borderless">
                                    <tr>
                                        <td><b>Attendance :</b></td>
                                        <td><input class="CheckAll" name="checkall" value="checkbox1" type="radio" checked></td>
                                        <td><span class="badge badge-success">P</span></td>
                                        <td><input type="radio" name="checkall" class="CheckAll" value="checkbox2"></td>
                                        <td><span class="badge badge-danger">A</span></td>
                                        <td><input type="radio" name="checkall" class="CheckAll" value="checkbox3"></td>
                                        <td><span class="badge badge-warning">LT.</span></td>
                                        <td><input type="radio" class="CheckAll" name="checkall" value="checkbox4"></td>
                                        <td><span class="badge badge-dark">LV.</span></td>
                                    </tr>
                                </table>
                            </td>
                            <td class="text-center"><b>Punch In</b></td>
                            <td class="text-center"><b>Punch Out</b></td>
                            <td class="text-center align-middle"><b>Overall</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staff as $data)
                            <tr id="row_{{$data->id}}" class="attendance-row">
                                <td class="text-center"><input type="hidden" name="staffid[]" readonly="readonly"
                                                               value="{{$data->id}}"> {{$loop->iteration}}</td>
                                <td class="text-center">{{$data->staff_no}}</td>
                                <td class="text-center">{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td>{{$data->ContactNo()}}</td>
                                <td class="text-center">
                                    <table cellspacing="0" cellpadding="0" class="table-borderless mx-auto p-0 m-0">
                                        <tr>
                                            <td><input type="radio" staffid="{{$data->id}}" class="checkbox1 attendance"
                                                       name="att_type_{{$data->id}}_id" value="p" checked></td>
                                            <td class="text-success"><span class="badge badge-success">Present</span></td>
                                            <td class="pd-l-20"><input type="radio" staffid="{{$data->id}}" class="checkbox2 attendance"
                                                                       name="att_type_{{$data->id}}_id" value="a">
                                            </td>
                                            <td><span class="badge badge-danger">Absent</span></td>
                                            <td class="pd-l-20"><input type="radio" staffid="{{$data->id}}" class="checkbox3 attendance"
                                                                       name="att_type_{{$data->id}}_id" value="lt">
                                            </td>
                                            <td><span class="badge badge-warning">Late</span></td>
                                            <td class="pd-l-20"><input type="radio" staffid="{{$data->id}}" class="checkbox4 attendance"
                                                                       name="att_type_{{$data->id}}_id" value="lv">
                                            </td>
                                            <td><span class="badge badge-dark">Leave</span></td>
                                        </tr>
                                    </table>
                                </td>
                                <td><input type="text" id="punch_in_{{ $data->id }}" name="punch_in_{{ $data->id }}" placeholder="yyyy-mm-dd H:i:s" class="form-control1 input-sm datetimepicker"></td>
                                <td><input type="text" id="punch_out_{{$data->id }}" name="punch_out_{{ $data->id }}" placeholder="yyyy-mm-dd H:i:s" class="form-control1 input-sm datetimepicker"></td>
                                <td class="text-center">88%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2 vhr">
                    <button class="btn btn-outline-primary btn-small"><i class="fa fa-plus"></i> Create</button>
                    <button class="btn btn-outline-success btn-small"><i class="fa fa-plus"></i> Attendance Report</button>
                    <table class="table table-bordered mg-t-20">
                        <tr>
                            <td><b>Total Staff</b></td>
                            <td class="text-center wd-30p"><span
                                    class="total_staff">{{count(staffshortlist([]))}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Total Present</b></td>
                            <td class="text-center wd-30p"><span class="total_present">0</span></td>
                        </tr>
                        <tr>
                            <td><b>Total Absent</b></td>
                            <td class="text-center wd-30p"><span class="total_absent">0</span></td>
                        </tr>
                        <tr>
                            <td><b>Total Late</b></td>
                            <td class="text-center wd-30p"><span class="total_late">0</span></td>
                        </tr>
                        <tr>
                            <td><b>Total Leave</b></td>
                            <td class="text-center wd-30p"><span class="total_leave">0</span></td>
                        </tr>
                    </table>
                </div>
            </div>
             </form>
                  @endif
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(".attendance").on("change",function () {
            var staffid=$(this).attr('staffid');
            var attendance=$(this).val();
            if(attendance=="p"){
                var bgcolor="#fff";
            }else
            if(attendance=="a"){
                var bgcolor="#FADBD8";
            }else
            if(attendance=="lt"){
                var bgcolor="#FCF3CF";
            }else
            if(attendance=="lv"){
                var bgcolor="#D5D8DC";
            }
            $("#row_"+staffid).css("background-color",bgcolor);
        });
    </script>
@endsection
