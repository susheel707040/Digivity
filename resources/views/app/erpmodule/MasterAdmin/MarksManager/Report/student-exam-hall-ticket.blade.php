@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Report</li>
            <li class="breadcrumb-item active">Student Exam Hall Ticket</li>
        </ol>
    </nav>
    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Exam Hall Ticket</b></div>
            <div class="panel-body pd-b-0 row">
               <form class="container-fluid" action="{{url('MasterAdmin/MarksManager/ExamHallTicket')}}" method="POST">
                {{csrf_field()}}
                 <div class="col-lg-12 row m-0 pd-b-20">
                <div class="col-lg-2 pd-l-5 pd-r-5">
                    <label>Class/Course :</label>
                    @include('components.course-import',['selectid'=>request()->get('course_id')])
                </div>
                <div class="col-lg-2 pd-l-5 pd-r-5">
                    <label>Section :</label>
                    @include('components.section-import',['selectid'=>request()->get('section_id')])
                </div>
                <div class="col-lg-2 pd-l-5 pd-r-5">
                    <button type="submit" class="btn btn-primary bt-sm mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                </div>
                </div>
               </form>

                <div class="col-lg-12 bd-t bd-1">
                    <div class="col-lg-12 pd-l-0">
                        <button type="button" id="print-sheet" class="btn btn-info btn-sm mg-t-10"><i class="fa fa-print"></i> Student Hall Ticket Print</button>
                    </div>
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sl.No.</th>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th class="text-center">Admission No.</th>
                            <th>Class/Course</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Contact No.</th>
                            <th>Fee Status</th>
                            <Th>Fee Amount</Th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center"><input type="checkbox" class="checkbox1 student_id" value="{{$data->student_id}}"></td>
                            <td class="text-center">{{$data->admission_no}}</td>
                            <td>{{$data->CourseSection()}}</td>
                            <td>{{$data->FullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->student->contact_no}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#print-sheet").click(function (){
            var studentids = [];
            $('.student_id:checked').each(function() {
                studentids.push($(this).val());
            });
            if(studentids){
                window.open("/MasterAdmin/MarksManager/ExamHallTicketPrint/"+studentids+"", '_blank');
            }
        });
    </script>

@endsection
