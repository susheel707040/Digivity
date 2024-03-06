<form action="{{url('MasterAdmin/GlobalSetting/CreateAdmissionIsNewStatus')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Priority <sup>*</sup> :</label>
                <select name="priority" id="priority" class="form-control input-sm" required>
                    @for($i=1;$i<=40;$i++)
                        <option>{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-lg-6">
                <label>Alias <sup>*</sup> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Alias" required="">
            </div>
            <div class="col-lg-6">
                <label>Admission Status <sup>*</sup> : </label>
                <input type="text" id="admission_status" name="admission_status" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Admission Status" required="">
            </div>
            <div class="col-lg-6">
                <label class="mg-t-35">Default Active <span class="text-gray">(Optional)</span> : <input type="checkbox" value="yes" name="default_at"
                                                                                                         id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

