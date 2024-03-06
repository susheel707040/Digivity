<form action="{{url('MasterAdmin/Finance/CreateConcessionType')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Concession Type <sup>*</sup> : </label>
                <input type="text" id="concession_type" name="concession_type" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Concession Type" required="">
            </div>

            <div class="col-lg-3">
              <label>Sequence</label>
                <select class="form-control" name="sequence" id="sequence" required>
                    @for($i=1;$i<=50;$i++)
                    <option>{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

