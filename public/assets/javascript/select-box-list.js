var previous;

$(".select-box").on('focus', function () {
    previous = this.value;
}).change(function () {
    var forid = $(this).data('for');

    $("#" + forid).empty();
    var ismultiple = $("#" + forid).attr('multiple');
    if (ismultiple != "multiple") {
        $("#" + forid).append("<option value=''>---Select---</option>");
    }
    if ($(this).val()) {

        // Check request ids
        var requestids = $(this).data('request_ids');
        var url_request = "";
        if (requestids) {
            var url_request = [];
            let string = requestids.split(',')
            var selectthis = this;
            $.each(string, function (key, value) {
                if ($("#" + value).val() == 0) {
                    $(selectthis).val(previous);
                    swal("Opps!", "Please select " + value.replace(/[_ ]+/g, " ").trim() + "!", "error");
                    $("#" + value).focus();
                    return false;
                }
                url_request.push("" + value + "=" + $("#" + value).val() + "");
            });
            url_request = "&" + url_request.join("&")
        }
        var url = "/GetSelectBoxDataList/" + $(this).data('get') + "?" + $(this).data('this_id') + "=" + $(this).val() + url_request;

        loader('block');
        formrequestajax('', url, 'GET').done(function (data) {
            var result = $.parseJSON(data);
            if (result) {
                $.each(result, function (key, value) {
                    $("#" + forid).append('<option value="' + key + '">' + value + '</option>');
                });
            } else {
                $("#" + forid).append("<option value=''>No Record Found!</option>");
            }
            if (ismultiple == "multiple") {
                $("#" + forid).multiselect('rebuild');
            }
            loader('none');
        }).fail(function (sender, message, details) {
            loader('none');
            swal("Opps!", "Sorry, something went wrong!", "error");
            return false;
        });
    }
});
