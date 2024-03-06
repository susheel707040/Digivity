<div class="container pd-b-10">
    <div class="col-lg-12"></div>
    @foreach($question as $data)
        <div class="col-lg-12 tx-12 mg-t-10 mg-b-2"><b>{{$data->question}}</b> <span class="float-right"><b>({{substr($data->marks,0, -3)}})</b></span></div>
        @php
            $questioninput=[];
                try {
                 if(isset($data->question_input)){
                 $questioninput=unserialize($data->question_input);
                 }
                 }catch (\Exception $e){}
        @endphp

      @if($data->question_type=="objective")

          @if(isset($questioninput['option'])&&(is_array($questioninput['option'])))
          @foreach($questioninput['option'] as $key=>$option)
          <span class="pd-l-20 pd-t-5 pd-b-5">({{$questioninput['sl_no'][$key]}}). {{$option}}</span>
          @endforeach
          @endif

      @elseif($data->question_type=="match_tree")
          <div class="row m-0 ">
              <div class="col-6 pd-l-5">
              @if(isset($questioninput['mt_tree_1'])&&(is_array($questioninput['mt_tree_1'])))
                  @foreach($questioninput['mt_tree_1'] as $key=>$mtree)
                          <div class="col-lg-12 pd-b-10">({{$questioninput['mt_sl_no'][$key]}}). {{$mtree}}</div>
                  @endforeach
              @endif
             </div>
              <div class="col-6">
                  @if(isset($questioninput['mt_tree_2'])&&(is_array($questioninput['mt_tree_2'])))
                      @foreach($questioninput['mt_tree_2'] as $key=>$mtree)
                          <div class="col-lg-12 pd-b-10">{{$mtree}}</div>
                      @endforeach
                  @endif
              </div>
          </div>
      @endif

    @endforeach
</div>
