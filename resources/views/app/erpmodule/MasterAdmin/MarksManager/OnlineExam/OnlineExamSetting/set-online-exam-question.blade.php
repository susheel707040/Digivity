@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Marks Manager</li>
            <li class="breadcrumb-item active" aria-current="page">Online Exam Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Set Online Exam Quotation</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Set Online Exam Quotation</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="{{url('MasterAdmin/MarksManager/SetOnlineExamQuestion')}}" method="POST">
                 {{csrf_field()}}
                <div class="col-lg-12 pd-t-20 pd-b-10">
                    <table>
                        <tr>
                            <td><b>Class/Course</b></td><td class="pd-l-10"><b>:</b></td>
                            <td class="pd-l-10">@include('components.course-import',['class'=>'form-control wd-200','required'=>'required','selectid'=>request()->get('course_id')])</td>
                            <td class="pd-l-20"><b>Section</b></td><td class="pd-l-10"><b>:</b></td>
                            <td class="pd-l-10">@include('components.section-import',['class'=>'form-control wd-200','required'=>'required','selectid'=>request()->get('section_id')])</td>
                            <td class="pd-l-20">
                                <button class="btn btn-primary">Continue <i class="fa fa-arrow-right"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                </form>
                @if(request()->get('_token'))
                <div class="col-lg-12 bd-t bd-1 mg-t-10 pd-t-10 pd-b-10">
                 <table class="table table-bordered">
                     <thead class="bg-light">
                     <tr>
                         <th>Sl.No</th>
                         <th>Exam Name</th>
                         <th>Exam Type</th>
                         <th>Start Date</th>
                         <th>End Date</th>
                         <th>Status</th>
                         <th class="text-center">View Exam Question</th>
                         <th class="text-center">Add Exam Question</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($onlineexam as $data)
                     <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>{{$data->exam_name}}</td>
                         <td>{{ucwords($data->exam_type)}}</td>
                         <td>{{nowdate($data->start_date,'d-M-Y')}}</td>
                         <td>{{nowdate($data->end_date,'d-M-Y')}}</td>
                         <td>Publish</td>
                         <th class="text-center"><span url="{{url('MasterAdmin/MarksManager/ViewOnlineQuestionPaper/'.$data->id.'/'.request()->get('course_id').'')}}" model-title="View Question Paper" model-class="modal-lg" model-title-info="View Online Exam Question Paper" class="custom-model-btn cursor-pointer"><u class="text-primary tx-14"><i class="fa fa-list"></i> View Question</u></span></th>
                         <td class="text-center"><a href="{{url('MasterAdmin/MarksManager/AddOnlineQuestionPaper/'.$data->id.'/'.request()->get('course_id').'/'.request()->get('section_id').'')}}" class="tx-14"><u><i class="fa fa-plus"></i>Set Exam Question</u></a></td>
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
