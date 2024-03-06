<form action="{{url('MasterAdmin/Finance/CreateFeeGroup')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Fee Account <sup>*</sup> : </label>
                <select name="fee_account_id" id="fee_account_id" class="form-control" required>
                    <option value="">---Select---</option>
                    @foreach(feeaccountlist([]) as $data)
                        <option value="{{$data->id}}">{{$data->fee_account}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <label>Fee Group <sup>*</sup> : </label>
                <input type="text" id="fee_group" name="fee_group" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Fee Group" required="">
            </div>

            <div class="col-lg-6">
                <label>Sequence <sup>*</sup> :</label>
                <select class="form-control" name="sequence" id="sequence">
                    @for($i=1;$i<=50;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Save</button>
    </div>
</form>

