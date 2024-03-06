<form action="{{url('/MasterAdmin/GlobalSetting/EditAcademicYear/'.$academic->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-12">
                <label>Academic Session <sup>*</sup> : </label>
                <input type="text" value="{{$academic->academic_session}}" id="academic_session" name="academic_session" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Academic Session Like : 2019-2020">
            </div>

            <div class="col-lg-6">
                <label>Academic Session Start Date <sup>*</sup> : </label>
                <input type="text" value="{{\App\Helper\DateFormat::datenumeric($academic->start_date)}}" id="start_date datepicker1" name="start_date" autocomplete="off"
                       class="form-control date input-sm" placeholder="Enter Session Start Date (dd-mm-yyyy)">
            </div>
            <div class="col-lg-6">
                <label>Academic Session End Date <sup>*</sup> : </label>
                <input type="text"  value="{{\App\Helper\DateFormat::datenumeric($academic->end_date)}}" id="end_date" name="end_date" autocomplete="off" class="form-control date input-sm"
                       placeholder="Enter Session End Date (dd-mm-yyyy)">
            </div>

            <div class="col-lg-6">
                <label>Default Active <sup>*</sup> : <input type="checkbox" value="yes" name="default_at"
                                                            id="default_at" @if($academic->default_at=="yes") checked @endif></label>
            </div>
        </div>


    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

