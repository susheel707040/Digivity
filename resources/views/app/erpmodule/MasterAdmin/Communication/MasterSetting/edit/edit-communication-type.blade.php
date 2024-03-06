<form action="{{url('MasterAdmin/Communication/EditCommunicationType/'.$communicationtype->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Communication Type <sup>*</sup> : </label>
                <input type="text" id="communication_type" name="communication_type" autocomplete="off"
                     value="{{$communicationtype->communication_type}}"  class="form-control input-sm" placeholder="Enter Communication Type" required>
            </div>

            <div class="col-lg-6">

                <label class="mg-t-35">Default Active <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="default_at" id="default_at" @if($communicationtype->default_at=="yes") checked @endif></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

