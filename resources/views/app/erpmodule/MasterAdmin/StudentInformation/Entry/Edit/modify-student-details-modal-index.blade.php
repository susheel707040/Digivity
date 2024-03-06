<div class="modal-body pd-sm-t-0 pd-sm-b-10 pd-sm-x-5">
    <div class="col-lg-12 pd-b-10">
        <table class="mg-t-10 mg-b-0">
            <tr>
                <td><b>Admission No.</b></td><td><b>:</b></td>
                <td class="pd-l-10"><input type="text" @if(isset($student)) value="{{$student->admission_no}}" @endif placeholder="Enter Admission No." class="form-control"></td>
                <td class="pd-l-10"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Get Detail</button></td>
            </tr>
        </table>
    </div>
    @if(isset($student)&&($student))
    <form action="{{url('MasterAdmin/StudentInformation/EditStudent/'.$student->id.'/edit')}}" data-parsley-validate="" novalidate="" method="POST" enctype="multipart/form-data">
     {{csrf_field()}}
    <div class="col-lg-12 pd-b-10 bd-1 bd-t">
        <div class="row pd-0 m-0">
            <div class="col-lg-4 pd-l-0 pd-t-4">
                @include('erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.StudentFirstInfo')
            </div>
            <div class="col-lg-8 m-0 pd-l-0 pd-r-0 vhr">

                <ul class="nav nav-line tx-12 bg-light pd-l-5" id="myTab5" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="student-info" data-toggle="tab" href="#student_info"
                           role="tab"
                           aria-controls="contact" aria-selected="true"><i class="fa fa-user"></i> Student
                            Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="parent-info" data-toggle="tab" href="#parent_info" role="tab"
                           aria-controls="contact" aria-selected="false"><i class="fa fa-users"></i> Parent Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#other_info" role="tab"
                           aria-controls="contact" aria-selected="false"> <i class="fa fa-list"></i> Other Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#document_info" role="tab"
                           aria-controls="contact" aria-selected="false"> <i class="fa fa-sitemap"></i> Document
                            Detail</a>
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
        </div>
    </div>
        <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
        </div>
    </form>
    @endif
</div>

