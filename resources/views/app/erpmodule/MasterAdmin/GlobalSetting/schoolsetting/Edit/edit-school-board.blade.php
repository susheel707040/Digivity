<form action="{{url('MasterAdmin/GlobalSetting/EditSchoolBoard/'.$schlbrd->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>School Board <sup>*</sup> : </label>
                <input type="text" id="board_name" value="{{$schlbrd->board_name}}" name="board_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter School Board (like : CBSE,ICSE)" required="">
            </div>

            <div class="col-lg-6">

                <label class="mg-t-35">Default Active <sup>*</sup> :
                    <input type="checkbox" value="yes" name="default_at" @if($schlbrd->default_at=="yes") checked @endif id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-pen"></i> Update</button>
    </div>
</form>
