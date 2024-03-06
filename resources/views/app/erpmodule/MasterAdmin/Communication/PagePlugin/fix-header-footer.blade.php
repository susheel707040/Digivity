<div class="row p-0 m-0">
        @foreach(fixheaderfooterlist() as $data)
          <div class="col-lg-12 row  pd-l-0 pd-r-0 pd-b-10 m-0 nav-line">
          <div id="header-footer-id-{{$data->id}}" class="col-9 tx-12 pd-t-10 bd-b-2">
           <h6 class="text-primary pd-b-0 mg-b-0"><b>{{$data->title}}</b></h6>
              <p class="pd-b-0 mg-b-0"><b>Header : </b> <span class="header-id">{{$data->header_text}}</span></p>
              <p class="pd-b-0 mg-b-0"><b>Footer :</b> <span class="footer-id">{{$data->footer_text}}</span></p>
              @if($data->unicode=="yes")<span class="badge badge-success">Unicode</span><span class="unicode-id" hidden>1</span>@else <span class="unicode-id" hidden>0</span>@endif
              @if($data->default_at=="yes")<span class="badge badge-warning mg-l-10">Default</span>@endif
          </div>
            <div class="col-3 text-right">
                <button type="button" value="{{$data->id}}" class="btn btn-outline-primary mg-t-20 select-header-btn rounded-5 btn-xs"><i class="fa fa-check"></i> Select</button>
            </div>
          </div>
    @endforeach
</div>
<script type="text/javascript">
    $(".select-header-btn").click(function(){
      var hf_id=$(this).val();
      $("#header_text").val($("#header-footer-id-"+hf_id+" .header-id").text());
      $("#footer_text").val($("#header-footer-id-"+hf_id+" .footer-id").text());
      $("input[name=unicode][value=" + $("#header-footer-id-"+hf_id+" .unicode-id").text() + "]").prop('checked', true);
      if($("#header-footer-id-"+hf_id+" .unicode-id").text()==1){$(".unicode-check").prop('checked', true);}else{$(".unicode-check").prop('checked', false);}
      $("#CustomModels").modal('hide');
    });
</script>

