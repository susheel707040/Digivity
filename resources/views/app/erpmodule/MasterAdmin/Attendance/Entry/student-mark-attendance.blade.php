@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
            <li class="breadcrumb-item active" aria-current="page">Student Mark Attendance</li>
        </ol>
    </nav>
        <div class="row p-0 m-0">
            <div class="col-lg-12 p-0 m-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-check"></i> Student Mark Attendance</b></div>
                    <div class="panel-body pd-b-0 row">
                        <form action="{{url('MasterAdmin/Attendance/StudentMarkAttendance')}}" method="POST"  data-parsley-validate="" novalidate="">
                            {{csrf_field()}}
                            <div class=" row pd-b-10  m-0">
                                <div class="col-lg-2 pd-l-0">
                                    <label><b>Course/Class :</b></label>
                                    @include('components.course-import',['required'=>'required','selectid'=>request()->get('course_id')])
                                </div>
                                <div class="col-lg-2">
                                    <label><b>Section :</b></label>
                                    @include('components.section-import',['selectid'=>request()->get('section_id')])
                                </div>
                                <div class="col-lg-2">
                                    <label><b>Attendance Date :</b></label>
                                    <input type="text" placeholder="dd-mm-yy" value="{{date('d-m-Y')}}"
                                           autocomplete="off" class="date form-control input-sm" required>
                                </div>
                                <div class="col-lg-3">
                                    <label><b>Order By :</b></label>
                                    @include('components.student-sort-by',['class'=>'form-control input-sm','id'=>'student_sort_by','name'=>'student_sort_by','required'=>'','selectid'=>request()->get('student_sort_by'),'other'=>0])
                                    {{--'selectid' =>request()->get('sortby') --}}
                                </div>
                                <div class="col-lg-2 mg-t-20">
                                    <button type="submit" class="btn btn-primary btn-sm">Continue <i class="fa fa-angle-right"></i></button>
                                </div>
                            </div>
                        </form>

              @if(request()->get('_token'))
             <form action="{{url('MasterAdmin/Attendance/CreateStudentMarkAttendance/1/1/10-02-2020/create')}}" class="col-lg-12 p-0 m-0" method="POST">
             {{csrf_field()}}
              <div class="col-lg-12 bd-1 bd-t row p-0 m-0">
                <div class="col-lg-10 pd-l-0">
                    <table class="table table-bordered mg-t-10 tx-12">
                        <thead class="bg-light">
                        <tr>
                            <td class="text-center align-middle"><b>#</b></td>
                            <td class="text-center align-middle"><b>Admisison No.</b></td>
                            <td class="text-center align-middle"><b>Roll No.</b></td>
                            <td><b>Course-Section</b></td>
                            <td class="align-middle"><b>Student Name</b></td>
                            <td class="align-middle"><b>Father Name</b></td>
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
                            <td class="text-center align-middle"><b>Overall</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                            <tr id="row_{{$data->student_id}}" class="attendance-row">
                                <td class="text-center"><input type="hidden" name="studentid[]" readonly="readonly"
                                                               value="{{$data->student_id}}"> {{$loop->iteration}}</td>
                                <td class="text-center">{{$data->admission_no}}</td>
                                <td class="text-center">{{$data->roll_no}}</td>
                                <td>{{$data->CourseSection()}}</td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td>{{$data->student->contact_no}}</td>
                                <td class="text-center">
                                    <table cellspacing="0" cellpadding="0" class="table-borderless mx-auto p-0 m-0">
                                        <tr>
                                            <td><input type="radio" studentid="{{$data->student_id}}" class="checkbox1 attendance"
                                                       name="att_type_{{$data->student_id}}_id" value="p" checked></td>
                                            <td class="text-success"><span class="badge badge-success">Present</span></td>
                                            <td class="pd-l-20"><input type="radio" studentid="{{$data->student_id}}" class="checkbox2 attendance"
                                                                       name="att_type_{{$data->student_id}}_id" value="a">
                                            </td>
                                            <td><span class="badge badge-danger">Absent</span></td>
                                            <td class="pd-l-20"><input type="radio" studentid="{{$data->student_id}}" class="checkbox3 attendance"
                                                                       name="att_type_{{$data->student_id}}_id" value="lt">
                                            </td>
                                            <td><span class="badge badge-warning">Late</span></td>
                                            <td class="pd-l-20"><input type="radio" studentid="{{$data->student_id}}" class="checkbox4 attendance"
                                                                       name="att_type_{{$data->student_id}}_id" value="lv">
                                            </td>
                                            <td><span class="badge badge-dark">Leave</span></td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-center"><b>0.00%</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2 vhr">
                    <button class="btn btn-outline-primary  mg-t-10 btn-block"><i class="fa fa-plus"></i> Create</button>
                    <table class="table table-bordered mg-t-20">
                        <tr>
                            <td><b>Total Student</b></td>
                            <td class="text-center wd-30p"><span
                                    class="total_student">{{count(studentshortlist([]))}}</span></td>
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
            var studentid=$(this).attr('studentid');
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
            $("#row_"+studentid).css("background-color",bgcolor);
        });

    </script>
@endsection
