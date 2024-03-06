<div class="modal fade" id="editModels" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog @hasSection('ModelSize') @yield('ModelSize') @else modal-lg wd-sm-750 @endif modal-dialog-centered " role="document">
        <div class="modal-content" >
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-pen fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1"><b>@yield('EditModelTitle')</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0">@yield('EditModelTitleInfo')</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->

            @yield('EditModelPage')
            <div id="ModelLoadData" class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

