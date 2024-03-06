<div class="col-lg-8">
    <div class="col-lg-12 p-0 m-0">
        <label class="font-weight-bold">Communication Type <sup>*</sup> :</label><br/>
        <table class="col-lg-9">
            <tr>
                <td>
                    <select id="communication_type_id" name="communication_type_id" class="form-control input-sm">
                        <option value="">---Select---</option>
                        @foreach(comunicationtypelist() as $data)
                            <option value="{{$data->id}}" @if($data->default_at=="yes") selected @endif>{{$data->communication_type}}</option>
                        @endforeach
                    </select>
                </td>
                <td class="wd-30p">
                    <a href="{{url('MasterAdmin/Communication/DefineCommunicationType')}}">
                        <button type="button" class="btn btn-primary btn-xs mg-l-5 rounded-5"><i
                                class="fa fa-plus"></i> Add
                        </button>
                    </a>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-lg-12 p-0 m-0">
        <label class="font-weight-bold">Text Language (Unicode) <sup>*</sup> :</label><br/>
        <table class="col-lg-12">
            <tr>
                <td><input type="radio" class="unicode" name="unicode" value="0" checked></td>
                <td>English</td>
                @php
                    $fixheaderfooter = fixheaderfooterlist()->firstWhere('default_at', 'yes');
                    $unicodeChecked = $fixheaderfooter ? $fixheaderfooter['unicode'] : '';
                @endphp
                <td><input type="radio" class="unicode" name="unicode" value="1" @if($unicodeChecked == "yes") checked @endif></td>
                <td>Unicode (Hindi,Marathi,Urdu,Sanskirt etc.)</td>
            </tr>
        </table>
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <table>
            <tr>
                <td>
                    @if($fixheaderfooter)
                        <input type="checkbox" class="unicode-check" value="1" id="checkboxId" onclick="javascript:checkboxClickHandler()" @if($unicodeChecked == "yes") checked @endif>
                    @else
                        <input type="checkbox" class="unicode-check" value="1" id="checkboxId" onclick="javascript:checkboxClickHandler()">
                    @endif
                </td>
                <td><b>Enable Text Editor :</b></td>
                <td class="wd-50p">
                    <select id="languageDropDown" onchange="javascript:languageChangeHandler()" class="form-control input-sm"></select>
                </td>
            </tr>
        </table>
    </div>



    <div class="col-lg-12 p-0 mg-l-0 mg-t-5">
        <label class="col-9 p-0 m-0 font-weight-bold">Text Message <sup>*</sup> : <span class="badge badge-danger mg-r-4" style=" float:right; " id="sms-counter">SMS Count : (<span class="messages">0</span>) | Length : (<span class="length">0</span>)</span></label>
        <table class="container-fluid p-0 m-0">
            <tr>
                <td>
                    @php
                        $headerText = '';
                        $footerText = '';
                        $fixHeaderFooter = fixheaderfooterlist()->firstWhere('default_at', 'yes');
                        if ($fixHeaderFooter) {
                            $headerText = $fixHeaderFooter['header_text'];
                            $footerText = $fixHeaderFooter['footer_text'];
                        }
                    @endphp
                    <input type="text" id="header_text" name="text_header" placeholder="Enter SMS Header" value="{{ $headerText }}" class="col-12 form-control message">
                </td>
                <td class="wd-20p">
                    <span class="badge badge-dark cursor-pointer custom-model-btn pd-10" url="{{ url('MasterAdmin/Communication/ListHeaderAndFooter') }}" model-title="Header and Footer" model-class="modal-lg" model-title-info="Select Header and Footer">
                        <i class="fa fa-align-center"></i> Header and Footer
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea placeholder="Enter Message" name="text_message" id="text_message" class="form-control rounded-left message" style="height:125px;" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea placeholder="Enter SMS Footer" name="text_footer" id="footer_text" class="form-control tx-11 message" style="height:80px;">{{ $footerText }}</textarea>
                </td>
            </tr>
        </table>
    </div>


    <div class="col-lg-12 pd-l-0 pd-r-0 pd-t-5">
        <button type="button" class="btn btn-communication-cancel btn-outline-danger btn-lg">Clear <i
                class="fa fa-trash"></i></button>
        <button id="preview_btn" type="button" class="btn btn-primary float-right btn-lg">Preview <i
                class="fa fa-paper-plane"></i></button>
    </div>

    <div class="col-lg-12 p-0 m-0">

        <div class="table-responsive mg-t-25">
            <table class="table tx-11 table-bordered table-components">
                <thead class=" bg-light">
                <tr>
                    <th class="wd-30p"></th>
                    <th class="wd-70p"><b>Description</b></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-primary valign-middle"><b>1 characters.</b></td>
                    <td>
                        <b>For Text Message</b><br/>
                        1-160 characters = 1 SMS Credit.
                        161-306 characters = 2 SMS Credits.
                        307-459 characters = 3 SMS Credits.
                        and so on...
                    </td>
                </tr>
                <tr>
                    <td class="text-danger valign-middle"><b>1 SMS Credit(ss)</b></td>
                    <td><b>For Unicode Message</b><br/>
                        1-70 characters = 1 SMS Credit.
                        71-134 characters = 2 SMS Credits.
                        135-201 characters = 3 SMS Credits.
                        and so on...
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>


