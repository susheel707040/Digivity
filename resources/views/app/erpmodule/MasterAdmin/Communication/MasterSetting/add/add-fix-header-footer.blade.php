<form action="{{url('MasterAdmin/Communication/CreateFixHeaderFooter')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-12">
                <label>Title <sup>*</sup> : </label>
                <input type="text" id="title" name="title" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Title like (English)" required>
            </div>

            <div class="col-lg-6">
                <label>Header Text <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" style=" height:150px;" id="header_text" placeholder="Enter Header Text like (Dear Parents,)" name="header_text"></textarea>
            </div>

            <div class="col-lg-6">
                <label>Footer Text <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control"  style=" height:150px; "  id="footer_text" placeholder="Enter Footer Text like (Regards, Principal)" name="footer_text"></textarea>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Unicode <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="unicode" id="unicode"></label>
            </div>
            <div class="col-lg-6">
                <label class="mg-t-10">Default Active <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="default_at" id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

