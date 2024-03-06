<form action="{{url('MasterAdmin/Staff/CreateDocument')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-5">
                <label>Document <sup>*</sup> : </label>
                <input type="text" id="document_name" name="document_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Document Name" required="">
            </div>
            <div class="col-lg-4">
                <label class="mg-t-35">Fill Mandatory <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="fill_mandatory" id="fill_mandatory"></label>
            </div>
            <div class="col-lg-3">
                <label class="mg-t-15">Status <span class="text-gray">(Optional)</span> :</label>
                <table>
                    <tr>
                        <td><input type="radio" value="active" name="status" id="status" checked></td><td>Active</td>
                        <td class="pd-l-10"><input type="radio" value="inactive" name="status" id="status"></td><td>In-Active</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <label class="mg-t-20">Default Active <span class="text-gray">(Optional)</span> :
                    <input type="checkbox" value="yes" name="default_at" id="default_at"></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

