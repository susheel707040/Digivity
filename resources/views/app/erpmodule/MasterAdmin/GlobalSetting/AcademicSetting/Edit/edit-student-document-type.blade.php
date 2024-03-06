<form action="{{url('MasterAdmin/StudentInformation/EditStudentDocumentType/'.$documenttype->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Document Type <sup>*</sup> : </label>
                <input type="text" value="{{$documenttype->document_type}}" id="document_type" name="document_type" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Document Type" required>
            </div>

            <div class="col-lg-6">
                <table class="mg-t-35">
                    <tr>
                        <td><label class="p-0 m-0">Mandatory <span class="text-gray">(Optional)</span> :</label></td>
                        <td class="pd-l-10"><input type="radio" value="yes" name="mandatory"
                                                   id="default_at" @if($documenttype->mandatory=="yes") checked @endif></td><td class="pd-l-3">Yes</td>
                        <td class="pd-l-10"><input type="radio" value="no" name="mandatory"
                                                   id="default_at" @if($documenttype->mandatory=="no") checked @endif></td><td class="pd-l-3">No</td>
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

