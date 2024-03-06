@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Staff Detail</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/Staff/EditStaff/'.$staffrecord->id.'/edit')}}" data-parsley-validate="" novalidate="" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-user-plus"></i> Edit Staff Detail</b></div>
            <div class="panel-body pd-b-15 tx-12">
                <div class="row pd-0 m-0">
                    <div class="col-lg-3 pd-l-0 pd-t-4">
                        @include('app.erpmodule.MasterAdmin.Staff.Entry.FormPage.staff-first-info')
                    </div>
                    <div class="col-lg-7 m-0 pd-l-0 pd-r-0 vhr">
                        <ul class="nav nav-line tx-12 bg-light pd-l-5" id="myTab5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="student-info" data-toggle="tab" href="#staff_info"
                                   role="tab"
                                   aria-controls="contact" aria-selected="true"><i class="fa fa-user"></i> Edit Staff/Employee
                                    Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="parent-info" data-toggle="tab" href="#qualification_info" role="tab"
                                   aria-controls="contact" aria-selected="false"><i class="fa fa-graduation-cap"></i> Edit Qualification Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="parent-info" data-toggle="tab" href="#document_info" role="tab"
                                   aria-controls="contact" aria-selected="false"><i class="fa fa-file-pdf"></i> Edit Document Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#other_info" role="tab"
                                   aria-controls="contact" aria-selected="false"> <i class="fa fa-list"></i> Other
                                    Details</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-content col-md-12 m-0 pd-r-5 tab-pane fade show active " id="staff_info" role="tabpanel"
                                 aria-labelledby="home-tab5">
                                @include('app.erpmodule.MasterAdmin.Staff.Entry.FormPage.staff-personal-info')
                            </div>
                            <div class="tab-content col-md-12 p-0 m-0 tab-pane" id="qualification_info" role="tabpanel"
                                 aria-labelledby="home-tab5">
                                @include('app.erpmodule.MasterAdmin.Staff.Entry.FormPage.staff-qualification-info')
                            </div>

                            <div class="tab-content col-md-12 p-0 m-0 tab-pane" id="document_info" role="tabpanel"
                                 aria-labelledby="home-tab5">
                                @include('app.erpmodule.MasterAdmin.Staff.Entry.FormPage.staff-document-info')
                            </div>

                            <div class="tab-content col-md-12 p-0 m-0 tab-pane" id="other_info" role="tabpanel"
                                 aria-labelledby="home-tab5">
                                @include('app.erpmodule.MasterAdmin.Staff.Entry.FormPage.staff-other-info')
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-2 pd-l-30 vhr">
                        <button type="submit" class="btn btn-block btn-outline-success mg-t-20 rounded-pill">Update
                            <i class="fa fa-check"></i></button>

                        <a href="{{url('/MasterAdmin/Staff/StaffList')}}"><button type="button" class="btn btn-block btn-outline-primary tx-12 mg-t-20 rounded-pill">Preview <i class="fa fa-search"></i>
                            </button></a>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
