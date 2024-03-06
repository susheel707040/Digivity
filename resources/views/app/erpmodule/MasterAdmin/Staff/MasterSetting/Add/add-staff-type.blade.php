<form action="{{url('MasterAdmin/Staff/CreateStaffType')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-5">
                <label>Staff Type <sup>*</sup> : </label>
                <input type="text" id="staff_type" name="staff_type" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Staff Type like(Teacher,Principal)" required="">
            </div>
            <div class="col-lg-4">
                <label class="mg-t-35">In Hourly Paid <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="is_hourly_paid" id="default_at"></label>
            </div>
            <div class="col-lg-3 p-0 m-0">
                <label class="mg-t-35">Show on ERP <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="show_on_erp" id="default_at" checked></label>
            </div>
            <div class="col-lg-6">
                <label class="mg-t-25">Default Active <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="default_at" id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

