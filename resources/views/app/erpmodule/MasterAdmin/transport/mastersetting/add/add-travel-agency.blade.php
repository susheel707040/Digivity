<form action="{{url('MasterAdmin/Transport/CreateTravelAgency')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Travel Agency <sup>*</sup> : </label>
                <input type="text" id="travel_agency" name="travel_agency" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Travel Agency">
            </div>

            <div class="col-lg-6">
                <label>Person Name <span class="text-gray">(optional)</span> : </label>
                <input type="text" id="person_name" name="person_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Person Name">
            </div>

            <div class="col-lg-6">
                <label>Mobile Number <span class="text-gray">(optional)</span> : </label>
                <input type="text" id="mobile_no" name="mobile_no" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Mobile Number">
            </div>

            <div class="col-lg-6">
                <label>Email ID <span class="text-gray">(optional)</span> : </label>
                <input type="text" id="email" name="email" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Email Address">
            </div>

            <div class="col-lg-12">
                <label>Office Address <span class="text-gray">(optional)</span> : </label>
               <textarea class="form-control" placeholder="Enter Travel Agency" id="office_address" name="office_address"></textarea>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

