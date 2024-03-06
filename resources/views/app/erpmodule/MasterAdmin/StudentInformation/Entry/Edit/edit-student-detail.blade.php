@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Student Registration</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Student Detail</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/StudentInformation/EditStudent/'.$student->id.'/edit')}}" data-parsley-validate="" novalidate="" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-user-edit"></i> Edit Student Details</b></div>
            <div class="panel-body pd-b-15 tx-11">
                <div class="row pd-0 m-0">
                    <div class="col-lg-3 pd-l-0 pd-t-4">
                        @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.StudentFirstInfo')
                    </div>
                    <div class="col-lg-8 m-0 pd-l-0 pd-r-0 vhr">

                        <ul class="nav nav-line tx-12 bg-light pd-l-5" id="myTab5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="student-info" data-toggle="tab" href="#student_info"
                                   role="tab"
                                   aria-controls="contact" aria-selected="true"><i class="fa fa-user"></i> STUDENT
                                    DETAILS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="parent-info" data-toggle="tab" href="#parent_info" role="tab"
                                   aria-controls="contact" aria-selected="false"><i class="fa fa-users"></i> PARENTS DETAILS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#other_info" role="tab"
                                   aria-controls="contact" aria-selected="false"> <i class="fa fa-list"></i> OTHER
                                    DETAILS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#document_info" role="tab"
                                   aria-controls="contact" aria-selected="false"> <i class="fa fa-sitemap"></i> DOCUMENTS
                                    DETAILS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-content col-md-12 m-0 pd-r-5 tab-pane fade show active" id="student_info" role="tabpanel"
                                 aria-labelledby="home-tab5">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.StudentPersonalInfo')
                            </div>

                            <div class="tab-content col-md-12 m-0 tab-pane fade " id="parent_info" role="tabpanel"
                                 aria-labelledby="profile-tab5">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.ParentInfo')
                            </div>

                            <div class="tab-content col-md-12 m-0 tab-pane" id="other_info" role="tabpanel"
                                 aria-labelledby="profile-tab5">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.OtherInfo')
                            </div>

                            <div class="tab-content col-md-12 m-0 tab-pane" id="fees_info" role="tabpanel"
                                 aria-labelledby="profile-tab5">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.FeesInfo')
                            </div>

                            <div class="tab-content col-md-12 m-0 tab-pane" id="document_info" role="tabpanel"
                                 aria-labelledby="profile-tab5">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.student-document-info')
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-1 pd-l-5 pd-r-0 vhr text-center">
                        <button type="submit" class="btn btn-block btn-outline-success mg-t-20 rounded-pill">Update
                            <i class="fa fa-check"></i></button>

                        <button type="button" class="btn btn-block btn-outline-primary tx-12 mg-t-20 rounded-pill">Preview <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection



