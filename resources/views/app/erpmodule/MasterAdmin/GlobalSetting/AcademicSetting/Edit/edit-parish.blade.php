<form action="{{url('MasterAdmin/GlobalSetting/EditParish/'.$parish->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Religion <sup>*</sup> : </label>
                <select class="form-control input-sm" id="religion_id" name="religion_id">
                    <option value="0">---Select---</option>
                    @foreach($religion as $data)
                        <option value="{{$data->id}}" @if($data->id==$parish->religion_id) selected @endif>{{$data->religion}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6">
                <label>Parish <sup>*</sup> : </label>
                <input type="text" id="parish" name="parish" autocomplete="off"
                      value="{{$parish->parish}}" class="form-control input-sm" placeholder="Enter Parish">
            </div>

            <div class="col-lg-6">

                <label class="mg-t-10">Default Active <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes"
                                                                            name="default_at" @if($parish->default_at=="yes") checked @endif
                                                                            id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-pen"></i> Update</button>
    </div>
</form>

