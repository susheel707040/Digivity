@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Marks Manager</li>
            <li class="breadcrumb-item active" aria-current="page">Online Exam Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Set Online Exam Question</li>
            <li class="breadcrumb-item active" aria-current="page">Add New Online Exam Question Paper</li>
        </ol>
    </nav>
<form action="{{url('MasterAdmin/MarksManager/StoreOnlineQuestion')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" readonly="readonly" name="course_id" value="{{$courseid}}">
    <input type="hidden" readonly="readonly" name="section_id" value="{{$sectionid}}">
    <input type="hidden" readonly="readonly" name="exam_id" value="{{$onlineexam->id}}">
    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Add New Online Exam Question Paper</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-4 pd-l-0 mx-auto">
                    <table class="table bd mg-t-10 bg-light">
                        <tr>
                            <td class="wd-25p"><b>Exam Name</b></td><td class="wd-5p"><b>:</b></td><td>{{$onlineexam->exam_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Exam Type</b></td><td><b>:</b></td><td>{{ucwords($onlineexam->exam_type)}}</td>
                        </tr>
                        <tr>
                            <td><b>Start Date</b></td><td><b>:</b></td><td>{{nowdate($onlineexam->start_date,'d-M-Y')}}</td>
                        </tr>
                        <tr>
                            <td><b>End Date</b></td><td><b>:</b></td><td>{{nowdate($onlineexam->end_date,'d-M-Y')}}</td>
                        </tr>
                    </table>
                    <span url="{{url('MasterAdmin/MarksManager/ViewOnlineQuestionPaper/'.$onlineexam->id.'/'.request()->route('courseid').'')}}" model-title="View Question Paper" model-class="modal-lg" model-title-info="View Online Exam Question Paper" class="custom-model-btn cursor-pointer"><u class="text-primary tx-14"><i class="fa fa-list"></i> View Question Paper</u></span>
                </div>
                <div class="col-lg-8 vhr row">
                <div class="col-lg-12 pd-b-10 mg-t-5">
                    <label>Question Category : </label>
                    <table cellspacing="0" cellpadding="0" class="table table-borderless m-0 p-0">
                        <tr>
                            <td class="p-0 m-0">
                                @include('components.MarksManager.online-exam-question-category-import',['class'=>'form-control select-search question-category','search'=>['exam_id'=>$onlineexam->id]])
                                <span class="alert-msg"></span>
                            </td>
                            <td class="wd-15p text-center">
                                <button type="button" url="{{url('MasterAdmin/MarksManager/QuestionCategoryIndex/'.$onlineexam->id.'')}}" model-title="Add Question Category" model-class="" model-title-info="Manage Question Category" class="btn btn-primary custom-model-btn btn-xs rounded-5"><i class="fa fa-plus"></i> Add</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-10 pd-b-10">
                    <label class="text-left"><b class="text-l">Question <sup>*</sup> :</b></label>
                    <textarea class="form-control" name="question" placeholder="Enter Question"></textarea>
                    <div class="pd-l-10 pd-t-10 text-info tx-14"><b><i class="fa fa-file-image"></i> Add Image</b></div>
                </div>
                <div class="col-lg-2">
                    <label>Marks :</label>
                    <input type="text" placeholder="Enter Marks" value="0" name="marks" class="form-control wd-80">
                </div>
                <div class="col-lg-12 pd-b-10">
                    <label>Question Type<sup>*</sup> : </label>
                    <table class="mg-t-5">
                        <tr>
                            <td><input type="radio" name="question_type" class="question_type" value="objective" checked></td><td class="pd-l-5">Objective</td>
                            <td class="pd-l-20"><input type="radio" name="question_type" class="question_type" value="match_tree"></td><td class="pd-l-5">Match Tree</td>
                            <td class="pd-l-20"><input type="radio" name="question_type" class="question_type" value="text_answer"></td><td class="pd-l-5">Text Answer (Typing) </td>
                            <td class="pd-l-20"><input type="radio" name="question_type" class="question_type" value="text_answer_with_file"></td><td class="pd-l-5">Text Answer (Typing) With File/Image</td>
                        </tr>
                    </table>
                </div>

                <div id="objective" class="col-lg-12 mg-b-10 answer-input rounded-5 mg-t-5 bg-light" style="display: block;">
                    <label>Objective Answer :</label>
                    <table id="objective_answer" class="table bd mg-t-5 mg-b-5 p-1">
                        <thead>
                        <tr>
                            <th class="wd-50">Sl.No.</th>
                            <th class="wd-80">Sequence</th>
                            <th>Option</th>
                            <th class="text-center">Correct Answer</th>
                            <th class="wd-60"></th>
                        </tr>
                        </thead>
                        <tbody id="objective_ans_body"></tbody>
                    </table>
                    <span id="add_objective_ans" class="mg-t-10 mg-b-10 cursor-pointer"><b><u><i class="fa fa-plus-square"></i> Add Option</u></b></span>
                </div>

                <div id="match_tree" class="col-lg-12 mg-b-10 answer-input rounded-5 mg-t-5 bg-light" style="display: none;">
                    <label>Match Tree Answer :</label>
                    <table id="match_tree_answer" class="table bd mg-t-5 mg-b-5 p-1">
                        <thead>
                        <tr>
                            <th class="wd-50">S.No.</th>
                            <th>Tree 1</th>
                            <th>Tree 2</th>
                            <th class="wd-50">Action</th>
                        </tr>
                        </thead>
                    </table>
                    <span id="add_new_tree" class="cursor-pointer"><b><u><i class="fa fa-plus-square"></i> Add New Tree</u></b></span>
                </div>

                <div id="text_answer" class="col-lg-12 mg-b-10 answer-input rounded-5 mg-t-5 bg-light" style="display: none;">
                    <label>Text Answer :</label>
                     <div class="col-lg-4 pd-b-20 pd-l-0">
                        <label>Words Limit :</label>
                        <input type="text" autocomplete="off" name='ta_words[]' class="form-control wd-70" value="300">
                     </div>
                </div>

                <div id="text_answer_with_file" class="col-lg-12 mg-b-10 answer-input rounded-5 mg-t-5 bg-light" style="display: none;">
                    <label>Text Answer (Typing) With File/Image :</label>
                      <div class="col-lg-4 pd-b-0 pd-l-0">
                         <label>Words Limit :</label>
                         <input type="text" name='taf_words[]' autocomplete="off" class="form-control wd-70" value="300">
                      </div>
                     <div class="col-lg-4 pd-b-20 pd-l-0">
                        <label>Attachment Submitted Acceptance :</label><br/>
                        <span><input type="checkbox" name='taf_file[]' value="jpg,png"> Photo (jpeg,png)</span>
                        <span class="pd-l-10"><input type="checkbox" name='taf_file[]' value="pdf,xls"> File (pdf,xls)</span>
                     </div>
                </div>

                <div class="col-lg-12 pd-b-20 pd-t-20 bd-t b-1 text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</form>

    <script type="text/javascript">
        $(".question_type").on("change",function (){
            $(".answer-input").hide();
            $("#"+$(this).val()).show();
        });

        function objectivebody(i){
            return "<tr>" +
                "<td><input type='text' name='sl_no[]' class='form-control text-center' value='"+i+"'></td>"+
                "<td><input type='text' name='sequence[]' class='form-control' value='"+i+"'></td>"+
                "<td><input type='text' name='option[]' placeholder='Enter Answer Option' class='form-control'></td>"+
                "<td class='text-center'><input type='radio' name='correct_answer[]' value='"+i+"'></td>"+
                "<td><button type='button' class='btn btn-outline-danger remove-row btn-xs text-center rounded-5'><i class='fa fa-trash m-0 p-0'></i></button></td>" +
                "</tr>";
        }
        function matchtreebody(i){
            return "<tr>" +
                "<td><input type='text' name='mt_sl_no[]' class='form-control text-center' value='"+i+"'></td>" +
                "<td><input type='text' name='mt_tree_1[]' placeholder='Enter Tree 1 Input' class='form-control'></td>" +
                "<td><input type='text' name='mt_tree_2[]' placeholder='Enter Tree 2 Input' class='form-control'></td>" +
                "<td><button type='button' class='btn btn-danger remove-tree-row btn-xs rounded-5'><i class='fa fa-trash'></i></button></td></tr>";
        }
        for(var i=1;i<=4;i++)
        {
         $("#objective_ans_body").append(objectivebody(i));
        }
        for(var ii=1;ii<=4;ii++)
        {
         $("#match_tree_answer").append(matchtreebody(ii));
        }

        $("#add_objective_ans").click(function (){
            $("#objective_ans_body").append(objectivebody(i));
            i++;
        });

        $("#objective_answer").on("click", ".remove-row", function() {
            $(this).closest("tr").remove();
        });

        $("#match_tree_answer").on("click", ".remove-tree-row", function() {
            $(this).closest("tr").remove();
        });

        $("#add_new_tree").click(function (){
          $("#match_tree_answer").append(matchtreebody(ii));
            ii++;
        });
    </script>
    <script type="text/javascript">
        $(".question-category").on('change',function (){
            var exam_id="{{$onlineexam->id}}";
            if($(this).val()!=0 && (exam_id!=0)) {
                $(".alert-msg").html("<b class='text-danger'>Please wait few seconds....</b>");
                var result = formrequest('', '/MasterAdmin/MarksManager/SetQuestionCategory/'+exam_id+'/' + $(this).val() + '', 'GET');
                if(result['result']==1){
                  $(".alert-msg").html("<b class='text-success'><i class='fa fa-check'></i> "+result['message']+"</b>");
                }else{
                  $(".alert-msg").html("<b class='text-danger'><i class='fa fa-close'></i> "+result['message']+"</b>");
                }
            }
        });
    </script>


@endsection
