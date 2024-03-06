<form action="{{url('MasterAdmin/Communication/EditPhoneBookGroup/'.$phonebookgroup->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Phonebook Group <sup>*</sup> : </label>
                <input type="text" id="phonebook_group" name="phonebook_group" autocomplete="off"
                       value="{{$phonebookgroup->phonebook_group}}" class="form-control input-sm" placeholder="Enter Phonebook Group" required>
            </div>

            <div class="col-lg-6">
                <label>Status <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" value="active" name="status" id="status" @if($phonebookgroup->status=="active") checked @endif></td>
                        <td class="pd-l-5">Active</td>
                        <td class="pd-l-10"><input type="radio" value="inactive" name="status" id="status" @if($phonebookgroup->status=="inactive") checked @endif></td>
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

