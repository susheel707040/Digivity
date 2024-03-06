@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Report</li>
            <li class="breadcrumb-item active">Student Exam Report Card Detail</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Exam Report Card Detail</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/MarksManager/Report/GenerateStudentReportCard')}}" method="POST">
                 {{csrf_field()}}
                    <div class="col-lg-12 bd-b b-1 pd-b-15 row m-0">
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Class/Course :</label>
                        @include('components.course-section-import',['selectid'=>request()->get('course_section_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Exam Term :</label>
                        @include('components.MarksManager.exam-term-import',['selectid'=>request()->get('exam_term_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <button type="submit" class="btn btn-primary btn-xs rounded-5 mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>
                </form>
                @if(isset($student))
                <div class="col-lg-12 pd-t-10">
                    <div class="col-lg-12 pd-l-0">
                        <button data-examtermid="1,2" class="btn final-result-btn btn-danger btn-sm" type="button"><i class="fa fa-print"></i> Final Report Card Print</button>
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-print"></i> Term - I Report Card Print</button>
                    </div>
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1" checked></th>
                            <th class="text-center">Admission No.</th>
                            <th class="text-center">Roll No.</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Result Print</th>
                            <th>Final Result Print</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                        <tr>
                            <td class="text-center"><input type="checkbox" value="{{$data->student_id}}" class="checkbox1 student_id" checked></td>
                            <td class="text-center">{{$data->admission_no}}</td>
                            <td class="text-center">{{$data->roll_no}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td class="bg-light"><b>Term - I</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="pd-r-10"><input type="checkbox"><span class="pd-l-5">PT</span></span>
                                            <span class="pd-r-10"><input type="checkbox"><span class="pd-l-5">SE</span></span>
                                            <span class="badge badge-primary"><i class="fa fa-print"></i>Print</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(".final-result-btn").click(function (){
            var studentids = [];
            var i = 0;
            $('.student_id:checked').each(function () {
                studentids[i++] = $(this).val();
            });
            if(studentids==0){
                swal("Opps!", "Please select atleast one student!", "error");
                return false;
            }
            var url="/MasterAdmin/MarksManager/Report/ReportCardPrint?studentids="+studentids+"&examterm="+$(this).data('examtermid')+"";
            var win = window.open(url, '_blank');
            win.focus();
        });
    </script>

@endsection
