<div class="col-lg-12 p-0">
    @foreach(smstemplatelist(['colsearch'=>['whereNull'=>'sms_type']]) as $data)
        <div class="col-lg-12 row  pd-l-0 pd-r-0 pd-b-10 m-0 nav-line">
            <div id="header-footer-id-2" class="col-9 tx-12 pd-t-10 bd-b-2">
                <h6 class="text-primary tx-13 pd-b-0 mg-b-0"><b>{{$data->template_name}}</b></h6>
                <p id="message-template-{{$data->id}}" class="pd-b-0 mg-b-0">{!! nl2br($data->template) !!}</p>

                @if($data->unicode=="yes")<span class="badge badge-success">Unicode</span>@endif <input type="hidden" class="unicode-id-{{$data->id}}" value="{{$data->unicode}}"><span class="badge badge-warning mg-l-10">Default</span></div>
            <div class="col-3 text-right">
            <button type="button" value="{{$data->id}}" class="btn btn-outline-primary mg-t-20 select-message-btn rounded-5 btn-xs"><i class="fa fa-check"></i> Select</button>
            </div>
        </div>
    @endforeach
</div>
<script type="text/javascript">
    $(".select-message-btn").click(function (){
        $("#text_message").val($("#message-template-"+$(this).val()).text());
        $("#CustomModels").modal('hide');
    });
</script>
