@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Management</li>
            <li class="breadcrumb-item " aria-current="page">Master Update</li>
            <li class="breadcrumb-item active" aria-current="page">Update Student Profile Images</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> Update Student Profile Images</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{ csrf_field() }}
                    <div class="col-lg-12 pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-2 pd-l-0 pd-r-0">
                            <label><b>Admission No. :</b></label>
                            <input type="text" autocomplete="off" placeholder="Admission No."
                                value="{{ request()->get('admission_no') }}" name="admission_no" class="form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Course :</b></label>
                            @include('components.course-import', [
                                'selectid' => request()->get('course_id'),
                            ])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-0">
                            <label><b>Section :</b></label>
                            @include('components.section-import', [
                                'selectid' => request()->get('section_id'),
                            ])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Order By :</b></label>
                            @include('components.student-sort-by', [
                                'class' => 'form-control input-sm',
                                'id' => 'sortby',
                                'name' => 'sortby',
                                'required' => '',
                                'selectid' => request()->get('sortby'),
                                'other' => 0,
                            ])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-0">
                            <button type="submit" class="btn mg-t-20 btn-primary">Continue <i
                                    class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>

                @if (request()->get('_token'))
                    <div class="col-lg-12 p-0 bd-1 bd-t pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-12 mg-t-10">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">S.No.</th>
                                        <th>Adm.No.</th>
                                        <th>Class/Course</th>
                                        <th>Student</th>
                                        <th>Father Name</th>
                                        <th class="text-center">Student Profile</th>
                                        {{-- <th>Update Profile Images</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($student as $data)
                                        <tr>
                                            <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                                            <td>{{ $data->admission_no }}</td>
                                            <td>{{ $data->CourseSection() }}</td>
                                            <td>{{ $data->fullName() }}</td>
                                            <td>{{ $data->FatherName() }}</td>
                                            <td class="text-center">
                                                <div class="avatar avatar-lg mx-auto">
                                                    <img src="{{ url('uploads/student_profile_image/' . $data->profile_img) }}"
                                                         class="rounded-circle bd-2 bd file-{{ $data->id }}"
                                                         alt="">
                                                </div>
                                            </td>
                                            {{-- <td class="wd-20p">
                                                <form class="form_{{ $data->id }}" action="{{ '/FileUpdateModel' }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="model_id" value="{{ $data->id }}">
                                                    <input type="hidden" name="model"
                                                        value="{{ \App\Models\MasterAdmin\Admission\StudentRecord::class }}">
                                                    <input type="hidden" name="model_column" value="profile_img">
                                                    <input type="file" modelid="{{ $data->id }}"
                                                        filename="file-{{ $data->id }}"
                                                        formid="form_{{ $data->id }}"
                                                        alertmsg="alert-msg-{{ $data->id }}" name="file"
                                                        class="form-control file-choose">
                                                    <span class="alert-msg-{{ $data->id }} alert-msg-ajax"></span>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
