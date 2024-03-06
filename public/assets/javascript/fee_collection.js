//student select for fee payment
$("#student_id").on("change",function(){
    loader('block');
    if($(this).val()!=0){
        window.location.assign('/MasterAdmin/Finance/FeeCollection/'+$(this).val()+'/'+$("#fee_pay_upto_date").val()+'/'+$("#select_pay_fee").val()+'/search');
        return false;
    }
    window.location.assign('/MasterAdmin/Finance/FeeCollection');
});



$("#select_pay_fee").on("change",function(){
    var studentid=$("#student_id").val();
    if(studentid==0){
        swal("Opps!", "Please first Select Student!", "error");
        $("#select_pay_fee").val("0");
        return false;
    }else{
        if($(this).val()!=0){
            window.location.assign('/MasterAdmin/Finance/FeeCollection/'+studentid+'/'+$("#fee_pay_upto_date").val()+'/'+$(this).val()+'/search');
            return false;
        }
    }
    window.location.assign('/MasterAdmin/Finance/FeeCollection');
});

$('.feecollect_form').submit(function(e) {
    if ($("#confirm_success").val()==0) {
        return false;
    }
});

$("#contine_fee_collect_confirm").click(function () {

    loader('none');
    var permission=0;
    var paidamount=$("#paid_amt").val();

    if($("#paymode_id").val()==0){
        swal("Opps!", "Please first select paymode!", "error");
        $("#paymode_id").focus();
        return false;
    }else
    if(paidamount==""||paidamount==0) {
        permission=1;
        swal({
            title: "Are you sure?",
            text: "Are you sure want to collect zero (0) amount.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    permission=0;
                    feecollectionconfrim(permission);
                }
            });
    }
    feecollectionconfrim(permission);
});



$(".cancel-fee-collect").click(function () {
    $("#confirm_success").val('0');
});

$(document).keyup(function(e) {
    if (e.key === "Escape") { // escape key maps to keycode `27`
        $("#confirm_success").val('0');
    }
    if (e.key === "Enter") {
        var confirm_success=document.getElementById('confirm_success').value;
        if(confirm_success==0) {
            $("#contine_fee_collect_confirm").click();
            return false;
        }else{
            $("#collect-btn-fee").click();
        }
    }
});



//fee collection pop up function
function feecollectionconfrim(permission){
    if(permission==0) {
        $("#confirm_success").val('1');
        var studentid = $(".studentids").map(function () {
            return $(this).val();
        }).get().join(",");
        studentid = studentid.split(',');
        var paid_amt = new Number($("#paid_amt").val());
        $(".cnf_paid_amt").text(paid_amt.toFixed(2));
        var copydata = ['subtotal_tx_', 'totalconcession_tx_', 'totalfine_tx_', 'excess_tx_', 'totalpayable_tx_'];
        var pastedata = ['confirm_subtotal_', 'confirm_concessiontotal_', 'confirm_finetotal_', 'confirm_excess_', 'confirm_feepayable_'];
        for (i = 0; i < studentid.length; i++) {
            //student check disable
            $(".select_student_pay_" + studentid[i]).prop('checked', false);

            for (ii = 0; ii < copydata.length; ii++) {
                $("." + pastedata[ii] + studentid[i]).text($("." + copydata[ii] + studentid[i] + ":last").text());
            }
            $(".confirm_student_name_" + studentid[i]).text($(".student_name_" + studentid[i]).text() + "(" + $(".course_name_" + studentid[i]).text() + ")");
            var studentpayable = new Number($(".totalpayable_tx_" + studentid[i] + ":first").text());
            var studentpaidamt = 0;
            var studentbal = 0;
            if (studentpayable <= paid_amt) {
                studentpaidamt = studentpayable;
                paid_amt -= studentpayable;
                studentbal = 0;
            } else {
                studentpaidamt = (paid_amt);
                studentbal = (studentpayable - paid_amt);
                paid_amt -= paid_amt;
            }
            //if student paid then check input checkbox
            if(studentpaidamt>0) {
                $(".select_student_pay_" + studentid[i]).prop('checked', true);
            }
            $(".confirm_balance_" + studentid[i]).text(studentbal.toFixed(2));
            $(".student_" + studentid[i] + "_paid_amt ").val(studentpaidamt);
        }
        if (paid_amt > 0) {
            var last_student_id = studentid[studentid.length - 1];
            $(".student_" + last_student_id + "_paid_amt").val(new Number($(".student_" + last_student_id + "_paid_amt").val()) + new Number(paid_amt));
            $(".confirm_balance_" + last_student_id).text(new Number($(".totalpayable_tx_" + last_student_id + ":first").text()) - new Number($(".student_" + last_student_id + "_paid_amt").val()));
        }
        $(".cnf_subtotal").text(new Number($("#feesubtotal").val()).toFixed(2));
        $(".cnf_concessiontotal").text(new Number($("#feeconcessiontotal").val()).toFixed(2));
        $(".cnf_finetotal").text(new Number($("#feefinetotal").val()).toFixed(2));
        $('.cnf_excesstotal').text(new Number($("#feeexcesstotal").val()).toFixed(2));
        $('.cnf_payabletotal').text(new Number($("#feepayable").val()).toFixed(2));
        $(".cnf_bal").text(new Number($("#feepayable").val() - $("#paid_amt").val()).toFixed(2))
        $("#CollectionConfirm").modal('show');
        $("#collect-btn-fee").focus();
    }
}


