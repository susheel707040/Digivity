@extends('layouts.MasterLayout')


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Subject Map With Class/Course</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Subject Map With Class/Course List</b></div>
            <div class="panel-body pd-b-0 row">

                <div class="col-lg-12 bd-b bd-1">
                  <table class="mg-t-10 wd-50p mg-b-10">
                      <tr>
                          <td class="wd-15p"><b>Class/Course :</b></td>
                          <td class="pd-l-10 pd-r-10">
                              @include('components.course-section-import',['class'=>'form-control','selectid'=>request()->route('course')])
                          </td>
                          <td><button type="button"  class="btn continue-btn btn-primary">Continue <i class="fa fa-arrow-right"></i></button></td>
                      </tr>
                  </table>
                </div>

                @if(request()->route('course'))
                <form class="subject-map-form container-fluid" loader-disable="true" action="{{url('MasterAdmin/MarksManager/StoreSubjectMapWithCourse')}}" method="POST" enctype="multipart/form-data">
                   {{csrf_field()}}
                    <input type="hidden" id="i_course_id" name="course_id" autocomplete="off" readonly="readonly" value="{{$courseid}}">
                    <input type="hidden" id="i_section_id" name="section_id" autocomplete="off" readonly="readonly" value="{{$sectionid}}">
                    <div class="col-lg-12 text-right">
                        <button type="button" href="#CopyClassModel" data-toggle="modal" class="btn btn-primary btn-sm mg-t-10">Copy to Class/Course</button>
                    </div>
                    <div class="col-lg-12 pd-b-10">
                    <table id="subject-table" class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th>Subject <br/><span class="text-danger tx-9">(mandatory)</span></th>
                            <th>Subject Position <br/> <span class="text-danger tx-9">(mandatory)</span></th>
                            <th class="wd-55p">Choose Subject Skills For Marks Entry<br/> <span class="text-danger tx-9">(optional)</span></th>
                            <th>Subject Applicable</th>
                            <th class="wd-10p text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody class="subject-body">
                        @if(isset($subjectmapclass)&&(count($subjectmapclass)>0))
                            @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Config.existing-subject-map-with-course-body-data',['subjectmapclass'=>$subjectmapclass])
                        @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-info tx-14 add-subject btn-xs rounded-5"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <div class="col-lg-12 bd-1 pd-t-10 pd-b-10 text-right bd-t">
                    <button type="submit" class="btn btn-primary btn-lg">@if(isset($subjectmapclass)&&(count($subjectmapclass)>0)) <i class="fa fa-edit"></i> Update @else <i class="fa fa-check"></i> Submit @endif</button>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="CopyClassModel" tabindex="-1" role="dialog" aria-hidden="true">
        <div id="modal-dialog" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" >
                <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                    <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="media align-items-center">
                        <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-copy fa-lg"></i></span>
                        <div class="media-body mg-sm-l-20">
                            <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Duplicate Copy to Class/Course</b></h4>
                            <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Duplicate Copy to Class/Course & Section</p>
                        </div>
                    </div><!-- media -->
                </div><!-- modal-header -->
                <div class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
                    <div class="row m-0 pd-b-10">
                        <div class="col-lg-8">
                            <label><b>Class/Course-Section :</b></label>
                            @include('components.course-section-import',['class'=>'form-control','id'=>'copy_course_id'])
                        </div>
                        <div class="col-lg-12">
                        <p><b>Note : </b><br/>Select the class to copy the given setup.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="button" id="copysetup" class="btn btn-primary config-continue-btn float-right"> <i class="fa fa-check"></i> Copy Setup</button>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->



    <script type="text/javascript">
        $(".continue-btn").click(function (){
            loader('block');
            var course=$("#course_section_id").val();
            if(course==0){
                window.location.assign("/MasterAdmin/MarksManager/SubjectMapWithCourse");
            }else{
                window.location.assign("/MasterAdmin/MarksManager/SubjectMapWithCourse/"+course+"");
            }
        });
        $("#course_section_id").on("change",function (){
            loader('block');
            var course=$(this).val();
            if(course==0){
                window.location.assign("/MasterAdmin/MarksManager/SubjectMapWithCourse");
            }else{
                window.location.assign("/MasterAdmin/MarksManager/SubjectMapWithCourse/"+course+"");
            }
        });
    </script>
    <script type="text/javascript">
        @if(isset($subjectmapclass)&&(count($subjectmapclass)>0))
        var row="{{count($subjectmapclass->groupBy('subject_id'))}}";
        @else
        var row=0;
        @endif
        function SubjectBody(){
            loader('block');
            row++;
            formrequestajax('','/MasterAdmin/MarksManager/SubjectMapWithClass/ImportSubject/'+row+'','GET',false).success(function(data){
                loader('none');
                $(".subject-body").append(data);

                var previous;
                $(".exam-subject").on('focus', function () {
                    previous = this.value;
                }).change(function() {
                    $("#subject-applicable-" + $(this).data('rowid')).html("<span><input type='radio' class='subject_applicable' name='subject_applicable_"+$(this).val()+"' value='1' checked> All Student</span><br/>"+
                        "<span><input type='radio' class='subject_applicable' name='subject_applicable_"+$(this).val()+"' value='0'> Student Choose</span>");
                    if($(".subject-skill-body-"+$(this).data('rowid')).text()) {
                        swal.fire({
                            title: "Are you sure?",
                            text: "Once Change Subject, you will loss skill table data and not be able to recover this subject Skill Group & skills!",
                            icon: "warning", buttons: true, dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $(".subject-skill-body-" + $(this).data('rowid')).html('');
                                    return false;
                                }
                                $(this).val(previous);
                                return false;
                            });
                    }
                });

                return false;
            }).fail(function(sender, message, details){
                loader('none');
                swal("Opps!", "Sorry, something went wrong!", "error");
                return false;
            });
        }
        function SubjectSkillBody(subjectid,rowid){
            loader('block');
            formrequestajax('','/MasterAdmin/MarksManager/SubjectMapWithClass/'+subjectid+'/'+rowid+'/ImportSubjectSkill','GET',false).success(function(data){
                loader('none');
                $(".subject-skill-body-"+rowid).append(data);
                return false;
            }).fail(function(sender, message, details){
                loader('none');
                swal("Opps!", "Sorry, something went wrong!", "error");
                return false;
            });

        }

        $(".add-subject").click(function (){
            SubjectBody();
        });

        //click subject skill add table rows
        function SubjectSkillAdd(rowid){
            if($("#subject_id_"+rowid).val()==0){
                swal({
                    title: "Opps!",
                    text: "Please First Select Subject!",
                    icon: "error",button: "Okay",
                });
                $("#subject_id_"+rowid).focus();
                return false;
            }
            //SUBJECT SKILL FUNCTION
            var subjectid=$("#subject_id_"+rowid).val();
            SubjectSkillBody(subjectid,rowid);
            $(".subject-skill-table").on("click", ".remove-subject-skill-row", function() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this subject & skills!",
                    icon: "warning",buttons: true,dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            $(this).closest("tr").remove();
                        }
                        return false;
                    });
            });
        }
        $("#subject-table").on("click", ".remove-subject-row", function() {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this subject & skills!",
                icon: "warning",buttons: true,dangerMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        $(this).closest("tr").remove();
                    }
                    return false;
                });
        });

        $(".subject-skill-table").on("click", ".remove-subject-skill-row", function() {
            swal({title: "Are you sure?",text: "Once deleted, you will not be able to recover this subject & skills!",icon: "warning",buttons: true,dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(this).closest("tr").remove();
                }
                return false;
            });
        });
        $(".subject-map-form").submit(function (){
            FormSubmit();
            return false;
        });
        function FormSubmit(){
            loader('block');
            formrequestajax('form.subject-map-form',null,'POST',false).success(function(data){
                loader('none');
                console.log(data);
                var result=$.parseJSON(data);
                //alert message return
                Alert(result);
                return false;
            }).fail(function(sender, message, details){
                loader('none');
                swal("Opps!", "Sorry, something went wrong!", "error");
                return false;
            });
        }
    </script>
    <script type="application/javascript">
        $("#copysetup").click(function (){
            var course_id=$("#copy_course_id").val();
            if(course_id!=0) {
                $("#course_section_id").val(course_id);
                if ($("#course_section_id").val() == course_id) {
                    var course=course_id.split("@");
                    if(course[0]&&course[1]){
                        $("#i_course_id").val(course[0]);
                        $("#i_section_id").val(course[1]);
                        swal({
                            title: "Are you sure?", text: "You Want to Copy Current Setup", icon: "warning", buttons: true, dangerMode: true,
                        }).then((willDelete) => {
                                if (willDelete) {
                                    FormSubmit();
                                    loader('block');
                                    window.location.assign('/MasterAdmin/MarksManager/SubjectMapWithCourse/'+course_id+'');
                                }else {return false;}
                            });
                    }
                } else {
                    swal("Opps!", "Sorry, Technical Problem, Please try again.", "error");
                    return false;
                }
            }else{
                swal("Opps!", "Please Select Class/Course-Section for Copy Setup", "error");
                return false;
            }
        });
    </script>

@endsection
