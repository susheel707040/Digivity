$(".fee_instalment").click(function () {
    fee_instalment($(this).attr('studentid'));
    fee_calculate_fn($(this).attr('studentid'));
});

function fee_instalment(studentid) {
    var trackid = $(".trackid").map(function () {
        return $(this).val();
    }).get().join(",");
    trackid = trackid.split(',');
    var fee_copy_id = ['f_i_', 'f_i_s_', 'f_i_p_', 'f_i_a_', 'f_i_c_', 'f_i_f_'];
    var past_cpoy_id = ['i_f_i_', 'i_f_i_s_', 'i_f_i_p_', 'i_f_i_a_', 'i_f_i_c_', 'i_f_i_f_'];
    for (i = 0; i < trackid.length; i++) {
        var instalmentid = $(".f_i_" + trackid[i]).map(function () {
            return $(this).val();
        }).get().join(",");
        instalmentid = instalmentid.split(',');
        for (ii = 0; ii < instalmentid.length; ii++) {
            for (iii = 0; iii < fee_copy_id.length; iii++) {
                if ($('.f_i_check_' + trackid[i] + "_" + instalmentid[ii]).is(':checked')) {
                    var fi_value = $("." + fee_copy_id[iii] + trackid[i] + "_" + instalmentid[ii]).val();
                } else {
                    var fi_value = "";
                }
                $("." + past_cpoy_id[iii] + trackid[i] + "_" + instalmentid[ii]).val(fi_value);
            }
        }
    }
}

function fee_calculate_fn(studentid) {
    var trackid = $(".trackid").map(function () {return $(this).val();}).get().join(",");
    trackid = trackid.split(',');
    var fee_copy_id = ['i_f_i_p_','i_f_i_a_','i_f_i_c_','i_f_i_f_'];
    var past_copy_id = ['f_print_','f_subtotal_','f_concession_','f_fine_'];
    for (i = 0; i < trackid.length; i++) {
        for(ii=0;ii<fee_copy_id.length;ii++)
        {
            if(ii==0){
                var feeprint=$("."+fee_copy_id[ii]+trackid[i]).map(function () {if($(this).val()){return $(this).val();}}).get().join(",");
                $("."+past_copy_id[ii]+trackid[i]).text(feeprint);
                if(feeprint){$(".f_qty_"+trackid[i]).text(feeprint.split(',').length); $(".fee_head_id_"+trackid[i]+"_check").prop('checked',true);}else{
                    $(".f_qty_"+trackid[i]).text('0'); $(".fee_head_id_"+trackid[i]+"_check").prop('checked',false);}
            }else{
                var total=0;
                $("."+fee_copy_id[ii]+trackid[i]).each(function(){total += +$(this).val();});
                $("."+past_copy_id[ii]+trackid[i]).text(total);
            }
        }
        $(".f_total_"+trackid[i]).text(new Number($(".f_subtotal_"+trackid[i]).text()-$(".f_concession_"+trackid[i]).text())+new Number($(".f_fine_"+trackid[i]).text()));
    }
    feetotal_fn(studentid);
}

function feetotal_fn(studentid)
{
    var copydata=['f_subtotal_','f_concession_','f_fine_','f_total_'];
    var pastedata=['subtotal_tx_','totalconcession_tx_','totalfine_tx_','totalpayable_tx_'];
    var trackid = $(".trackid").map(function () {return $(this).val();}).get().join(",");
    trackid = trackid.split(',');
    for (i = 0; i < 4; i++) {
        var total=0;
        $('.'+copydata[i]+studentid).each(function(){total +=+new Number($(this).text());});
        $("."+pastedata[i]+studentid).text(total.toFixed(2));
    }
    var copylastdata=['subtotal_tx','totalconcession_tx','totalfine_tx','totalpayable_tx'];
    var pastelastdata=['feesubtotal','feeconcessiontotal','feefinetotal','feepayable'];
    for(ii=0;ii<5;ii++)
    {
        var total=0;
        $('.'+copylastdata[ii]).each(function(){total +=+new Number($(this).text());});
        $("#"+pastelastdata[ii]).val(total);
    }
    //$("#paid_amt").val('');
    //$("#paid_amt").focus();
    $("#balance").val($("#feepayable").val()-$("#paid_amt").val());
}

//fee head id check remove fee instalment
$(".fee_head_id_check").click(function () {
$(".fee_instalment_"+$(this).attr('trackid')).prop('checked',$(this).prop('checked'))
    fee_instalment($(this).attr('studentid'));
    fee_calculate_fn($(this).attr('studentid'));
});


$("#paid_amt").on('keyup',function(){
   $("#balance").val($("#feepayable").val()-$(this).val());
   //instalmentauto();
});

function instalmentauto(){
    var paidamt=$("#paid_amt").val();
    $(".fee_instalment").prop('checked',false)
    $(".fee_instalment").sort(function(a, b) {
        return ($(b).data('position')) > ($(a).data('position')) ? -1 : 1;
    }).each(function() {
        if(paidamt>0){
            paidamt-=$(this).data('amount');
            $(this).prop('checked',true);
        }else
        if($(this).data('amount')==0){
            $(this).prop('checked',true);
        }
    });
    $(".studentids").each(function () {
        fee_instalment($(this).val())
        fee_calculate_fn($(this).val());
    });
}





