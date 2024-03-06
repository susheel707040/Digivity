<form action="{{url('MasterAdmin/Communication/EditUserSMSCopy/'.$usersmscopy->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Designation  <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="designation" name="designation" autocomplete="off"
                      value="{{$usersmscopy->designation}}" class="form-control input-sm" placeholder="Enter Designation like(Principal,Chairman,Account)">
            </div>

            <div class="col-lg-6">
                <label>Status <span class="text-gray">(Optional)</span> : </label>
                <select class="form-control input-sm" id="status" name="status" required="">
                    <option value="active" @if($usersmscopy->status=="active") selected @endif>Active</option>
                    <option value="inactive" @if($usersmscopy->status=="inactive") selected @endif>In-Active</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Name <sup>*</sup> : </label>
                <input type="text" id="name" name="name" autocomplete="off"
                       value="{{$usersmscopy->name}}" class="form-control input-sm" placeholder="Enter Full Name" required>
            </div>

            <div class="col-lg-6">
                <label>Gender <span class="text-gray">(Optional)</span> : </label>
                <select class="form-control input-sm" name="gender" id="gender">
                    <option value="male" @if($usersmscopy->gender=="male") selected @endif>Male</option>
                    <option value="female" @if($usersmscopy->gender=="female") selected @endif>Female</option>
                    <option value="transgender" @if($usersmscopy->gender=="transgender") selected @endif>Transgender</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label>Mobile Number <sup>*</sup> : </label>
                <input type="text" id="mobile_no" name="mobile_no" autocomplete="off"
                       value="{{$usersmscopy->mobile_no}}"  class="form-control input-sm" placeholder="Enter Mobile Number" required>
            </div>

            <div class="col-lg-6">
                <label>Email <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="email_id" name="email_id" autocomplete="off"
                       value="{{$usersmscopy->email_id}}"  class="form-control input-sm" placeholder="Enter Email Address" >
            </div>

            <div class="col-lg-12">
                <label>Note <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" placeholder="Enter Note" name="note" id="note">{{$usersmscopy->note}}</textarea>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-edit"></i> Update</button>
    </div>
</form>