<div class="col-lg-4 pd-l-2 pd-r-2">

    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-10 mg-b-10">
        <button type="button" class="btn custom-model-btn btn-danger" url="{{url('MasterAdmin/Communication/SMSTemplate')}}" model-title="Select SMS Template" model-class="modal-lg" model-title-info="SMS Template ka " >Select SMS Template <i class="fa fa-comments"></i></button>
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-10 mg-b-10">
        <button type="button" class="btn custom-model-btn btn-warning" url="{{url('MasterAdmin/Communication/SMSTyping')}}" model-title="Unicode (Hindi/Other) Typing " model-class="modal-lg" model-title-info="Unicode (Hindi/Other) Typing ">Unicode (Hindi/Other) Typing <i class="fa fa-language"></i></button>
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-15 mg-t-0 mg-b-5">
        <label><b>Campaign Name :</b> <span class="text-gray">(Optional)</span></label>
        <input type="text" name="campaign_name" placeholder="Enter Campaign Name" class="form-control1 input-sm">
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-5 mg-b-5">
        <label><b> <input type="checkbox" name="phone_text" value="yes" checked> Phone Text Message </b><span class="text-gray">(Optional)</span> </label>
    </div>


    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-5 mg-b-5">
        <label><b> <input type="checkbox" name="mobile_app" value="yes" checked> Mobile App Notification </b><span class="text-gray">(Optional)</span> </label>
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-5 mg-b-5">
        <label><b> <input type="checkbox" name="website" value="yes" checked> Website Notification  </b> <span class="text-gray">(Optional)</span></label>
    </div>

    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-5 mg-b-5">
        <label><b>Message Type :</b> <span class="text-gray">(Optional)</span></label>
        <table>
            <tr>
                <td><input type="checkbox" name="message_type" checked></td><td>Text</td>
                <td class="pd-l-10"><input type="checkbox" name="message_type"></td><td>Flash</td>
            </tr>
        </table>
    </div>

    <div class="col-lg-12 p-0 m-0">
        <label><b>Message Schedule :</b> </label>
        <table>
            <tr>
                <td>Date :</td><td colspan="2" class="wd-40p">Time :</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="schedule_date" placeholder="dd-mm-yyyy" class="form-control1 date input-sm">
                </td>
                <td>
                    <select name="schedule_hours" class="form-control1 input-sm">
                        <option value="">HR</option>
                        @for($i=1;$i<=23;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
                <td>
                    <select name="schedule_minute" class="form-control1 input-sm">
                        <option value="">MIN</option>
                        @for($i=1;$i<60;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
        </table>
    </div>
<input type="hidden" id="total_receiver" value="1">
<input type="hidden" id="communication_balance" value="{{CommunicationBalance()}}">
    <div class="col-lg-12 pd-l-0 pd-r-10 mg-t-10 mg-b-10">
        <button type="button" class="btn btn-outline-success tx-15">Attachment File <i class="fa fa-paperclip"></i> <span class="tx-11">(Pdf,Xls,Txt,Doc,Png,Jpg,gif,Mp4,Mp3)</span>  </button>
    </div>

</div>

<link href="{{url('assets/javascript/sms_counter.js')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $("#preview_btn").click(function () {
        var header_text=$("#header_text").val();
        var text_message=$("#text_message").val();
        var footer_message=$("#footer_text").val();
        if(text_message==0){
            swal ("Oops","Please Enter Message","error" ).then(function() {
                swal.close();
                $("#text_message").focus();
            });
            return false;
        }
        if($(".studentid")){
            if($(".studentid").val()==0){
                swal ("Oops","Please Select Atleast One Student","error" ).then(function() {
                    swal.close();
                    $("#text_message").focus();
                });
                return false;
            }
        }
        loader('block');
        //get total receiver and communication balance details
        var communicationdetail=formrequest('form.communication', '{{url('/MasterAdmin/Communication/GetCommunicationInfo')}}', 'POST');
        var communicationdetail=$.parseJSON(communicationdetail);
        $("#total_receiver").val(communicationdetail['total_receiver']);
        $("#communication_balance").val(communicationdetail['communication_balance']);

        var message=header_text+"<br/>"+text_message+"<br/>"+footer_message;
        var SMScount=SmsCounter.count(message);
        if(SMScount['encoding']=="GSM_7BIT"){}else{}
        var unicode=$('.unicode:checked').val();
        if(unicode==0){var text_unicode="English";}else{var text_unicode="Unicode (Hindi,Marathi,Urdu,Sanskirt etc.)";}
        var total_receiver=$("#total_receiver").val();
        $(".msg").html(message);
        $(".comm_type").html($("#communication_type_id").find('option:selected').text());
        $(".total_receiver").html(total_receiver);
        $(".msg_unicode").html(text_unicode);
        $(".msg_count").html(SMScount['messages']);
        $(".msg_total_count").html((new Number(total_receiver)*(new Number(SMScount['messages']))));
        $("#smsPreview").modal('show');
        loader('none');
    });

    $(".btn-communication-cancel").click(function () {
        swal({
            title: "Are you sure?",
            text: "Are you sure want to clear all details.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
                if (willDelete) {
                   window.location.reload();
                } else {
                    return false;
                }
            });
    });
</script>

<script type="text/javascript">
    $(".unicode").click(function () {
        var unicode=$(this).val();
        if(unicode==0){
            $(".unicode-check").prop('checked',false);
        }else{
            $(".unicode-check").prop('checked',true);
        }
        checkboxClickHandler();
    });
    //if communication balance empty then fail sms alert
    $("form.communication").submit(function (){
        var total_receiver=new Number($("#total_receiver").val());
        var comm_bal=new Number($("#communication_balance").val());
        if(total_receiver>comm_bal){
            loader('none');
            swal("Message limit exceeded!", "Your account communication/message limit exceeded. please contact digi shiksha team.", "error");
            return false;
        }
        loader('block');
    });

    //text message counter
    $(function () {
        $('.message').countSms('#sms-counter');
    });
</script>


