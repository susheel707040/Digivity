<form action="{{url('/MasterAdmin/GlobalSetting/EditFinancialYear/'.$financial->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-12">
                <label>Financial Year<sup>*</sup> : </label>
                <input type="text" id="financial_session" name="financial_session" autocomplete="off"
                      value="{{$financial->financial_session}}" class="form-control input-sm" placeholder="Enter Financial Year Like : 2019-2020">
            </div>

            <div class="col-lg-6">
                <label>Financial Year Start Date <sup>*</sup> : </label>
                <input type="text" id="start_date datepicker1" name="start_date" autocomplete="off"
                      value="{{\App\Helper\DateFormat::datenumeric($financial->start_date)}}" class="form-control date input-sm" placeholder="Enter Start Date (dd-mm-yyyy)">
            </div>
            <div class="col-lg-6">
                <label>Financial Year End Date <sup>*</sup> : </label>
                <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control date input-sm"
                       value="{{\App\Helper\DateFormat::datenumeric($financial->end_date)}}"    placeholder="Enter End Date (dd-mm-yyyy)">
            </div>

            <div class="col-lg-6">
                <label>Default Active <sup>*</sup> : <input type="checkbox" value="yes" name="default_at"
                                                            id="default_at" @if($financial->default_at=="yes") checked @endif></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-pen"></i> Update</button>
    </div>
</form>

