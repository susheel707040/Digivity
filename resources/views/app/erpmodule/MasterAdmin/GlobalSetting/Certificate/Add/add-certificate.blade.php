<form action="{{url('MasterAdmin/GlobalSetting/CreateCertificate')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{ csrf_field() }}
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        <div class="row p-0 m-0">

            <div class="col-lg-6">
                <label>Certificate Name <sup>*</sup> : </label>
                <input type="text" id="certificate_name" name="certificate_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Certificate Name" required>
                <span class="tx-10 tx-primary cursor-pointer"><u><i class="fa fa-certificate"></i>Certificate Example</u></span>
            </div>
            <div class="col-lg-6">
                <label>Certificate Integrate <span class="text-gray">(Optional)</span> : </label>
                @include('components.GlobalSetting.Certificate.integrate-import',['class'=>'form-control'])
             </div>
            <div class="col-lg-3">
                <label>Certificate For <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" name="for" value="student" checked></td><td class="pd-l-5">Student</td>
                        <td class="pd-l-15"><input type="radio" name="for" value="staff"></td><td class="pd-l-5">Staff</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-3">
                <label>Status  <sup>*</sup>:</label>
                <table>
                    <tr>
                        <td><input type="radio" name="status" value="active" checked></td><td class="pd-l-5">Active</td>
                        <td class="pd-l-15"><input type="radio" name="status" value="inactive"></td><td class="pd-l-5">Deactive</td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-2">
                <label>Sequence  <sup>*</sup> :</label>
                <select name="sequence" class="form-control">
                    @for($i=1;$i<=10;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-4">
                <label>Icon  <span class="text-gray">(Optional)</span> :</label>
                <input type="file" name="icon_file" class="form-control">
            </div>

            <div class="col-lg-12">
                <label>Description <span class="text-gray">(Optional)</span> :</label>
                <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

