<form action="{{url('MasterAdmin/Staff/EditStaffType/'.$stafftype->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-5">
                <label>Staff Type <sup>*</sup> : </label>
                <input type="text" id="staff_type" name="staff_type" autocomplete="off"
                     value="{{$stafftype->staff_type}}"  class="form-control input-sm" placeholder="Enter Staff Type like(Teacher,Principal)" required="">
            </div>
            <div class="col-lg-4">
                <label class="mg-t-35">In Hourly Paid <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="is_hourly_paid" id="is_hourly_paid" @if($stafftype->is_hourly_paid=="yes") checked @endif></label>
            </div>
            <div class="col-lg-3 p-0 m-0">
                <label class="mg-t-35">Show on ERP <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="show_on_erp" id="show_on_erp" @if($stafftype->show_on_erp=="yes") checked @endif></label>
            </div>
            <div class="col-lg-6">
                <label class="mg-t-25">Default Active <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="default_at" id="default_at" @if($stafftype->default_at=="yes") checked @endif></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

