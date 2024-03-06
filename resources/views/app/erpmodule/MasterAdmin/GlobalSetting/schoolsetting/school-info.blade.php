@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">School Information</li>
        </ol>
    </nav>

    <div class="col-lg-8 mx-auto">
        <form action="{{url('MasterAdmin/GlobalSetting/SchoolInfo/'.$school->id.'/update')}}" method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>
        {{csrf_field()}}
            <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> School Information</b></div>
            <div class="panel-body m-0 pd-b-0 row">
                <div class="col-lg-9 pd-b-30 pd-l-0 row m-0">
                <div class="col-lg-9">
                 <label>School Name <sup>*</sup> :</label>
                 <input type="text" value="{{$school->school_name}}" autocomplete="off" name="school_name" class="form-control input-sm" placeholder="Enter School Name" required>
                </div>
                 <div class="col-lg-3">
                     <label>Color :</label>
                     <input type="text" class="form-control" placeholder="Color Code" value="{{$school->color}}" name="color">
                 </div>
                <div class="col-lg-9">
                  <label>School Address <span class="text-gray">(Optional)</span> :</label>
                <textarea class="form-control" name="address" placeholder="Enter School Address">{{$school->address}}</textarea>
                </div>
                    <div class="col-lg-3">
                        <label>Ads Color :</label>
                        <input type="text" class="form-control" placeholder="Color Code" value="{{$school->ads_color}}" name="ads_color">
                    </div>
                    <div class="col-lg-12">
                        <label>About <span class="text-gray">(Optional)</span> :</label>
                        <textarea class="form-control" name="about" placeholder="Enter School About">{{$school->about}}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Phone No. <sup>*</sup> :</label>
                        <input type="text" name="contact_no" value="{{$school->contact_no}}" autocomplete="off" class="form-control input-sm" placeholder="Enter Contact No." required>
                    </div>
                    <div class="col-lg-6">
                        <label>Contact Us Email <sup>*</sup> :</label>
                        <input type="text" name="email" value="{{$school->email}}" autocomplete="off" class="form-control input-sm" placeholder="Enter Email" required>
                    </div>
                    <div class="col-lg-6">
                        <label>Square Logo <span class="text-gray">(Optional)</span> :</label>
                        <input type="file" id="studentlogouploadImage" accept="image/*" data-parsley-fileextension='jpg,png,JPG,jpeg,gif,svg' data-parsley-max-file-size="200"  name="logo" class="form-control" onchange="studentlogopreview()">
                        <span class="tx-danger tx-10">Image Dimension 200px * 200px Is Preferable</span>
                        <span>
                            <div class="avatar avatar-xl">
                                @if(isset($school) && !empty($school->logo))
                                <img id="student_logo_previewImage" name="logo" src="{{ url('uploads/School_square_logo/' . $school->logo) }}" class="rounded" alt=""></div>
                                @else
                                <img id="student_logo_previewImage" name="logo" src="{{ url('assets/images/no-image-available.png') }}" class="rounded" alt=""></div>
                                @endif
                        </span>
                    </div>

                    <script>
                        function studentlogopreview() {
                            var studentlogopreview = document.getElementById('student_logo_previewImage');
                            var file    = document.getElementById('studentlogouploadImage').files[0];
                            var reader  = new FileReader();

                            reader.onloadend = function () {
                                studentlogopreview.src = reader.result;
                            }

                            if (file) {
                                reader.readAsDataURL(file);
                            } else {
                                studentlogopreview.src = "{{ url('assets/images/no-image-available.png') }}";
                            }
                        }
                    </script>

                    <div class="col-lg-6">
                        <label>Banner Logo <span class="text-gray">(Optional)</span> :</label>
                        <input type="file" id="studentBannerlogouploadImage" accept="image/*" data-parsley-fileextension='jpg,png,JPG,jpeg,gif,svg' name="banner_logo" class="form-control" onchange="studentbannerlogopreview()">
                        <span class="tx-danger tx-10">Image Dimension 300px * 70px Is Preferable</span>
                        <span>
                            <div class="avatar avatar-xl">
                                @if(isset($school) && !empty($school->banner_logo))
                                <img id="student_banner_logo_previewImage" name="logo" src="{{ url('uploads/School_banner_logo/' . $school->banner_logo) }}" class="rounded" alt=""></div>
                                @else
                                <img id="student_banner_logo_previewImage" name="banner_logo" src="{{ url('assets/images/no-image-available.png') }}" class="rounded" alt=""></div>
                                @endif
                        </span>
                    </div>

                    <script>
                        function studentbannerlogopreview() {
                            var studentbannerlogopreview = document.getElementById('student_banner_logo_previewImage');
                            var file    = document.getElementById('studentBannerlogouploadImage').files[0];
                            var reader  = new FileReader();

                            reader.onloadend = function () {
                                studentbannerlogopreview.src = reader.result;
                            }

                            if (file) {
                                reader.readAsDataURL(file);
                            } else {
                                studentbannerlogopreview.src = "{{ url('assets/images/no-image-available.png') }}";
                            }
                        }
                    </script>

                    <div class="col-lg-6">
                        <label>School City <sup class="text-gray">(Optional)</sup> :</label>
                        <input type="text" placeholder="Enter City Name" value="{{$school->city}}" class="form-control" name="city">
                    </div>

                    <div class="col-lg-6">
                        <label>Currency <sup class="text-gray">(Optional)</sup> :</label>
                        @include('components.GlobalSetting.currency-import',['class'=>'form-control','selectid'=>$school->currency])
                    </div>

                    <div class="col-lg-6">
                        <label>Language <sup>*</sup> :</label>
                        @include('components.GlobalSetting.language-import',['class'=>'form-control','required'=>'required','selectid'=>$school->language])
                    </div>

                    <div class="col-lg-6">
                        <label>Timezone <sup>*</sup> :</label>
                        @include('components.GlobalSetting.timezone-import',['class'=>'form-control','required'=>'required','selectid'=>$school->timezone])
                    </div>

                    <div class="col-lg-12">
                        <label>Location <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" name="location" value="{{$school->location}}" autocomplete="off" class="form-control input-sm" placeholder="Enter Location">
                    </div>
                    <div class="col-lg-6">
                        <label>Latitude <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" name="latitude" value="{{$school->latitude}}" autocomplete="off" class="form-control input-sm" placeholder="Enter Location">
                    </div>
                    <div class="col-lg-6">
                        <label>longitude <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" name="longitude" value="{{$school->longitude}}" autocomplete="off" class="form-control input-sm" placeholder="Enter Location">
                    </div>

                </div>

                <div class="col-lg-3 vhr text-center">
                    <button type="submit" class="btn btn-outline-primary mg-t-20 btn-block rounded-50 btn-lg">Update <i class="fa fa-check"></i></button>
                </div>
            </div>
        </div>
        </form>
    </div>

@endsection
