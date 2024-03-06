<form action="{{url('MasterAdmin/MarksManager/StoreQuestionCategory')}}" method="POST">
{{csrf_field()}}
    <div class="row p-0 mg-l-0 mg-r-0 mg-b-20">
    <div class="col-lg-12">
        <label>Online Exam <sup>*</sup>:</label>
        @include('component.MarksManager.online-exam-import',['selectid'=>$examid])
    </div>
    <div class="col-lg-12">
        <label>Question Category <sup>*</sup> :</label>
        <input type="text" name="question_category" placeholder="Enter Question Category" class="form-control1">
    </div>
    <div class="col-lg-12">
        <label>Default Set <sup>*</sup> :</label>
        <table>
            <tr>
                <td><input type="radio" name="default" value="1" checked></td><td class="pd-l-5">Yes</td>
                <td class="pd-l-10"><input name="default" type="radio" value="0"></td><td class="pd-l-5">No</td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12">
        <button class="btn btn-primary float-right"><i class="fa fa-check"></i> Submit</button>
    </div>
</div>
</form>
