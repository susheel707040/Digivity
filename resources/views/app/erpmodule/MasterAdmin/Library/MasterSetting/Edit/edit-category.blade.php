<form action="{{url('MasterAdmin/Library/EditItemCategory/'.$libraryCategory->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Item Category <sup>*</sup> : </label>
                <input type="text" id="item_category" name="item_category" autocomplete="off"
                      value="{{$libraryCategory->item_category}}" class="form-control input-sm" placeholder="Enter Item Category" required="">
            </div>

            <div class="col-lg-6">
                <label>Return Days <sup>*</sup> : </label>
                <select name="return_day" class="form-control" required>
                    @for($i=1;$i<=120;$i++)
                        <option value="{{$i}}" @if($libraryCategory->return_day==$i) selected @endif>{{$i}} Days</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Default Active <span class="text-gray">(Optional)</span> :</label>
                <table>
                    <tr>
                        <td><input type="radio" name="default_at" value="yes" @if($libraryCategory->default_at=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                        <td class="pd-l-10"><input type="radio" name="default_at" value="no" @if($libraryCategory->default_at=="no") checked @endif></td><td class="pd-l-5">No</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-6">
                <label class="mg-t-10">Sequence <sup>*</sup> : </label>
                <select name="sequence" class="form-control" required>
                    @for($i=1;$i<=50;$i++)
                        <option value="{{$i}}" @if($libraryCategory->sequence==$i) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

