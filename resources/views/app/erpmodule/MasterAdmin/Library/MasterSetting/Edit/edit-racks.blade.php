<form action="{{url('MasterAdmin/Library/EditRacks/'.$racks->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Racks <sup>*</sup> : </label>
                <input type="text" id="racks" name="racks" autocomplete="off"
                      value="{{$racks->racks}}" class="form-control input-sm" placeholder="Enter Racks" required="">
            </div>

            <div class="col-lg-6">
                <label>Capacity <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="capacity" name="capacity" autocomplete="off"
                      value="{{$racks->capacity}}" class="form-control input-sm" placeholder="Enter Capacity">
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Sequence <sup>*</sup> : </label>
                <select name="sequence" class="form-control" required>
                    @for($i=1;$i<=50;$i++)
                        <option value="{{$i}}" @if($racks->sequence==$i) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{$racks->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

