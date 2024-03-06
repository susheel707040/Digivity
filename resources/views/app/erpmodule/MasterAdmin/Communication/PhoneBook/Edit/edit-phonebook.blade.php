<form action="{{url('MasterAdmin/Communication/EditPhoneBookContact/'.$phonebookcontact->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-4">
                <label>Group <sup>*</sup> : </label>
                <select name="group_id" id="group_id" class="form-control1 input-sm" required>
                    <option value="">---Select---</option>
                    @foreach(phonebookgrouplist() as $data)
                        <option value="{{$data->id}}" @if($phonebookcontact->group_id==$data->id) selected @endif>{{$data->phonebook_group}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label>Name <sup>*</sup> :</label>
                <table class="container-fluid">
                    <tr>
                        <td class="wd-20p">
                            <select name="title" id="title" class="form-control1 input-sm">
                                @foreach($title_name as $data)
                                    <option value="{{$data}}" @if($phonebookcontact->title==$data) selected @endif>{{\Illuminate\Support\Str::ucfirst($data)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="name" id="name" autocomplete="off" class="form-control1 input-sm"
                                value="{{$phonebookcontact->name}}"   placeholder="Enter Name" required></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-4">
                <label>Gender :</label>
                <select name="gender" id="gender" class="form-control1 input-sm">
                    @foreach($genderlist as $data)
                        <option value="{{$data}}" @if($phonebookcontact->gender==$data) selected @endif>{{\Illuminate\Support\Str::ucfirst($data)}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-4">
                <label>Contact Number <sup>*</sup> :</label>
                <input type="text" id="contact_no" name="contact_no" autocomplete="off" class="form-control1 input-sm"
                     value="{{$phonebookcontact->contact_no}}"  placeholder="Enter Contact Number" required>
            </div>

            <div class="col-lg-4">
                <label>Email <span class="text-gray">(Optional)</span> :</label>
                <input type="text" name="email" id="email" autocomplete="off" class="form-control1 input-sm"
                      value="{{$phonebookcontact->email}}" placeholder="Enter Email">
            </div>

            <div class="col-lg-4">
                <label>Company <span class="text-gray">(Optional)</span> :</label>
                <input type="text" id="company" name="company" autocomplete="off" class="form-control1 input-sm"
                       value="{{$phonebookcontact->company}}"    placeholder="Enter Company Name">
            </div>

            <div class="col-lg-4">
                <label>Designation <span class="text-gray">(Optional)</span> :</label>
                <input type="text" name="designation" id="designation" autocomplete="off" class="form-control1 input-sm"
                     value="{{$phonebookcontact->designation}}"  placeholder="Enter Designation">
            </div>

            <div class="col-lg-6">
                <label>Communication Status <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" value="active" name="status" id="status" @if($phonebookcontact->status=="active") checked @endif></td>
                        <td class="pd-l-5">Active</td>
                        <td class="pd-l-10"><input type="radio" value="inactive" name="status" id="status" @if($phonebookcontact->status=="inactive") checked @endif></td>
                        <td class="pd-l-5">In-Active</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-edit"></i> Update</button>
    </div>
</form>

