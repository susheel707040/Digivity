<form action="{{url('MasterAdmin/GlobalSetting/EditSubject/'.$subject->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-10 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label><b>Subject <sup>*</sup> : </b></label>
                <input type="text" id="subject_name" name="subject_name" autocomplete="off"
                     value="{{$subject->subject_name}}"  class="form-control input-sm" placeholder="Enter Subject Name (like : English,Hindi,Mathematics)" required>
            </div>
            <div class="col-lg-6">
                <label><b>Subject Code <span class="text-gray">(Optional)</span> : </b></label>
                <input type="text" id="subject_code" name="subject_code" autocomplete="off"
                      value="{{$subject->subject_code}}" class="form-control input-sm" placeholder="Enter Subject Code">
            </div>
            <div class="col-lg-6">
                <label><b>Priority :</b></label>
                <select name="priority" class="form-control input-sm" required>
                    @for($i=1;$i<=100;$i++)
                        <option value="{{$i}}" @if($subject->priority==$i) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-lg-6">
                <label><b>Status <span class="text-gray">(Optional)</span> :</b></label>
                <table>
                    <tr>
                        <td><input type="radio" value="active" name="status" id="status" @if($subject->status=="active") checked @endif></td>
                        <td class="pd-l-5">Active</td>
                        <td class="pd-l-10"><input type="radio" value="inactive" name="status" id="status" @if($subject->status=="inactive") checked @endif></td>
                        <td class="pd-l-5">In-Active</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

