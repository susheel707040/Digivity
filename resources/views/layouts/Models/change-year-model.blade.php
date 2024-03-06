
<div class="modal fade" id="editYearModels" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-750" role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-pen fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1"><b>Change Year</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0">Change Academic Year and Financial Year</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->

            <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
                <form action="{{'/UserYearChange/'.auth()->user()->id.'/change'}}" method="POST" enctype="multipart/form-data" id="selectForm2"
                      class="parsley-style-1" data-parsley-validate="" novalidate="">
                    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
                        {{ csrf_field() }}
                        <div class="row p-0 m-0">
                            <div class="col-lg-12">
                                <label>Academic Year <sup>*</sup> : </label>
                                @include('components.GlobalSetting.academic-year-import',['class'=>'form-control input-sm','required'=>'required','selectid'=>auth()->user()->academic_id])
                            </div>

                            <div class="col-lg-12">
                                <label>Financial Year <sup>*</sup> : </label>
                                @include('components.GlobalSetting.financial-year-import',['selectid'=>auth()->user()->financial_id,'class'=>'form-control input-sm','required'=>'required'])
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pd-x-20 pd-y-15">
                        <button type="button" class="btn btn-white float-left" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
                    </div>
                </form>


            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

