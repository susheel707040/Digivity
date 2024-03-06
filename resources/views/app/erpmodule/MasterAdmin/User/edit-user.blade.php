
                <div class="col-lg-12 row p-0 m-0">

                    <form action="{{url('MasterAdmin/User/StoreUser')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                        <div class="col-lg-12 mx-auto row pd-t-10 pd-b-10">
                            <div class="col-lg-4">
                                <label><b>Academic Year <sup>*</sup> :</b></label>
                                <select name="academic_id" class="form-control input-sm" required>
                                    <option value="">---Select---</option>
                                    @foreach(academicyearlist([]) as $data)
                                        <option value="{{$data->id}}" @if($data->id==$user->academic_id) selected @endif>{{$data->academic_session}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Finance Year <sup>*</sup> :</b></label>
                                <select name="financial_id" class="form-control input-sm" required>
                                    <option value="">---Select---</option>
                                    @foreach(financialyearlist([]) as $data)
                                        <option value="{{$data->id}}" @if($data->id==$user->financial_id) selected @endif>{{$data->financial_session}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Role <sup>*</sup> :</b></label>
                                @include('component.role-import',['class'=>'form-control','required'=>'required','selectid'=>$user->role_id])
                            </div>
                            <div class="col-lg-4">
                                <label><b>First Name <sup>*</sup> :</b></label>
                                <input type="text" value="{{$user->first_name}}"  name="first_name" placeholder="Enter First Name" autocomplete="off" class="form-control input-sm" required>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Last Name :</b></label>
                                <input type="text" name="last_name" value="{{$user->last_name}}" placeholder="Enter Last Name" autocomplete="off" class="form-control input-sm">
                            </div>
                            <div class="col-lg-4">
                                <label><b>Gender :</b></label>
                                <select name="gender" class="form-control input-sm">
                                    <option value="">---Select---</option>
                                    @foreach($genderlist as $data)
                                        <option value="{{$data}}" @if($data==$user->gender) selected @endif>{{ucfirst($data)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Date of Birth :</b></label>
                                <input type="text" name="dob" value="{{$user->dob}}" placeholder="Enter Date of Birth (dd-mm-yyyy) " autocomplete="off" class="form-control date input-sm" ref="">
                            </div>
                            <div class="col-lg-4">
                                <label><b>Contact No. <sup>*</sup> :</b></label>
                                <input type="text" name="contact_no" value="{{$user->contact_no}}" placeholder="Enter Contact Number" autocomplete="off" class="form-control input-sm"  required>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Email <sup>*</sup> :</b></label>
                                <input type="text" name="email" value="{{$user->email}}" placeholder="Enter Email" autocomplete="off" class="form-control input-sm" required>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Profile :</b></label>
                                <input type="file" placeholder="Enter First Name" autocomplete="off" class="form-control input-sm" ref="">
                            </div>
                            <div class="col-lg-4">
                                <label><b>School Branch <sup>*</sup> :</b></label>
                                <select name="branches_id" class="form-control input-sm">
                                    <option value="">---Select---</option>
                                    @foreach(schoolbranchlist([]) as $data)
                                        <option value="{{$data->id}}" @if($data->id==$user->branches_id) selected @endif>{{$data->school_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label><b>2FA Status <sup>*</sup> :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="two_fa_at" value="yes" @if($user->two_fa_at=="yes") checked @endif></td><td class="pd-l-5">Enable</td>
                                        <td class="pd-l-15"><input type="radio" value="no" name="two_fa_at" @if($user->two_fa_at=="no") checked @endif></td><td class="pd-l-5">Disable</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-3">
                                <label><b>Is Active <sup>*</sup> :</b></label>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="active_at" value="yes" @if($user->active_at=="yes") checked @endif></td><td class="pd-l-5">Active</td>
                                        <td class="pd-l-15"><input type="radio" name="active_at" value="no" @if($user->active_at=="no") checked @endif></td><td class="pd-l-5">In-Active</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-12 pd-b-10">
                                <button type="submit" class="btn btn-primary mg-t-15 btn-lg wd-150 float-right"><i class="fa fa-edit"></i> Update</button>
                            </div>
                        </div>
                    </form>

                </div>
