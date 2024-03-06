function formrequest(formid, formAction = null, formMethod = null,formData=null,Async=null) {
    loader('block');
    // Ajax for our form
    if(formData==null || formData==0) {
        var form = $(formid)[0];
        var formData = new FormData(form);
    }else{
        var formloaddata=formData;
        var formData = new FormData();
        $.each(formloaddata,function (key,value){
            formData.append(key,value);
        })
    }

    if(formAction==null || formAction==0) {
        var formAction = $(formid).attr('action'); // form handler url
    }
    if (formMethod == null || formMethod==0) {
        var formMethod = $(formid).attr('method'); // GET, POST
    }
    if(Async==null || Async==0){
        Async=false;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Methods': '*',
            "Access-Control-Allow-Credentials": true,
            "Access-Control-Allow-Headers" : "Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization",
            "X-Requested-With": 'XMLHttpRequest',
            "Access-Control-Allow-Origin": "*",
            "Control-Allow-Origin": "*",
            "cache-control": "no-cache"
        }
    });

    var result="";
    //create a return array
    $.ajax({
        type: formMethod,
        enctype: 'multipart/form-data',
        url: formAction,
        data: formData,
        dataType : 'text',
        async:Async,
        processData: false,
        contentType: false,
        crossDomain: true,
        crossOrigin: true,
        cache: false,
        timeout: 600000,
        beforeSend: function () {
            console.log(formData);
        },
        success: function (data) {
            console.log('ok');
            console.log(data);
            //add the result to the returnb array
            result = data;
            loader('none');
        },
        error: function (data) {
            console.log(data);
            loader('none');
        }
    });
    return result;
}


formrequestajax=function (formid, formAction = null, formMethod = null,formData=null,Async=null) {
    // Ajax for our form
    if(formData==null || formData==0) {
        var form = $(formid)[0];
        var formData = new FormData(form);
    }else{
        var formloaddata=formData;
        var formData = new FormData();
        $.each(formloaddata,function (key,value){
            formData.append(key,value);
        })
    }

    if(formAction==null || formAction==0) {
        var formAction = $(formid).attr('action'); // form handler url
    }
    if (formMethod == null || formMethod==0) {
        var formMethod = $(formid).attr('method'); // GET, POST
    }
    if(Async==null || Async==0){
        Async=true;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Methods': '*',
            "Access-Control-Allow-Credentials": true,
            "Access-Control-Allow-Headers" : "Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type, Accept, Authorization",
            "X-Requested-With": 'XMLHttpRequest',
            "Access-Control-Allow-Origin": "*",
            "Control-Allow-Origin": "*",
            "cache-control": "no-cache"
        }
    });

    //create a return array
    return $.ajax({
        type: formMethod,
        enctype: 'multipart/form-data',
        url: formAction,
        data: formData,
        dataType : 'text',
        async:Async,
        processData: false,
        contentType: false,
        crossDomain: true,
        crossOrigin: true,
        cache: false,
        timeout: 600000
    });
}

