
$("body table.datatable tbody tr").click(function(){
var editurl=$(this).attr('editurl');
var deleteurl=$(this).attr('deleteurl');
$("table.datatable tbody tr").removeClass('tr_active');
$(this).addClass('tr_active');
$(".BtnRemoveUrl").attr("href",deleteurl);
$(".BtnEditUrl").val(editurl);
$(".btn-remove").prop('disabled', false);
$(".btn-edit").prop('disabled', false);
});

$(document).keyup(function(e) {
    if (e.key === "Escape") { // escape key maps to keycode 27
        $(".BtnRemoveUrl").attr("href","#");
        $(".BtnEditUrl").val("0");
        $("table.datatable tbody tr").removeClass('tr_active');
        $(".btn-remove").prop('disabled', true);
        $(".btn-edit").prop('disabled', true);
    }
});
