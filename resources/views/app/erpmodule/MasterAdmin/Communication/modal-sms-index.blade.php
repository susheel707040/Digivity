<form class="communication" loader-disable="true" action="{{url('/MasterAdmin/Communication/SendSMS')}}" method="POST"
      enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="modal fade" id="smsPageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div id="modal-dialog" class="modal-dialog modal-xxl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                    <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal"
                       aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="media align-items-center">
                        <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                        <div class="media-body mg-sm-l-20">
                            <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Send Communication (SMS/Email)</b>
                            </h4>
                            <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Send Communication (SMS/Email)</p>
                        </div>
                    </div><!-- media -->
                </div><!-- modal-header -->
                <div id="ModelData" class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">

                    <div class="col-lg-12 m-0 tx-12">
                        <div class="col-lg-12 pd-5 mg-t-2 d-flex bg-white">
                            <div class="col-lg-4 p-0 m-0 flex-1" style=" max-height: 550px; overflow:scroll;">
                                <input type="hidden" class="studentid" name="studentid" value="">
                                <div class="parameter_section"></div>

                                <table class="table table-bordered">
                                    <thead class="bg-primary-light tx-12">
                                    <tr>
                                        <th colspan="2">Reciver : <span class="receiver"></span></th>
                                        <th>Total Reciver : <span class="receiver_count">0</span></th>
                                    </tr>
                                    </thead>
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">Sl.No.</th>
                                        <th>Receiver Name</th>
                                        <th>Contact No.</th>
                                    </tr>
                                    </thead>
                                    <tbody class="receiver_body">
                                    <tr>
                                        <td colspan="2" class="text-danger text-center">Sorry, No Receiver</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="divider-text divider-vertical">and</div>
                            <div class="flex-1">
                                <div class="card mg-t-10 p-0 m-0">
                                    <div class="card-header bg-gray-100"><i class="fa fa-envelope"></i> Text Message
                                    </div>
                                    <div class="card-body m-0 pd-0 pd-t-0 pd-b-10 tx-13 m-0 flex-fill row">
                                        @php
                                            $input_check="checked";
                                        @endphp
                                        @include('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-page-model')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-preview-confirm')
</form>


