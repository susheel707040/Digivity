@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Student ID Card</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student List for ID Card</b></div>
            <div class="panel-body pd-b-0 row">

                <div class="col-lg-12 mg-b-15">
                    <form action="{{url('MasterAdmin/StudentInformation/StudentIDCard')}}" method="POST" data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                    <div class="row tx-12">
                    <div class="col-lg-2">
                        <label><b>Course :</b></label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                        <div class="col-lg-1 p-0 m-0">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-1 pd-l-10 pd-r-0 m-0">
                            <label><b>Is New :</b></label>
                            @include('components.GlobalSetting.is-new-status',['selectid'=>request()->get('is_new'),'selectnull'=>1])
                        </div>
                        <div class="col-lg-2 pd-l-10 pd-r-0 m-0">
                            <label>Admission Date Range :</label>
                            <table cellpadding="0" cellspacing="0" class="p-0 m-0">
                                <tr>
                                    <td><input type="text" class="form-control date" name="adm_from_date" value="{{request()->get('adm_from_date')}}" placeholder="dd-mm-yyyy"></td>
                                    <td class="pd-l-5 pd-r-5">-</td>
                                    <td><input type="text" class="form-control date" name="adm_to_date" value="{{request()->get('adm_to_date')}}" placeholder="dd-mm-yyyy"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-0 pd-r-0 m-0">
                            <table cellpadding="0" cellspacing="0" class="mx-auto">
                                <tr>
                                    <td><label><b>Student Photo Show List :</b></label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="">
                                            <tr>
                                                <td><input name="photo_show" value="yes" type="radio" @if(request()->get('photo_show')=="yes") checked @endif @if(!request()->get('photo_show')) checked @endif></td><td class="pd-l-5">Yes</td>
                                                <td class="pd-l-10"><input type="radio" value="no" name="photo_show" @if(request()->get('photo_show')=="no") checked @endif></td><td class="pd-l-5">No</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 m-0">
                            <label>ID Card Template</label>
                            <select id="template_id" name="template_id" class="form-control input-sm">
                                <option value="">---Select---</option>
                                <option value="id-card-template-1">ID Card Template 1</option>
                            </select>
                        </div>
                        <div class="col-lg-2 p-0 m-0">
                            <button type="submit" class="btn btn-primary rounded-50 mg-t-20 mg-l-10 btn-sm">Continue <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                    </form>
                </div>

                @if(request()->get('_token'))
                <div class="row col-lg-12 m-0 pd-l-10 pd-r-10 bd-t bd-1">
                    <div class="col-lg-10 pd-r-15 pd-l-5">
                    <table class="table table-bordered tx-12 mg-t-15">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input class="CheckAll" value="checkbox1" type="checkbox"></th>
                            <th class="text-center">Admission No.</th>
                            <th class="text-center">Admission Date</th>
                            <th>Student Name</th>
                            <th class="text-center">Course - Section</th>
                            <th>Father Name</th>
                            @if(request()->get('photo_show')=="yes")<th class="text-center">Profile Photo</th>@endif
                            <th class="text-center">ID Card Status</th>
                        </tr>
                        </thead>
                        @if(isset($student))
                        <tbody>
                        @foreach($student as $data)
                        <tr>
                            <td class="text-center"><input type="checkbox" name="studentid[]" value="{{$data->student_id}}" class="checkbox1"></td>
                            <td class="text-center">{{$data->admission_no}}</td>
                            <td class="text-center">{{nowdate($data->student->admission_date,'d-M-Y')}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td class="text-center">{{$data->CourseSection()}}</td>
                            <td>{{$data->student->father_name}}</td>
                            @if(request()->get('photo_show')=="yes")<td class="text-center"><div class="avatar  mx-auto"><img class="rounded-circle bd-2 bd" src="{{FileUrl($data->profile_img)}}" alt=""></div></td>@endif
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                         @else
                            {{recordnofound(7)}}
                         @endif
                    </table>
                    </div>
                    <div class="col-lg-2 pd-l-15 pd-r-0 bd-l bd-1 text-center">
                        <button type="button" class="btn btn-block btn-continue btn-outline-primary btn-lg rounded-50 mg-t-15"><i class="fa fa-id-card"></i> Generate ID Card</button>
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(".btn-continue").click(function(){
            var templateid=$("#template_id").val();
            var studentids = $("input[name='studentid[]']:checked").map(function(){return $(this).val();}).get();
            if(studentids==0){
                swal("Opps!", "Please select atleast one student.", "error");
                return false;
            }
            if(templateid==0){
                swal("Opps!", "Please select id card template.", "error");
                return false;
            }
            window.location.assign('/MasterAdmin/StudentInformation/GenerateStudentIDCard/'+templateid+'/student/'+studentids+'/view');
        });
    </script>
@endsection
