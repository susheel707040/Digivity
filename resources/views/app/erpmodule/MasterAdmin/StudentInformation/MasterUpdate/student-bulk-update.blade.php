@php
    $selected_fields = request()->get('field_id');
    // converted selected field to array to facilitate single and multiselect student update details fields
    if (!is_array($selected_fields)) {
        $selected_fields = [request()->get('field_id')];
    }
@endphp

@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Management</li>
            <li class="breadcrumb-item " aria-current="page">Master Update</li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Update Student Details</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i>Bulk Update Student Details</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{ csrf_field() }}
                    <div class="col-lg-12 pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Admission No. :</b></label>
                            <input type="text" autocomplete="off" placeholder="Admission No."
                                value="{{ request()->get('admission_no') }}" name="admission_no" class="form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Course :</b></label>
                            @include('components.course-import', [
                                'selectid' => request()->get('course_id'),
                                // 'required' => 'required',
                            ])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>Section :</b></label>
                            @include('components.section-import', [
                                'selectid' => request()->get('section_id'),
                                // 'required' => 'required',
                                'error_message' => 'Select Section',
                            ])
                        </div>
                        <div class="col-lg-2">
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
                        <div class="col-lg-2">
                            <label><b>Field :</b></label>
                            @include('components.Student.student-update-field-import', [
                                'multiselect' => true,
                                'selectid' => request()->get('field_id'),
                                // 'required' => 'required',
                                // 'error-message' => request()->get('error'),
                            ])
                        </div>
                        {{-- <div class="col-lg-2">
                            <label>Import</label>
                            <input type="file" class="form-control" name="import_file">
                        </div> --}}
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <button type="submit" class="btn mg-t-20 btn-primary">Search <i
                                    class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>

                @if (request()->get('_token'))
                    <form action="{{ url('MasterAdmin/StudentInformation/EditStudentUpdate') }}" method="POST"
                        class="container-fluid">
                        {{ csrf_field() }}
                        <div class="col-lg-12 p-0 bd-1 bd-t pd-t-10 pd-b-10 row m-0">
                            <div class="col-lg-10 mg-t-10">
                                <table class="table bd-1 bd tx-11">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="CheckAll"
                                                    value="checkbox1"></th>
                                            <th class="text-center">S No.</th>
                                            <th class="text-center">Admission No.</th>
                                            <th>Course - Section</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Last Field Value</th>
                                            @foreach ($selected_fields as $field)
                                                <th>
                                                    {{ ucwords(str_replace('@', ', ', str_replace('_', ' ', $field))) }}
                                                </th>
                                            @endforeach
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($student as $data)
                                            @php
                                                $importdataarr = [];
                                                if (isset($importdataarr)) {
                                                    $importdata = collect($importdataarr)
                                                        ->where('admission_no', $data->admission_no)
                                                        ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center"><input name="studentid[]" class="checkbox1"
                                                        value="{{ $data->student_id }}" type="checkbox"
                                                        @if (isset($importdata)) checked @endif></td>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $data->admission_no }}</td>
                                                <td>{{ $data->CourseSection() }}</td>
                                                <td>{{ $data->FullName() }}</td>
                                                <td>{{ $data->FatherName() }}</td>
                                                <td>
                                                </td>
                                                @foreach ($selected_fields as $fieldid)
                                                    <td>
                                                        <input type="hidden" name="fieldid_{{ $data->student_id }}[]"
                                                            value="{{ $fieldid }}">
                                                        {!! inputfield($fieldid, $data, $data->student_id, $importdata) !!}
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <button type="button" class="btn btn-success text-center"><i
                                                            class="fa fa-check"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-info mg-t-10 btn-lg btn-block"><i class="fa fa-edit"></i>
                                    Update</button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>

@endsection

@php
    function inputfield($fieldid, $data, $studentid, $importdata)
    {
        $fieldvalue = '';
        if (isset($data->$fieldid)) {
            $fieldvalue = $data->$fieldid;
        }
        if (isset($data->student->$fieldid)) {
            $fieldvalue = $data->student->$fieldid;
        }
        if ($fieldid == 'gender') {
            $fieldvalue = $data->student->$fieldid;
        }

        if (isset($importdata[$fieldid])) {
            $fieldvalue = $importdata[$fieldid];
        }
        return "<input type='text' name='" . $fieldid . '_' . $studentid . "' value='$fieldvalue' placeholder='Enter " . ucwords(str_replace('_', ' ', $fieldid)) . "' class='form-control'>";
    }
    $fieldvalue = '';
@endphp