$(".student_amount_change").on('keyup',function () {
    var studentid=$(this).attr('studentid');
//student check disable
    $(".select_student_pay_"+studentid).prop('checked', false);
    if($(this).val()>0){
        $(".select_student_pay_"+studentid).prop('checked', true);
    }
    var studentpayable=new Number($(".totalpayable_tx_"+studentid+":first").text());
    $(".confirm_balance_"+studentid).text(studentpayable-$(this).val());
    var totalcollect=0;
    $(".student_amount_change").each(function(){totalcollect += +$(this).val();});
    $("#paid_amt").val(totalcollect);
    $(".cnf_paid_amt").text(totalcollect.toFixed(2));
    var studentbal=new Number($("#feepayable").val())-new Number($("#paid_amt").val());
    $(".cnf_bal").text(studentbal.toFixed(2));
    $("#balance").val(studentbal);
});

$("#ac_ledger_no").on('keyup',function () {
    $("#admission_no").val('');
});
$("#admission_no").on('keyup',function () {
    $("#ac_ledger_no").val('');
});

//special fee concession
$(".special_concession").click(function(){
    var studentid=$(this).attr('studentid');
    var trackid=$(".student_"+studentid+"_track_id").val();
    $("#model-title").html("Add Receipt Special Discount");
    $("#model-title-info").html("Student Receipt Special Discount");
    $("#modal-dialog").removeClass("modal-lg modal-sm modal-xs");
    $("#modal-dialog").addClass($(this).attr('model-class'));
    $("#ModelData").html();
    $("#CustomModels").modal('show');
});

$(function () {
    'use strict'
    $('#fee_pay_upto_date').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        onSelect: function(dateText, inst) {
            if($("#student_id").val()!=0) {
                loader('block');
                window.location.assign("/MasterAdmin/Finance/FeeCollection/"+$("#student_id").val()+"/"+dateText+"/"+$("#select_pay_fee").val()+"/search");
            }else{
                alert("Please first select student");
                return false;
            }

        }
    });
});

//full year fee estimate
$("#complete_fee").click(function(){
    loader('block');
    if($(this).is(':checked')){
        $("#fee_pay_upto_date").val($(this).val());
    }else{
        $("#fee_pay_upto_date").val($(this).attr('todaydate'));
    }
    window.location.assign('/MasterAdmin/Finance/FeeCollection/'+$("#student_id").val()+'/'+$("#fee_pay_upto_date").val()+'/'+$("#select_pay_fee").val()+'/search');
});

//fee collection form submit validation
$("form.feecollect_form").submit(function () {
    loader('none');
    var student= $(".select_student_pay_id:checked").map(function () {
        return $(this).val();
    }).get().join(",");
    if(student==0){
        swal({
            title: "Select Student!",
            text: "Please select atleast one student for fee payment",
            icon: "error",
            button: "Ok",
        });
        return false;
    }
    loader('block');
});






