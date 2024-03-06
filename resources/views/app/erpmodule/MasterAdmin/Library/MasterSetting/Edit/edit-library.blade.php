<form action="{{url('MasterAdmin/Library/EditLibrary/'.$library->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Library <sup>*</sup> : </label>
                <input type="text" id="library_name" name="library_name" autocomplete="off"
                      value="{{$library->library_name}}" class="form-control input-sm" placeholder="Enter Library Name" required="">
            </div>

            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                      value="{{$library->alias}}" class="form-control input-sm" placeholder="Enter Alias">
            </div>

            <div class="col-lg-6">
                <label>In-Charge <span class="text-gray">(Optional)</span> : </label>
                <select name="incharge" class="form-control">
                    <option value="">---Select---</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label>School Sub Branch <sup>*</sup> : </label>
                <select name="branches_id" class="form-control" required>
                    <option value="1">---Select---</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label>Address <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter Library Address">{{$library->address}}</textarea>
            </div>

            <div class="col-lg-6">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{$library->description}}</textarea>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Default Active <span class="text-gray">(Optional)</span> :</label>
                <table>
                    <tr>
                        <td><input type="radio" name="default_at" value="yes" @if($library->default_at=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                        <td class="pd-l-10"><input type="radio" name="default_at" value="no" @if($library->default_at=="no") checked @endif></td><td class="pd-l-5">No</td>
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

