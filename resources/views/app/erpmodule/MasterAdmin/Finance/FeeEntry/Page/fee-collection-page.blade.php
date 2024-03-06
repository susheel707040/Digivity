<div class="card">
    <div class="card-header bg-gray-100">
        <table>
            <tr>
                <td><i class="fa fa-rupee-sign"></i> <b>Fee Collect Information</b></td>
                <td class="pd-l-30"><b>Entry Mode <sup>*</sup> :</b></td>
                <td class="pd-l-10"><input type="radio" name="entry_mode" value="school" checked></td>
                <td class="pd-l-5">School</td>
                <td class="pd-l-10"><input type="radio" name="entry_mode" value="bank"></td>
                <td class="pd-l-5">Bank</td>
                <td class="pd-l-10"><input type="radio" name="entry_mode" value="online"></td>
                <td class="pd-l-5">Online</td>
                <td class="pd-l-20"><b>Payment Date <sup>*</sup> :</b></td>
                <td class="pd-l-5"><input type="text" value="{{nowdate('','d-m-Y')}}" name="receipt_date" id="receipt_date"
                                          placeholder="dd-mm-yyyy" class="form-control date input-sm"></td>
                <td class="pd-l-20"><b>Receipt No. :</b></td>
                <td class="pd-l-5"><input type="text" placeholder="Enter Receipt No." class="form-control input-sm">
                </td>
                <td class="pd-l-30"><input type="checkbox" class=""></td>
                <td class="pd-l-5">Instalment Check</td>
            </tr>
        </table>
    </div>

    <div class="card-body pd-0 pd-t-0 row pd-b-5 m-0 flex-fill">
        <div class="col-lg-8 pd-l-5 pd-r-5 pd-t-2 pd-b-2 m-0">
            <div class="row p-0 m-0">
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Fee Amount :</b></label>
                    <input type="text" name="feesubtotal" id="feesubtotal" onkeypress="javascript:return isNumber(event)" readonly="readonly" value="{{$totalarr['subtotal']}}"
                           class="form-control font-weight-bold input-sm">
                </div>
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Concession :</b></label>
                    <input onkeypress="javascript:return isNumber(event)" name="feeconcessiontotal" readonly="readonly" type="text" id="feeconcessiontotal" value="{{$totalarr['concessiontotal']}}"
                           class="form-control font-weight-bold input-sm">
                </div>
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Late Fee :</b></label>
                    <input onkeypress="javascript:return isNumber(event)" type="text" name="feefinetotal" id="feefinetotal"  value="{{$totalarr['finetotal']}}"
                           class="form-control font-weight-bold input-sm">
                </div>

                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Excess Amount :</b></label>
                    <input type="text" id="feeexcesstotal" readonly="readonly" value="{{$totalarr['excesstotal']}}"
                           class="form-control font-weight-bold input-sm">
                </div>

                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Fee Payable :</b></label>
                    <input onkeypress="javascript:return isNumber(event)" type="text" name="feepayable" id="feepayable" readonly="readonly" value="{{$totalarr['feepayable']}}"
                           class="form-control bg-warning-light font-weight-bold input-sm">
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Paymode <sup>*</sup> :</b></label>
                    <select id="paymode_id" name="paymode_id" class="form-control input-sm">
                        <option value="">---Select---</option>
                        @foreach(paymodelist() as $data)
                            <option value="{{$data->id}}"
                                    @if($data->default_at=="yes") selected @endif>{{ucfirst($data->paymode)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Instrument No. :</b></label>
                    <input type="text" id="instrument_no" name="instrument_no" placeholder="Instrument No."
                           class="form-control input-sm">
                </div>
                <div class="col-lg-2 pd-l-0 m-0">
                    <label><b>Instrument Date :</b></label>
                    <input type="text" id="instrument_date" name="instrument_date" placeholder="dd-mm-yyyy"
                           class="form-control date input-sm">
                </div>
                <div class="col-lg-4 pd-l-0 m-0">
                    <label><b>Bank :</b></label>
                    <select id="bank_id" name="bank_id" class="form-control select-search input-sm">
                        <option value="">---Select---</option>
                        <option>Abhyudaya Co-Op Bank Ltd</option>
                        <option>Abu Dhabi Commercial Bank</option>
                        <option>Ahmedabad Mercantile Co-Op Bank Ltd</option>
                        <option>Allahabad Bank</option>
                        <option>Almora Urban Co-Operative Bank Ltd</option>
                        <option>Andhra Bank</option>
                        <option>Andhra Pragathi Grameena Bank</option>
                        <option>Apna Sahakari Bank Ltd</option>
                        <option>Austarlia and New Zealand Banking Gorup Ltd</option>
                        <option>Axis Bank</option>
                        <option>Bank Internasional Indonesia</option>
                        <option>Bank Of America</option>
                        <option>Bank Of Bahrain And Kuwait</option>
                        <option>Bank Of Baroda</option>
                        <option>Bank Of Ceylon</option>
                        <option>Bank Of India</option>
                        <option>Bank Of Maharashtra</option>
                        <option>Bank Of Nova Scotia</option>
                        <option>Bank Of Tokyo-Mitsubishi Ufj Ltd</option>
                        <option>Barclays Bank Plc</option>
                        <option>Bassein Catholic Co-Op Bank Ltd</option>
                        <option>Bharat Co-Op Bank (Mumbai) Ltd</option>
                        <option>Bnp Paribas</option>
                        <option>Canara Bank</option>
                        <option>Capital Local Area Bank Ltd</option>
                        <option>Catholic Syrian Bank Ltd</option>
                        <option>Central Bank Of India</option>
                        <option>Chinatrust Commercial Bank</option>
                        <option>Citibank</option>
                        <option>Citizencredit Co-Op Bank Ltd</option>
                        <option>City Union Bank Ltd</option>
                        <option>Commonwealth Bank of Australia</option>
                        <option>Corporation Bank</option>
                        <option>Cosmos Co-Op Bank Ltd</option>
                        <option>Credit Agricole Corp and Investment Bank</option>
                        <option>Credit Suisse Ag</option>
                        <option>Dbs Bank Ltd</option>
                        <option>Dena Bank</option>
                        <option>Deutsche Bank Ag</option>
                        <option>Development Credit Bank Ltd</option>
                        <option>Dhanlaxmi Bank Ltd</option>
                        <option>Dicgc</option>
                        <option>Dombivli Nagari Sahakari Bank Ltd</option>
                        <option>Federal Bank Ltd</option>
                        <option>Firstrand Bank Ltd</option>
                        <option>Greater Bombay Co-Op Bank Ltd</option>
                        <option>Gurgaon Gramin Bank</option>
                        <option>Hdfc Bank Ltd</option>
                        <option>Hsbc</option>
                        <option>Icici Bank Ltd</option>
                        <option>Idbi Bank Ltd</option>
                        <option>Indian Bank</option>
                        <option>Indian Overseas Bank</option>
                        <option>Indusind Bank Ltd</option>
                        <option>Ing Vysya Bank Ltd</option>
                        <option>Jalgaon Janata Sahkari Bank Ltd</option>
                        <option>Jammu And Kashmir Bank Ltd</option>
                        <option>Janakalyan Sahakari Bank Ltd</option>
                        <option>Janaseva Sahakari Bank Ltd Pune</option>
                        <option>Janata Sahkari Bank Ltd Pune</option>
                        <option>Jpmorgan Chase Bank</option>
                        <option>Kallappanna Awade Ich Janata S Bank</option>
                        <option>Kalupur Commercial Co Op Bank Ltd</option>
                        <option>Kalyan Janata Sahakari Bank Ltd</option>
                        <option>Kapole Co-Op Bank</option>
                        <option>Karnataka Bank Ltd</option>
                        <option>Karnataka State Co-Op Apex Bank Ltd</option>
                        <option>Karnataka Vikas Grameena Bank</option>
                        <option>Karur Vysya Bank</option>
                        <option>Kotak Mahindra Bank</option>
                        <option>Kurmanchal Nagar Sahakari Bank Ltd</option>
                        <option>Lakshmi Vilas Bank Ltd</option>
                        <option>Mahanagar Co-Op Bank Ltd</option>
                        <option>Maharashtra State Co-Op Bank</option>
                        <option>Mashreq Bank Psc</option>
                        <option>Mehsana Urban Co-Op Bank Ltd</option>
                        <option>Mizuho Corporate Bank Ltd</option>
                        <option>Mumbai District Central Co-Op Bank Ltd</option>
                        <option>Nagpur Nagarik Sahakari Bank Ltd</option>
                        <option>Nainital Bank Ltd</option>
                        <option>National Australia Bank</option>
                        <option>New India Co-Op Bank Ltd</option>
                        <option>Nkgsb Co-Op Bank Ltd</option>
                        <option>North Malabar Gramin Bank</option>
                        <option>Nutan Nagarik Sahakari Bank Ltd</option>
                        <option>Oman International Bank Saog</option>
                        <option>Oriental Bank Of Commerce</option>
                        <option>Parsik Janata Sahakari Bank Ltd</option>
                        <option>Prathama Bank</option>
                        <option>Prime Co-Operative Bank Ltd</option>
                        <option>Punjab And Maharashtra Co-Op Bank Ltd</option>
                        <option>Punjab And Sind Bank</option>
                        <option>Punjab National Bank</option>
                        <option>Rabobank International (CCRB)</option>
                        <option>Rajkot Nagarik Sahakari Bank Ltd</option>
                        <option>Ratnakar Bank Ltd</option>
                        <option>Reserve Bank Of India</option>
                        <option>Royal Bank Of Scotland</option>
                        <option>Saraswat Co-Op Bank Ltd</option>
                        <option>SBER Bank</option>
                        <option>Shamrao Vithal Co-Op Bank Ltd</option>
                        <option>Shinhan Bank</option>
                        <option>Shri Chhatrapati Rajarshi Shahu Urban Co-Op Bank Ltd</option>
                        <option>Societe Generale</option>
                        <option>South Indian Bank</option>
                        <option>Standard Chartered Bank</option>
                        <option>State Bank Of Bikaner And Jaipur</option>
                        <option>State Bank Of Hyderabad</option>
                        <option>State Bank Of India</option>
                        <option>State Bank Of Mauritius Ltd</option>
                        <option>State Bank Of Mysore</option>
                        <option>State Bank Of Patiala</option>
                        <option>State Bank Of Travancore</option>
                        <option>Sumitomo Mitsui Banking Corporation</option>
                        <option>Surat Peoples Co-Op Bank Ltd</option>
                        <option>Syndicate Bank</option>
                        <option>Tamilnad Mercantile Bank Ltd</option>
                        <option>Tamilnadu State Apex Co-Op Bank Ltd</option>
                        <option>Thane Bharat Sahakari Bank Ltd</option>
                        <option>Thane District Central Co-operative Bank Ltd</option>
                        <option>Thane Janata Sahakari Bank Ltd</option>
                        <option>The A.P. Mahesh Co-Op Urban Bank Ltd</option>
                        <option>The Akola District Central Co-operative Bank</option>
                        <option>The Gadchiroli District Central Co-operative Bank Ltd</option>
                        <option>The Gujarat State Co-Operative Bank Ltd</option>
                        <option>The Jalgaon Peoples Co-op Bank</option>
                        <option>The Kangra Co-Operative Bank Ltd.</option>
                        <option>The Karad Urban Co-Op Bank Ltd</option>
                        <option>The Municipal Co-Operative Bank Ltd. Mumbai</option>
                        <option>The Nasik Merchants Co-Op Bank Ltd</option>
                        <option>The Rajasthan State Co-Operative Bank Ltd</option>
                        <option>The Sahebrao Deshmukh Co-op Bank Ltd.</option>
                        <option>The Seva Vikas Co-operative Bank Ltd</option>
                        <option>The Surat District Co-Operative Bank Ltd</option>
                        <option>The Sutex Co Op Bank Ltd</option>
                        <option>The Varachha Co-Op. Bank Ltd</option>
                        <option>The Vishweshwar Sahakari Bank Ltd Pune</option>
                        <option>Tumkur Grain Merchants Cooperative Bank Ltd</option>
                        <option>UBS AG</option>
                        <option>Uco Bank</option>
                        <option>Union Bank Of India</option>
                        <option>United Bank Of India</option>
                        <option>Vasai Vikas Sahakari Bank Ltd</option>
                        <option>Vijaya Bank</option>
                        <option>West Bengal State Co-Op Bank Ltd</option>
                        <option>Westpac Banking Corporation</option>
                        <option>Woori Bank</option>
                        <option>Yes Bank Ltd</option>
                        <option>Other Bank</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="vhr col-lg-2 tx-14">
            <table class="container-fluid">
                <tr>
                    <td>
                        <label class="text-success"><b>Paid Amount :</b></label>
                        <input onkeypress="javascript:return isNumber(event)" type="text" autocomplete="off"  id="paid_amt" name="paid_amt"
                               placeholder="Enter Paid Amount" autofocus="autofocus"
                               class="form-control tx-19 bg-success-light">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><b>Balance :</b></label>
                        <input onkeypress="javascript:return isNumber(event)" type="text" id="balance" name="balance" value="{{$totalarr['feepayable']}}" autocomplete="off" readonly="readonly"
                               value="0" style=" background-color:#FADBD8; "
                               class="form-control wd-70p text-right input-sm">
                    </td>
                </tr>
            </table>
        </div>
        <div class="vhr col-lg-2 text-center">
            <button type="button" id="contine_fee_collect_confirm" class="btn tx-14 btn-primary mg-t-30"><b><i class="fa fa-arrow-right fa-lg"></i><br/>
                    Continue & Confirm
                </b>
            </button>
        </div>
        <div class="col-lg-12 bd-t bd-1 row pd-l-10 pd-t-0 m-0">
            <input type="hidden" name="concession_remark">
            <div class="col-lg-2 p-0 m-0">
                <label><b>Special Concession :</b></label>
                <input type="text" id="special_concession" name="special_concession" value="0"
                       class="form-control input-sm">
            </div>
            <div class="col-lg-4 pd-l-10 m-0">
                <label><b>Special Concession Remark <span class="text-gray">(Optional)</span> :</b></label>
                <textarea name="special_concession_remark" class="form-control"></textarea>
            </div>
            <div class="col-lg-2 p-0 m-0">
                <label><b>Fine/Late Fee Concession :</b></label>
                <input type="text" id="fine_concession" name="fine_concession" value="0" class="form-control input-sm">
            </div>
            <div class="col-lg-4 pd-l-15 m-0">
                <label><b>Fine Concession Remark <span class="text-gray">(Optional)</span> :</b></label>
                <textarea name="fine_remark" class="form-control"></textarea>
            </div>
            <div class="col-lg-4 pd-l-0 m-0">
                <label><b>Receipt Remark <span class="text-gray">(Optional)</span> :</b></label>
                <textarea name="fee_remark" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CollectionConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div id="modal-dialog" class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                <a href="#" role="button" class="close cancel-fee-collect pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Payment Collection Confirmation</b></h4>
                        <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Student Fee Collection Confirmation
                            and Submit</p>
                    </div>
                </div><!-- media -->
            </div><!-- modal-header -->
            <div class="modal-body pd-l-10 pd-sm-t-10 pd-sm-b-0">
                <table class="table table-bordered">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center"><b>#</b></th><th class="text-center"><b><input type="checkbox" id="CheckAll" value="checkbox1"></b></th><th><b>Student Details</b></th><th class="text-right"><b>Sub Total</b></th><th class="text-right"><b>Concession</b></td>
                        <th class="text-right"><b>Fine/Late Fee</b></th><th class="text-right"><b>Excess</b></th><th class="text-right"><b>Fee Payable</b></th><th class="text-right wd-150"><b>Fee Collect Amount</b></th><th class="text-right"><b>Balance</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studentidarr as $studentid)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center"><input type="checkbox" name="studentid[]" value="{{$studentid}}" class="checkbox1 select_student_pay_id select_student_pay_{{$studentid}}"></td>
                            <td class="text-capitalize"><b><span class="confirm_student_name_{{$studentid}}"></span></b></td>
                            <td class="text-right"><span class="confirm_subtotal_{{$studentid}}">0.00</span></td>
                            <td class="text-right"><span class="confirm_concessiontotal_{{$studentid}}">0.00</span></td>
                            <td class="text-right"><span class="confirm_finetotal_{{$studentid}}">0.00</span></td>
                            <td class="text-right"><span class="confirm_excess_{{$studentid}}">0.00</span></td>
                            <td class="text-right"><span class="confirm_feepayable_{{$studentid}}">0.00</span></td>
                            <td class="text-right"><input onkeypress="javascript:return isNumber(event)" autocomplete="off" type="text" name="student_{{$studentid}}_paid_amt" studentid="{{$studentid}}" class="form-control student_amount_change text-right student_{{$studentid}}_paid_amt input-sm" value="0"></td>
                            <td class="text-right"><span class="text-danger confirm_balance_{{$studentid}}">0.00</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <thead class="bg-light">
                    <tr>
                        <th colspan="3" class="text-right"><b>Total :</b></th>
                        <th class="text-right font-weight-bold"><span class="cnf_subtotal">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_concessiontotal">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_finetotal">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_excesstotal">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_payabletotal">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_paid_amt">0.0</span></th>
                        <th class="text-right font-weight-bold"><span class="cnf_bal">0.0</span></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white cancel-fee-collect tx-15 float-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" id="collect-btn-fee" class="btn btn-lg tx-15 btn-primary float-right"> <i class="fa fa-check"></i> Collect Fee Amount</button>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

