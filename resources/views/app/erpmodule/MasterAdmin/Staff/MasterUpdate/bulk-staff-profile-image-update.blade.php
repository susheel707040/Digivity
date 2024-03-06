@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Staff/Employee Profile Image Update</li>
        </ol>
    </nav>


    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Staff/Employee Profile Image Update</b></div>
            <div class="panel-body pd-b-0 row">

                <form action="{{url('MasterAdmin/Staff/StaffProfileImageUpdate')}}" class="container-fluid" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 p-0 nav-line">
                        <div class="row tx-12 pd-l-0 pd-r-0 pd-b-10 m-0">

                            <div class="col-lg-2 pd-l-5 pd-r-5">
                                <label><b>Staff/Emp. No. :</b></label>
                                <input type="text" autocomplete="off" placeholder="Staff/Emp. No." value="{{request()->get('staff_no')}}" name="staff_no" class="form-control">
                            </div>

                            <div class="col-lg-2 pd-r-5">
                                <label><b>Profession Type :</b></label>
                                @include('components.Staff.profession-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2 pd-r-5">
                                <label><b>Staff Type :</b></label>
                                @include('components.Staff.staff-type-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2 pd-r-5">
                                <label><b>Department :</b></label>
                                @include('components.Staff.department-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2">
                                <label><b>Designation :</b></label>
                                @include('components.Staff.designation-import',['selectid'=>0])
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn mg-t-20 btn-primary btn-sm"><i class="fa fa-search"></i> Get Result</button>
                            </div>
                            <div class="col-lg-12 pd-t-3 pd-l-0">
                                <span class="tx-primary"><b><i class="fa fa-search"></i> Advance Search</b></span>
                            </div>
                        </div>
                    </div>
                </form>


                <div class="col-lg-12 p-0">
                    <table class="table mg-t-10 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th class="text-center">Staff ID/No.</th>
                            <th>Staff Type</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Staff Name</th>
                            <th>Father</th>
                            <th class="text-center">Staff Profile</th>
                            <th>Staff Profile Update</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($staff as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$data->staff_no}}</td>
                                <td>{{$data->StaffTypeName()}}</td>
                                <td>{{$data->DepartmentName()}}</td>
                                <td>{{$data->DesignationName()}}</td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td class="text-center">
                                    <div class="avatar avatar-lg mx-auto">
                                        <img id="Staff_image" name="profile_img" src="{{url('uploads/staff_image/' .$data->profile_img)}}" class="rounded-circle bd-2 bd file-{{$data->id}}" alt="">
                                    </div>
                                </td>
                                <td class="wd-20p">
                                    <form class="form_{{$data->id}}" action="{{'/FileUpdateModel'}}" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="model_id" value="{{$data->id}}">
                                        <input type="hidden" name="model" value="{{\App\Models\MasterAdmin\Staff\StaffRecord::class}}">
                                        <input type="hidden" name="model_column" value="profile_img">
                                        <input type="hidden" name="integrate" value="file">
                                        <input type="file" modelid="{{$data->id}}" filename="file-{{$data->id}}" formid="form_{{$data->id}}" alertmsg="alert-msg-{{$data->id}}" name="file" class="form-control file-choose" id="staffuploadImage" onchange="staffpreview()">
                                        <span class="alert-msg-{{$data->id}} alert-msg-ajax"></span>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function staffpreview() {
            var staffpreview = document.getElementById('Staff_image');
            var file    = document.getElementById('staffuploadImage').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                staffpreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                staffpreview.src = "{{ url('assets/images/no-image-available.png') }}";
            }
        }
    </script>


@endsection
