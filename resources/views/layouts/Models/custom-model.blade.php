<div class="modal fade" id="CustomModels" tabindex="-1" role="dialog" aria-hidden="true">
    <div id="modal-dialog" class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>@yield('ModelTitle')</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">@yield('EditModelTitleInfo')</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->
            <div id="ModelData" class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

