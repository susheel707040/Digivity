@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Information</li>
            <li class="breadcrumb-item " aria-current="page">Master Update</li>
            <li class="breadcrumb-item active" aria-current="page">Update Parent/Guardian Profile Image</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> Update Parent/Guardian Profile Image</b></div>
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
                    {{ csrf_field() }}
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
                                        <th class="text-center">Father Profile</th>
                                        <th class="text-center">Mother Profile</th>
                                        <th class="text-center">Local Guardian Profile</th>
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
                                                <table cellpadding="0" cellspacing="0" class="table-borderless m-0 p-0">
                                                    <tr>
                                                        <td>
                                                            <div class="avatar avatar-lg mx-auto">
                                                                <img src="{{ url('uploads/father_photo/' . $data->father_photo) }}"
                                                                    class="rounded-circle bd-2 bd file-f-{{ $data->id }}"
                                                                    alt="">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        {{-- <td>
                                                            <form class="form_f_{{ $data->id }}"
                                                                action="{{ '/FileUpdateModel' }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="model_id"
                                                                    value="{{ $data->id }}">
                                                                <input type="hidden" name="model"
                                                                    value="{{ \App\Models\MasterAdmin\Admission\StudentRecord::class }}">
                                                                <input type="hidden" name="model_column"
                                                                    value="father_photo">
                                                                <input type="file" modelid="{{ $data->id }}"
                                                                    filename="file-f-{{ $data->id }}"
                                                                    formid="form_f_{{ $data->id }}"
                                                                    alertmsg="alert-msg-f-{{ $data->id }}"
                                                                    name="file" class="form-control file-choose">
                                                                <span
                                                                    class="alert-msg-f-{{ $data->id }} alert-msg-ajax"></span>
                                                            </form>
                                                        </td> --}}
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table cellpadding="0" cellspacing="0" class="table-borderless m-0 p-0">
                                                    <tr>
                                                        <td>
                                                            <div class="avatar avatar-lg mx-auto">
                                                                <img src="{{ url('uploads/mother_photo/' . $data->mother_photo) }}"
                                                                    class="rounded-circle bd-2 bd file-m-{{ $data->id }}"
                                                                    alt="">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        {{-- <td>
                                                            <form class="form_m_{{ $data->id }}"
                                                                action="{{ '/FileUpdateModel' }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="model_id"
                                                                    value="{{ $data->id }}">
                                                                <input type="hidden" name="model"
                                                                    value="{{ \App\Models\MasterAdmin\Admission\StudentRecord::class }}">
                                                                <input type="hidden" name="model_column"
                                                                    value="mother_photo">
                                                                <input type="file" modelid="{{ $data->id }}"
                                                                    filename="file-m-{{ $data->id }}"
                                                                    formid="form_m_{{ $data->id }}"
                                                                    alertmsg="alert-msg-m-{{ $data->id }}"
                                                                    name="file" class="form-control file-choose">
                                                                <span
                                                                    class="alert-msg-m-{{ $data->id }} alert-msg-ajax"></span>
                                                            </form>
                                                        </td> --}}
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table cellpadding="0" cellspacing="0" class="table-borderless m-0 p-0">
                                                    <tr>
                                                        <td>
                                                            <div class="avatar avatar-lg mx-auto">
                                                                <img src="{{ url('uploads/local_guardian_photo/' . $data->local_guardian_photo) }}"
                                                                    class="rounded-circle bd-2 bd file-lg-{{ $data->id }}"
                                                                    alt="">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        {{-- <td>
                                                            <form class="form_lg_{{ $data->id }}"
                                                                action="{{ '/FileUpdateModel' }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="model_id"
                                                                    value="{{ $data->id }}">
                                                                <input type="hidden" name="model"
                                                                    value="{{ \App\Models\MasterAdmin\Admission\StudentRecord::class }}">
                                                                <input type="hidden" name="model_column"
                                                                    value="local_guardian_photo">
                                                                <input type="file" modelid="{{ $data->id }}"
                                                                    filename="file-lg-{{ $data->id }}"
                                                                    formid="form_lg_{{ $data->id }}"
                                                                    alertmsg="alert-msg-lg-{{ $data->id }}"
                                                                    name="file" class="form-control file-choose">
                                                                <span
                                                                    class="alert-msg-lg-{{ $data->id }} alert-msg-ajax"></span>
                                                            </form>
                                                        </td> --}}
                                                    </tr>
                                                </table>
                                            </td>
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
