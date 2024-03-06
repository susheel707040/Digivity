<form action="{{url('/MasterAdmin/FrontOffice/CreateEntryEnquiry')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
    {{csrf_field()}}
     <div class="col-lg-12 pd-l-10 pd-r-10 m-0 row mx-auto">
                <div class="col-lg-8 row p-0 m-0">
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Purpose <sup>*</sup> :</label>
                        @include('components.FrontOffice.purpose-import',['required'=>'required'])
                    </div>

                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Class/Course <span class="text-gray">(Optional)</span> :</label>
                        @include('components.course-import',['class'=>'form-control'])
                    </div>

                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Last School Name :</label>
                        <input type="text" placeholder="Enter Last School Name" class="form-control">
                    </div>

                    <div class="col-lg-3 pd-l-5 pd-r-10">
                        <label>Last School Address :</label>
                        <input type="text" placeholder="Last School Address" class="form-control">
                    </div>

                    <div class="col-lg-12"></div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Enquiry No. <sup>*</sup> :</label>
                        <input type="text" placeholder="Enter Enquiry No." value="{{FormNoGenerate('enquiry_no')->GetNo()}}" class="form-control bg-success-light text-center" required>
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Enquiry Date <sup>*</sup> :</label>
                        <input type="text" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}" class="form-control date" required>
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Reminder Date <sup>*</sup> :</label>
                        <input type="text" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}" class="form-control date" required>
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-10">
                        <label>Next Follow Up Date <sup>*</sup> :</label>
                        <input type="text" placeholder="dd-mm-yyyy" class="form-control date">
                    </div>

                    <div class="col-lg-4 pd-l-5 pd-r-5">
                        <label>Applicant Name <sup>*</sup> :</label>
                        <input type="text" placeholder="Enter Applicant Name" class="form-control" required>
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Gender :</label>
                        @include('components.GlobalSetting.gender-import',['class'=>'form-control'])
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Contact No. <sup>*</sup> :</label>
                        <input type="text" placeholder="Enter Contact Number" class="form-control" required>
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-10">
                        <label>Email <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" placeholder="Enter Email Address" class="form-control">
                    </div>

                    <div class="col-lg-4 pd-l-5 pd-r-5">
                        <label>Contact Person <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" placeholder="Enter Contact Person" class="form-control">
                    </div>
                    <div class="col-lg-8 pd-l-5 pd-r-10">
                        <label>Residence Address <span class="text-gray">(Optional)</span> :</label>
                        <textarea placeholder="Enter Residence Address" class="form-control"></textarea>
                    </div>

                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Enquiry Status <sup>*</sup> :</label>
                        @include('components.FrontOffice.status-import')
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Enquiry Observation <sup>*</sup> :</label>
                        @include('components.FrontOffice.observation-import')
                    </div>
                    <div class="col-lg-3 pd-l-5 pd-r-5">
                        <label>Reference <span class="text-gray">(Optional)</span> :</label>
                        <input type="text" placeholder="Enter Reference" class="form-control">
                    </div>
                    <div class="col-lg-8 pd-l-5 pd-r-10">
                        <label>Remark <span class="text-gray">(Optional)</span> :</label>
                        <textarea placeholder="Enter Remark" class="form-control"></textarea>
                    </div>


                    <div class="col-lg-12 bd-1 bd-t mg-t-10 pd-b-15 text-right">
                        <button class="btn btn-outline-primary mg-t-15 btn-lg rounded-50">Submit Enquiry <i class="fa fa-check"></i></button>
                    </div>

                </div>
                <div class="col-lg-4 p-0 pd-r-0 vhr">
                    @include('components.FrontOffice.web-camera-import')
                </div>
            </div>
</form>

