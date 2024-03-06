<div class="modal fade" id="smsPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div id="modal-dialog" class="modal-dialog modal-lg wd-sm-750 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Communication (SMS/Email) Preview</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Communication (SMS/Email) Preview)</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->
            <div id="ModelData" class="modal-body pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
                <div class="col-lg-12 pd-10 row m-0">
                    <table cellspacing="2" cellpadding="4">
                        <tr>
                            <td><b>Communication Type</b></td>
                            <td class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td><span class="comm_type"></span></td>
                        </tr>
                        <tr>
                            <td><b>Total Communication Receiver</b></td>
                            <td class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td><span class="total_receiver"></span></td>
                        </tr>
                        <tr>
                            <td><b>Message Unicode</b></td>
                            <td class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td><span class="msg_unicode"></span></td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Message</b></td>
                            <td valign="top" class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td valign="top"><span class="msg"></span></td>
                        </tr>
                        <tr>
                            <td><b>Estimate Message Count</b></td>
                            <td class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td><span class="msg_count">0</span></td>
                        </tr>
                        <tr>
                            <td><b>Estimate Message Deduct</b>
                            <td class="pd-l-10 pd-r-10"><b>:</b></td>
                            <td><span class="badge badge-danger msg_total_count">0</span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i
                            class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" id="send_sms_btn" class="btn btn-primary float-right"> Send <i
                            class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

