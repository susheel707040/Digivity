@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ url('/MasterAdmin/Transport/index') }}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Student Assign Transport</li>
        </ol>
    </nav>

    <form action="{{ url('MasterAdmin/Transport/AssignTransportToStudent') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-search"></i> Search Student for Assign Transport</b></div>
                <div class="panel-body tx-12 pd-b-15 row">
                    <div class="col-lg-12 mx-auto row m-0">
                        <div class="col-lg-3 pd-l-0 pd-r-10">
                            <label>Class/Course :</label>
                            @include('components.course-import', ['class' => 'form-control'])
                        </div>
                        <div class="col-lg-2 pd-r-10">
                            <label>Section :</label>
                            @include('components.section-import', ['class' => 'form-control'])
                        </div>
                        <div class="col-lg-5">
                            <label><b>Student :</b></label>
                            @include('components.student-list-import', [
                                'required' => 'required',
                                'class' => 'form-control select-search',
                            ])
                        </div>
                        <div class="col-lg-2 mg-t-20">
                            <button type="submit" class="btn rounded-50 btn-primary">Continue <i
                                    class="fa fa-angle-right"></i> </button>
                        </div>
                        <div class="col-lg-12 pd-l-0 pd-t-5 ">
                            <span class="tx-primary cursor-pointer"><b><i class="fa fa-search"></i> <u>Advance
                                        Search</u></b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($request->student_id)
        @php
            $student = collect(studentshortlist(['student_id' => $request->student_id]))->first();
        @endphp
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-plus"></i> Assign Student Transport</b></div>
                <div class="panel-body pd-b-15 row m-0">
                    <div class="col-lg-5 bd-r pd-t-10 mg-r-10 pd-b-10">
                        <h6 class="bg-light pl-2 pt-1 pb-1">Student Details :</h6>
                        @include('components.Student.student-left-record-import', [
                            'student' => $student,
                        ])
                    </div>
                    <div class="col-lg-5 pd-t-10 mg-r-10 pd-b-10">
                        <h6 class="bg-light pl-2 pt-1 pb-1">Transport Details :</h6>
                        <form action="{{ url('MasterAdmin/Transport/studentAssignTransport') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="student_id" value="{{ $student->id }}" />
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label><b>Transport Joining Date <sup>*</sup>:</b></label>
                                    <input type="text" name="transport_start_date" required class="form-control date input-sm"
                                        value="{{ \Carbon\Carbon::createFromDate()->format('d-m-Y') }}">
                                </div>
                            </div>

                            <div class="form-row mg-t-10">
                                <div class="col-md-10">
                                    <label><b>Transport Route List <sup>*</sup>:</b></label>
                                    @include('components.Transport.assign-transport-route-list', [
                                        'id' => '',
                                        'class' => 'form-control select-search input-sm',
                                        'name' => 'transport_id',
                                        'selectid' => isset($student->transport->id) ?? $student->transport->id,
                                    ])
                                </div>
                            </div>
                            <div class="form-row mg-t-10">
                                <div class="col-lg-7">
                                    <label><b>Transport Status <sup>*</sup> :</b></label>
                                    <table>
                                        <tr>
                                            <td>
                                                <input name="transport_assigned" value="active" type="radio"
                                                    {{ $student->transport_status == 'active' ? 'checked' : '' }}>
                                            </td>
                                            <td class="pd-l-5">Active</td>
                                            <td class="pd-l-10">
                                                <input name="transport_assigned" value="inactive" type="radio"
                                                    {{ $student->transport_status == 'inactive' ? 'checked' : '' }}>
                                            </td>
                                            <td class="pd-l-5">In-Active</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-row mg-t-10">
                                <div class="col-lg-8">
                                    <button class="btn btn-primary  btn-lg mg-t-20" type="submit">
                                        <i class="fa fa-plus"></i>
                                        Assign
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
