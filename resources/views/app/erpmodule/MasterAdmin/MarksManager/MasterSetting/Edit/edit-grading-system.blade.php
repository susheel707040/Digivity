<form action="{{url('MasterAdmin/MarksManager/EditExamGradeSystem/'.$examgradesystem->id.'/edit')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Position <sup>*</sup> : </label>
                <input type="text" id="position" value="{{$examgradesystem->position}}" name="position" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Position" required="">
            </div>
            <div class="col-lg-6">
                <label>Grade Title <sup>*</sup> : </label>
                <input type="text" id="grade_title" value="{{$examgradesystem->grade_title}}" name="grade_title" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Grade Title" required="">
            </div>
            <div class="col-lg-12 tx-11 text-danger text-left pd-t-5"><b>Exam Grade Example :</b> (1). 9 Point Scale | (2). 8 Point Scale </div>
            <div class="col-lg-12">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description">{{$examgradesystem->description}}</textarea>
            </div>
            <div class="col-lg-12">
                <table id="exam-grade-system" class="table table-bordered mg-t-10">
                    <thead class="bg-light">
                    <th class="text-center">Grade Name</th>
                    <th class="text-center">Grade Point</th>
                    <th class="text-center">Grade Range From (Min)</th>
                    <th class="text-center ">Grade Range To (Max)</th>
                    <th class="text-center">Action</th>
                    </thead>
                    <tbody class="grade-table-boty">
                    @php
                        $gradeinput=[];
                        try {
                        $gradeinput=unserialize($examgradesystem->grade_input);
                        }catch (\Exception $e){}
                    @endphp
                    @foreach($gradeinput['grade_name'] as $key=>$value)
                        <tr>
                            <td class='text-center'><input type='text' name='grade_name[]' value="{{$value}}" placeholder='Grade Name' autocomplete='off' class='form-control1 wd-150'></td>
                            <td class='text-center'><input type='text' name='grade_point[]' @if(isset($gradeinput['grade_point'][$key])) value="{{$gradeinput['grade_point'][$key]}}" @endif placeholder='Grade Point' autocomplete='off' class='form-control1 wd-100'></td>
                            <td class='text-center'><input type='text' name='grade_from[]' @if(isset($gradeinput['grade_from'][$key])) value="{{$gradeinput['grade_from'][$key]}}" @endif placeholder='Range From' autocomplete='off' class='form-control1 wd-100'></td>
                            <td class='text-center'><input type='text' name='grade_to[]' @if(isset($gradeinput['grade_to'][$key])) value="{{$gradeinput['grade_to'][$key]}}" @endif placeholder='Range To' autocomplete='off' class='form-control1 wd-100'></td>
                            <td class='text-center'><button type='button' class='btn btn-danger btn-xs rounded-5 remove-tree-row'><i class='fa fa-trash'></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" class="add-grade-input-btn btn btn-info btn-xs rounded-5"><i class="fa fa-plus"></i> Add</button><br/><br/>
                <span class="tx-10">
                    <b>Grade System Example :</b><br/>
                    <b>Grade Name :</b> A+ | <b>Grade Point :</b> 100 | <b>Grade Range From (Min) :</b> 80 | <b>Grade Range To (Max) :</b> 100
                </span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>
<script type="text/javascript">
    function GradeInput(){
        return "<tr>" +
            "<td class='text-center'><input type='text' name='grade_name[]' placeholder='Grade Name' autocomplete='off' class='form-control1 wd-150'></td>" +
            "<td class='text-center'><input type='text' name='grade_point[]' placeholder='Grade Point' autocomplete='off' class='form-control1 wd-100'></td>" +
            "<td class='text-center'><input type='text' name='grade_from[]' placeholder='Range From' autocomplete='off' class='form-control1 wd-100'></td>" +
            "<td class='text-center'><input type='text' name='grade_to[]' placeholder='Range To' autocomplete='off' class='form-control1 wd-100'></td>" +
            "<td class='text-center'><button type='button' class='btn btn-danger btn-xs rounded-5 remove-tree-row'><i class='fa fa-trash'></i></button></td>" +
            "</tr>"
    }
    @if(count($gradeinput)<=0)
    $(".grade-table-boty").append(GradeInput());
    @endif
    $(".add-grade-input-btn").click(function (){
        $(".grade-table-boty").append(GradeInput());
    });
    $("#exam-grade-system").on("click", ".remove-tree-row", function() {
        $(this).closest("tr").remove();
    });
</script>

