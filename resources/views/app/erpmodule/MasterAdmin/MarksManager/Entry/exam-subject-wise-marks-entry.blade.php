@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Exam Entry</li>
            <li class="breadcrumb-item active">Subject Wise Marks Entry</li>
        </ol>
    </nav>
    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Subject Wise Marks Entry</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="{{url('MasterAdmin/MarksManager/ExamSubjectWiseMarksEntry')}}" method="GET">
                <div class="col-lg-12 bd-b bd-1 m-0 row pd-b-10">
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Class/Course - Section :</label>
                        @include('components.course-section-import',['selectid'=>request()->get('course_section_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Exam Term :</label>
                        @include('components.MarksManager.exam-term-import',['class'=>'form-control select-box','selectid'=>request()->get('exam_term_id'),'data'=>['for'=>'exam_type_id','this_id'=>'exam_term_id','request_ids'=>'course_section_id','get'=>'examtypelist']])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Exam Type :</label>
                        @include('components.MarksManager.exam-type-import',['class'=>'form-control select-box','search'=>['customsearch'=>['whereIn'=>['id'=>$examtypesearch]]],'selectid'=>request()->get('exam_type_id'),'data'=>['for'=>'exam_assessment_id','this_id'=>'exam_type_id','request_ids'=>'course_section_id,exam_term_id','get'=>'examassessmentlist']])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Exam Assessment :</label>
                        @include('components.MarksManager.exam-assessment-import',['class'=>'form-control select-box','search'=>['customsearch'=>['whereIn'=>['id'=>$examassessmentsearch]]],'selectid'=>request()->get('exam_assessment_id'),'data'=>['for'=>'subject_id','this_id'=>'exam_assessment_id','request_ids'=>'course_section_id,exam_term_id,exam_type_id','get'=>'examsubjectlist']])
                    </div>
                    <div class="col-lg-4 pd-l-5 pd-r-5">
                        <table cellpadding="0" cellspacing="0" class="m-0 p-0">
                            <tr>
                                <td colspan="4"><label>Entry Tabindex :</label></td>
                                <td class="pd-l-15"><label>Student List Sort By :</label></td>
                            </tr>
                            <tr><td><input type="radio" name="tabindex" checked></td><td class="pd-l-5"><i class="fa fa-arrow-down"></i></td>
                                <td class="pd-l-10"><input name="tabindex" type="radio"></td><td class="pd-l-5"><i class="fa fa-arrow-right"></i></td>
                                <td class="pd-l-15">@include('components.student-sort-by')</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Select Subject/Activities for Marks Entry :</label>
                        @include('components.MarksManager.exam-subject-import',['class'=>'form-control multiselect','name'=>'subject_id','search'=>['customsearch'=>['whereIn'=>['id'=>$examsubjectsearch]]],'selectid'=>request()->get('subject_id'),'multiple'=>'1'])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <button type="button" id="search" class="btn btn-primary btn-sm mg-t-20">Continue <i class="fa fa-arrow-right"></i></button>
                    </div>

                </div>
                </form>

                @if(isset($student)&&(count($student)>0))
               <form class="container-fluid" action="{{url('MasterAdmin/MarksManager/StoreExamSubjectWiseMarksEntry')}}" method="POST">
                   {{csrf_field()}}
                <div class="col-lg-12">
                    <div class="col-lg-12 pd-l-10 pd-r-10 bg-light bd bd-1 pd-t-5 pd-b-5 tx-14 mg-t-10 mg-b-10">
                        <table>
                            <tr>
                                <td><b>Class/Course :</b></td><td class="pd-l-5 pd-r-10">
                                    <span class="badge badge-success tx-13">
                                        @if(isset($coursedata)){{$coursedata->course}}@endif - @if(isset($sectiondata)) {{$sectiondata->section}}
                                        <input type="hidden" readonly="readonly" name="course_id" value="{{$coursedata->id}}">
                                        <input type="hidden" readonly="readonly" name="section_id" value="{{$sectiondata->id}}">
                                        @endif
                                    </span>
                                </td>
                                <td><b>Exam Term :</b></td><td class="pd-l-5 pd-r-10"><span class="badge badge-success tx-13">@if(isset($examterm)) {{$examterm->exam_term}} <input type="hidden" readonly="readonly" value="{{$examterm->id}}" name="exam_term_id"> @endif</span></td>
                                <td><b>Exam Type :</b></td><td class="pd-l-5 pd-r-10"><span class="badge badge-success tx-13">@if(isset($examtype)) {{$examtype->exam_type}} <input type="hidden" readonly="readonly" value="{{$examtype->id}}" name="exam_type_id"> @endif</span></td>
                                <td><b>Exam Assessment :</b></td><td class="pd-l-5 pd-r-10"><span class="badge badge-success tx-13">@if(isset($examassessment)) {{$examassessment->exam_assessment}} <input type="hidden" readonly="readonly" value="{{$examassessment->id}}" name="exam_assessment_id"> @endif</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-l-12 pd-l-0 pd-r-0">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">Sl.No</th>
                                <th class="text-center">Adm. No.</th>
                                <th class="text-center">Roll No.</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                @foreach($subject as $subjectdata)
                                <th>{{$subjectdata->SubjectName()}} <input type="hidden" name="subject_id[]" value="{{$subjectdata->subject_id}}"></th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($student as $data)
                            <tr>
                                <td class="text-center wd-20">{{$loop->iteration}} <input type="hidden" readonly="readonly" name="student_id[]" value="{{$data->student_id}}"></td>
                                <td class="text-center wd-100">{{$data->admission_no}}</td>
                                <td class="text-center wd-70">{{$data->roll_no}}</td>
                                <td class="wd-10p">{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                @foreach($subject as $subjectdata)
                                    @php $groupid=$data->student_id."_".$subjectdata->subject_id; @endphp
                                <td>
                                    @php
                                    //if entry record exist already
                                    $existattendstatus="";
                                    if(isset($exammarksrecord)&&(count($exammarksrecord)>0)){
                                        $entryrecord=collect($exammarksrecord)->where('student_id',$data->student_id)->where('subject_id',$subjectdata->subject_id)->first();
                                        if(isset($entryrecord->attend_status)){
                                        $existattendstatus=$entryrecord->attend_status;
                                        }
                                    }
                                    @endphp


                                    <table cellspacing="0" cellpadding="0" class="m-0 border-0 p-0">
                                        <tr>
                                            <td class="m-0 p-0 border-0"><input type="text" autocomplete="off" @if(isset($entryrecord->marks)) value="{{$entryrecord->marks}}" @endif placeholder="0" name="mark_{{$groupid}}" class="form-control text-center wd-40 bg-success-light"></td>
                                            <td class="m-0 p-0 border-0">@include('component.MarksManager.exam-absent-entry-import',['class'=>'form-control wd-55','name'=>'exam_attend_'.$groupid,'selectid'=>$existattendstatus])</td>
                                        </tr>
                                    </table>

                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-lg-12 pd-l-0 pd-r-0 text-right pd-b-10 bd-t bd-2">
                            <button type="submit" class="btn btn-primary btn-lg mg-t-10">@if(isset($entryrecord)&&($entryrecord)) <i class="fa fa-edit"></i> Update @else <i class="fa fa-check"></i> Submit @endif</button>
                        </div>
                    </div>
                </div>
                    </form>

               @endif
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#search").click(function() {
                loader('block');
                var params = {};
                var validation=0;
                var getSelect = ['course_section_id', 'exam_term_id','exam_type_id','exam_assessment_id','sort_by','subject_id'];
                $.each(getSelect, function(index, value) {
                    var select = $('#' + value);
                    if (select.val() != '') {
                        var selected = select.val();
                        if (select.attr('multiple'))
                            selected = selected.join(',');
                        params[value] = selected;
                    }else{
                        validation++;
                        loader('none');
                        alert(value);
                        return false;
                    }
                });
                if (validation==0 && !$.isEmptyObject(params)) {
                    var url = [location.protocol, '//', location.host, location.pathname].join('');
                    window.location.href = url + '?' + $.param(params);
                }
            });
        });
    </script>

@endsection
