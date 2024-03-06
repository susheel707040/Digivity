/**
 * alert auto hide after 8 second
 */
setTimeout(function () {
    $(".myAlert-right").hide();
},1000);
/**
 * date calender
 */
{/* <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> */}
$(document).ready(function () {
    'use strict'
    $('.date').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        yearRange: "c-100:c+0",
        buttonImage: "public/assets/images/datepicker.gif",
        buttonImageOnly: true
    });
});
//Select all checkbox
$("#CheckAll").click(function () {
    $(".checkBoxClass").prop('checked', $(this).prop('checked'));
});
//dynamical all checkbox checked
$(".CheckAll").click(function () {
    $("." + $(this).val()).prop('checked', $(this).prop('checked'));
});

//select drop search2 plugin
$(function() {
$('.select-search').select({
    placeholder: '---Select---',
    searchInputPlaceholder: 'Search'
});
});

//live date time in header main layout
function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
}

function display_ct() {
    let current_datetime = new Date()
    document.getElementById('date-time').innerHTML = "<i class='fa fa-calendar-day'></i>" + current_datetime.toDateString() + " <i class='fa fa-clock p-0'></i> " + current_datetime.toLocaleTimeString();
    display_c();
}

/**
 * custom modal show js
 */
$(".custom-model-btn").click(function () {
    var modelid = "#ModelData";
    var loadurl = $(this).attr("url");
    if (loadurl != 0) {
        $("#model-title").html($(this).attr('model-title'));
        $("#model-title-info").html($(this).attr('model-title-info'));
        $("#modal-dialog").removeClass("modal-lg modal-sm modal-xs");
        $("#modal-dialog").addClass($(this).attr('model-class'));
        $("#CustomModels").modal('show');
        modelgetpage(modelid, loadurl);
    } else {
        alert("Sorry, Url missing");
    }
});

function CustomModelEvent(loadurl,modeltitle,modeltitleinfo,modeladdclass) {
    var modelid = "#ModelData";
    if (loadurl != 0) {
        $("#model-title").html(modeltitle);
        $("#model-title-info").html(modeltitleinfo);
        $("#modal-dialog").removeClass("modal-lg modal-sm modal-xs");
        $("#modal-dialog").addClass(modeladdclass);
        $("#CustomModels").modal('show');
        modelgetpage(modelid, loadurl);
    } else {
        alert("Sorry, Url missing");
    }
}

function modelgetpage(modelid, loadurl) {
    $(modelid).html("<div class='text-center text-secondary mg-t-30'><div class='spinner-border text-primary'></div> <div class='tx-15 mg-l-10'><b>Please wait few seconds...</b></div></div>");
    $(modelid).load(loadurl, function (responseText, textStatus, XMLHttpRequest) {
            if (textStatus == "error") {
                $(modelid).html(responseText);
                $("form").submit(function (event) {
                    loader('block');
                });
            }
        }
    );

}

/**
 * remove action button confirm
 */
$(".BtnRemoveUrl").click(function () {
    var href = $(this).attr('href');
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this record.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            loader('block');
            window.location.assign(href);
        } else {
            loader('none');
            return false;
        }
    });
    return false;
});
/**
 * ancor tag click open loader
 */
$("a").click(function () {
    var href = $(this).attr('href');
    if (!$(this).attr('loader-disable')) {
        if (href.match("#") == null) {
            loader('block');
        }
    }
});

/*
open new tab function js
 */
function newTab(url) {
    window.open(url, '_blank');
}
