@php
    if(!isset($search)){
      $search=[];
    }
   $subject=collect(examsubjectlist($search))->groupBy('integrate');
@endphp
<select @if(isset($data)) {{$data}} @endif @if(isset($id)) id="{{$id}}" @else id="subject_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="subject_id" @endif @if(isset($multiple)) multiple="multiple" @endif>
   @if(!isset($multiple))
    <option value="">---Select---</option>
   @endif
       @foreach($subject as $key=>$subjectgrouplist)
           <optgroup label="{{ucwords($key)}}">

           @php
             $subjectgroup=collect($subjectgrouplist)->groupBy(function ($value){
             if($value->group_id){
                 return $value->subjectgroup->subject_name;
             }
             return "";
             });
           @endphp

          @foreach($subjectgroup as $key=>$subjectlist)

    @foreach($subjectlist as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&(in_array($data->id,explode(",",$selectid)))) selected @endif>@if($key) {{$key}} - @endif{{$data->subject_name}}</option>
    @endforeach

          @endforeach

           </optgroup>
       @endforeach
</select>
