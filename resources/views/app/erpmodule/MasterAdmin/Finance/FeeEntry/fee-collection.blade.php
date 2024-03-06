@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Collection</li>
        </ol>
    </nav>
    <form class="feecollect_form" loader="off" onsubmit="return validateForm()" action="{{url('MasterAdmin/Finance/StudentFeeCollection')}}" method="POST" enctype="multipart/form-data"
           data-parsley-validate="" novalidate="">
        {{csrf_field()}}
     <input type="hidden" name="receiptgroupid" value="{{time()}}">
    <div class="row p-0 m-0 tx-12 ">
        <div class="col-lg-4 mx-auto pd-l-0 pd-r-5 m-0">
            @include('app.erpmodule.MasterAdmin.Finance.FeeEntry.Page.select-student')
        </div>
        @if(request()->route('studentid'))
            <div class="col-lg-8 bg-white bd-1 bd shadow-lg rounded-5 pd-l-0 pd-r-0 pd-t-0">
                @php $totalarr=collect(['subtotal'=>0,'concessiontotal'=>0,'finetotal'=>0,'excesstotal'=>0,'feepayable'=>0]); @endphp
                <div class="col-lg-12 pd-l-5 pd-r-5 rounded-3" style=" height:305px; overflow:auto; "><!-- max-height:285px;-->
                    @include('app.erpmodule.MasterAdmin.Finance.FeeEntry.Page.student-fee-summary-page')
                </div>
            </div>

            <div class="col-lg-12 p-0 mg-t-5 mg-b-0">
                @include('app.erpmodule.MasterAdmin.Finance.FeeEntry.Page.fee-collection-page')
            </div>
        @endif
        <input type="hidden" value="0" id="confirm_success">
    </div>
    </form>
    @if(Session::has('receipt_group_token_id'))
        <script type="text/javascript">
            $(document).ready(function (){
                var url="/MasterAdmin/Finance/Receipt/{{Session::get('receipt_id')}}/{{Session::get('receipt_group_token_id')}}/Print";
                window.open(url,'_blank');
                //send sms
                var result=formrequest('','/MasterAdmin/Communication/AfterQueryAutoSendSMS/fee-submit/{{Session::get('receipt_group_token_id')}}','GET',null,true);
            });
        </script>
    @endif
    <script type="text/javascript" url="{{asset('/assets/javascript/fee_collection.js')}}"></script>
    <script type="text/javascript" url="{{asset('/assets/javascript/fee_instalment.js')}}"></script>
    <script type="text/javascript" url="{{asset('/assets/javascript/module/finance/feecollection-special-concession.js')}}"></script>
    <script type="text/javascript">
        function validateForm() {
            var confirm_success=document.getElementById('confirm_success').value;
            if(confirm_success==0){
                $("#contine_fee_collect_confirm").click();
                return false;
            }
        }

        $("#student-search").click(function () {

            var ac_ledger_no=$("#ac_ledger_no").val();
            var admission_no=$("#admission_no").val();
            var fee_pay_upto_date=$("#fee_pay_upto_date").val();
            if((ac_ledger_no!=0)&&(fee_pay_upto_date!=0) ||(admission_no!=0)&&(fee_pay_upto_date!=0))
            {
              if(ac_ledger_no==""){ac_ledger_no=0;}
              if(admission_no==""){admission_no=0;}
             loader('block');
             CustomModelEvent('/MasterAdmin/Finance/SearchStudentList/'+ac_ledger_no+'/'+fee_pay_upto_date+'/'+admission_no,'Search Student','Search Student List','modal-lg');
             loader('none');
            }else {
                $("#ac_ledger_no").focus();
                $(".alert-msg").text("Please enter Ledger Number or Admission Number");
            }
        });

    </script>
@endsection
