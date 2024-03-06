$(".special-concession").click(function (){
 loader('block');
 var studentid=$(this).attr('studentid');
 $("#CustomModels").modal("show");
 special_concession_model(studentid);
});

function special_concession_model(studentid){
    $("#modal-dialog").removeClass("modal-lg modal-sm modal-xs");
    $("#modal-dialog").addClass("modal-lg");
    $("#model-title").html("Special Concession");
    $("#model-title-info").html("Student Assign Special Concession");
    var result=formrequest('form.feecollect_form', '/MasterAdmin/Finance/AddSpecialConcession/'+studentid+'', 'POST');
    $("#ModelData").html(result);
    loader('none');

    $(".sc_concession").on("keyup",function (){
        var trackid=$(this).attr('trackid');
        if(new Number($(".sc_subtotal_" + trackid).val())>=new Number($(this).val())) {
            $(this).attr("oldval",$(this).val());
            $(".sc_balance_" + trackid).val((new Number($(".sc_subtotal_" + trackid).val()) + new Number($(".sc_latefee_" + trackid).val())) - new Number($(".sc_concession_" + trackid).val()));
        }else{
            $(this).val($(this).attr('oldval'));
        }
        specialconcessioncalculation();
    });

    $(".sc_latefee").on("keyup",function (){
        var trackid=$(this).attr('trackid');
        if(new Number($(this).val())>=0) {
            $(this).attr("oldval",$(this).val());
            $(".sc_balance_" + trackid).val((new Number($(".sc_subtotal_" + trackid).val()) + new Number($(".sc_latefee_" + trackid).val())) - new Number($(".sc_concession_" + trackid).val()));
        }else{
            $(this).val($(this).attr('oldval'));
        }
        specialconcessioncalculation();
    });



    function specialconcessioncalculation(){
        var concessionsum = 0;
        $(".sc_concession").each(function(){
            concessionsum += +$(this).val();
        });
        var latefeesum = 0;
        $(".sc_latefee").each(function(){
            latefeesum += +$(this).val();
        });
        var totalsum = 0;
        $(".sc_balance").each(function(){
            totalsum += +$(this).val();
        });
        $(".sc_concession_total").html(concessionsum);
        $(".sc_latefee_total").html(latefeesum);
        $(".sc_balance_total").html(totalsum);
    }

    //apply special concession
    $("#concession_apply_btn").click(function (){
        var sc_track_id = $(".sc_track_id").map(function () {
            return $(this).val();
        }).get().join(",");
        sc_track_id = sc_track_id.split(',');

        var sc_fee_copy_id = ['sc_concession_','sc_latefee_'];
        var sc_past_cpoy_id = ['i_f_i_c_','i_f_i_f_'];
        for (i = 0; i < sc_track_id.length; i++) {
            for (ii = 0; ii < sc_fee_copy_id.length; ii++) {
                if (($("." + sc_past_cpoy_id[ii] + "" + sc_track_id[i] + "")) && ($("." + sc_fee_copy_id[ii] + "" + sc_track_id[i] + ""))) {
                    $("." + sc_past_cpoy_id[ii] + "" + sc_track_id[i] + "").val(new Number($("." + sc_fee_copy_id[ii] + "" + sc_track_id[i] + "").val()));
                }
            }
        }
        fee_calculate_fn($(this).attr('studentid'));
        $("#CustomModels").modal("hide");
        $("#ModelData").html("");
    });

    //reset button apply
    $("#concession_reset_btn").click(function (){
        $("#ModelData").html("Please Wait...");
        var studentid=$(this).attr('studentid');
        $("#CustomModels").modal("show");
        special_concession_model(studentid);
    });

}


