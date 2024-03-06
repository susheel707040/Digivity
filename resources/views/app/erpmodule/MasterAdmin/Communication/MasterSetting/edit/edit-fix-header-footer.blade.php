<form action="{{url('MasterAdmin/Communication/EditFixHeaderFooter/'.$fixheaderfooter->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-12">
                <label>Title <sup>*</sup> : </label>
                <input type="text" id="title" name="title" autocomplete="off"
                     value="{{$fixheaderfooter->title}}"  class="form-control input-sm" placeholder="Enter Title like (English)" required>
            </div>

            <div class="col-lg-6">
                <label>Header Text <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" style=" height:150px;" id="header_text" placeholder="Enter Header Text like (Dear Parents,)" name="header_text">{{$fixheaderfooter->header_text}}</textarea>
            </div>

            <div class="col-lg-6">
                <label>Footer Text <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control"  style=" height:150px; "  id="footer_text" placeholder="Enter Footer Text like (Regards, Principal)" name="footer_text">{{$fixheaderfooter->footer_text}}</textarea>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Unicode <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="unicode" id="unicode" @if($fixheaderfooter->unicode=="yes") checked @endif></label>
            </div>
            <div class="col-lg-6">
                <label class="mg-t-10">Default Active <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="default_at" id="default_at"  @if($fixheaderfooter->default_at=="yes") checked @endif></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

