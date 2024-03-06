<div class="modal fade" id="BarcodeModels" tabindex="-1" role="dialog" aria-hidden="true">
    <div id="modal-dialog" class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Generate Barcode Process</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Generate Barcode Process</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->
            <form action="{{route('admin.barcodeprint')}}" method="POST" enctype="multipart/form-data">
               {{csrf_field()}}
                <input type="hidden" name="db_ids" id="db_ids">
                <input type="hidden" name="db_model" id="db_model" @if(isset($db_model)&&($db_model)) value="{{$db_model}}"  @endif>
                <input type="hidden" name="db_model_search" id="db_model_search" @if(isset($db_model_search)&&($db_model_search)) value="{{serialize($db_model_search)}}" @endif>
            <div class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
                <div class="row m-0 p-0">
                    <div class="col-lg-6">
                        <label>Barcode Template :</label>
                        @include('components.Barcode.barcode-template-import')
                    </div>
                </div>
            </div>
            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-check"></i> Generate</button>
            </div>
            </form>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

