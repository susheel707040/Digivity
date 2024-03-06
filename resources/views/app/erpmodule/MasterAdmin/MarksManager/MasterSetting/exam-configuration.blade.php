@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Exam Configuration</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cogs"></i> Exam Configuration</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 row m-0 pd-l-0 pd-r-0 pd-b-10 bd-b bd-1">
                    <div class="col-lg-3">
                        <label>Class/Course - Section <sup>*</sup> :</label>
                        @include('components.course-section-import',['selectid'=>request()->route('course')])
                    </div>
                    <div class="col-lg-3">
                        <label>Exam Term <sup>*</sup> :</label>
                        @include('components.MarksManager.exam-term-import',['selectid'=>request()->route('examtermid')])
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn continue-btn btn-primary mg-t-20">Continue <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>

                @if(isset($examtype))
                <form action="{{url('/MasterAdmin/MarksManager/StoreExamConfiguration')}}" method="POST">
                {{csrf_field()}}
                    <input type="hidden" autocomplete="off" readonly="readonly" name="course_id" value="{{$courseid}}">
                    <input type="hidden" autocomplete="off" readonly="readonly" name="section_id" value="{{$sectionid}}">
                    <input type="hidden" autocomplete="off" readonly="readonly" name="exam_term_id" value="{{$examtermid}}">
                <div class="col-lg-12 p-0 row m-0 bd-t bd-1">
                    <div class="col-lg-12 row m-0">
                        @foreach($examtype as $data)
                            <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-10 mg-b-10">
                            <div class="panel panel-default m-0 p-0">
                                <div class="panel-heading text-right bg-light">
                                    @php
                                    $gradeselectid=0;
                                    if(isset($examconfig)&&(count($examconfig)>0)){
                                        try {
                                        $examconfiggradedata=array_keys(collect($examconfig)->where('exam_type_id',$data->id)->groupBy('grade_id')->toArray());
                                        $gradeselectid=$examconfiggradedata[0];
                                       }catch (\Exception $e){}
                                    }
                                    @endphp
                                    <table>
                                    <tr>
                                        <td><span><input type="hidden" name="exam_type_id[]" class="exam_type_{{$data->id}}_id" value="{{$data->id}}">
                                                  <input type="hidden" name="exam_integrate_{{$data->id}}" value="{{$data->integrate}}">
                                                <b>{{$data->exam_type}}</b> @if(isset($data->alias))- [ {{$data->alias}} ]@endif</span></td>
                                        <td class="pd-l-10 pd-r-10">|</td><td><b>Grade Applicable :</b></td>
                                        <td class="pd-l-10">@include('components.MarksManager.exam-grade-system-import',['name'=>'grade_'.$data->id.'_id','id'=>'grade_'.$data->id.'_id','selectid'=>$gradeselectid])</td>
                                    </tr>
                                    </table>
                                </div>
                                <div class="panel-body p-1 m-0 row">
                                    <div id="assessment-subject-import-{{$data->id}}" class="container-fluid text-center">
                                    @if(isset($examconfig)&&(count($examconfig)>0))
                                        @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.ExamConfigImport.exam-subject-config-table-import',['integrate'=>$data->integrate,'examtypeid'=>$data->id])
                                    @endif
                                        <button type="button" onclick="ExamConfigModal('{{$courseid}}','{{$sectionid}}','{{$examtermid}}','{{$data->id}}','{{$data->integrate}}')" class="btn btn-white text-info mx-auto mg-t-10 mg-b-10"><b><i class="fa fa-plus"></i> Add Exam Assessment & Subject/Activity</b></button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 bd-t bd-1 pd-b-10 pb-t-10 text-right">
                            <button type="submit" class="btn btn-primary btn-lg mg-t-10"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </div>
                </form>

                    <div class="modal fade" id="ExamImportConfig" tabindex="-1" role="dialog" aria-hidden="true">
                        <div id="modal-dialog" class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" >
                                <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                                    <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                    <div class="media align-items-center">
                                        <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                                        <div class="media-body mg-sm-l-20">
                                            <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Exam Term Assessment & Subject/Activity</b></h4>
                                            <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Exam Term Assessment & Subject/Activity Import Data</p>
                                        </div>
                                    </div><!-- media -->
                                </div><!-- modal-header -->
                                <div class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
                                    <div class="row m-0 pd-b-10">
                                        <div class="col-lg-12">
                                            <label>Select Subject or Activities <sup>*</sup> :</label>
                                            <table class="mg-l-10">
                                                <tr>
                                                    <td><input type="radio" class="integrate integrate-subject" name="integrate" value="subject"></td><td class="pd-l-5">Subject</td>
                                                    <td class="pd-l-10"><input type="radio" name="integrate" class="integrate integrate-activities" value="activities"></td><td class="pd-l-5">Activities</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Exam Term Assessment <sup>*</sup> :</label>
                                            @foreach($examassessment as $assessmentdata)
                                                <div class="col-lg-12 pd-l-10 mg-t-5"><input type="checkbox" class="assessment_id" name="select_assessment_id" value="{{$assessmentdata->id}}"> {{$assessmentdata->exam_assessment}}</div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Grade System Applicable <sup>*</sup> :</label>
                                            <div class="col-lg-6 pd-l-10">@include('components.MarksManager.exam-grade-system-import',['id'=>'select_grade_id'])</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer pd-x-20 pd-y-15">
                                    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    <button type="button" class="btn btn-primary config-continue-btn float-right"> <i class="fa fa-check"></i> Continue</button>
                                </div>
                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->


                @endif
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(".continue-btn").click(function (){
           if($("#course_section_id").val()==0){
               swal("Opps!", "Please first select Class/Course!", "error");
               return false;
           }else
            if($("#exam_term_id").val()==0){
                swal("Opps!", "Please select Exam Term!", "error");
                return false;
            }else{
                loader("block");
                window.location.assign("/MasterAdmin/MarksManager/ExamConfiguration/"+$("#course_section_id").val()+"/"+$("#exam_term_id").val()+"");
            }
        });
    </script>
    <script type="text/javascript">
        function ExamConfigModal(courseid,sectionid,examtermid,examtypeid,examintegrate){
            $("#ExamImportConfig").modal('show');
            $(".integrate-"+examintegrate+"").prop('checked', true);
            $(".config-continue-btn").attr('onClick',"AddAssessement('"+courseid+"','"+sectionid+"','"+examtermid+"','"+examtypeid+"','"+examintegrate+"')");
        }
        function AddAssessement(courseid,sectionid,examtermid,examtypeid,examintegrate){
           //client side validation
            if ($(".assessment_id:checked").length < 1){ swal("Opps!", "Please Check atleast One Exam Term Assessment!", "error"); return false; }
            if($("#select_grade_id").val()==0){ swal("Opps!", "Please Select Grade System Applicable!", "error"); return false;}
            $("#grade_"+examtypeid+"_id").val($("#select_grade_id").val());
            $("#ExamImportConfig").modal('hide');
            loader('block');
            var examassessmentids = [];
            var i = 0;
            $('.assessment_id:checked').each(function () {
                examassessmentids[i++] = $(this).val();
            });
            $("#assessment-subject-import-"+examtypeid).html("Please wait few seconds...");
            loader('block');
            formrequestajax('','/MasterAdmin/MarksManager/ExamConfiguration/ImportSubjectAndAssessment?courseid='+courseid+'&sectionid='+sectionid+'&examtermid='+examtermid+'&examassessmentids='+examassessmentids+'&examtypeid='+examtypeid+'&integrate='+$(".integrate:checked").val()+'','GET').success(function(data){
                loader('none');
                $("#assessment-subject-import-"+examtypeid).html(data);
            }).fail(function(sender, message, details){
                loader('none');
                swal("Opps!", "Sorry, something went wrong!", "error");
                return false;
            });
        }
    </script>
@endsection

