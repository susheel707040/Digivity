@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="exam_term_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="exam_term_id" @endif
@if(isset($data))@foreach ($data as $key=>$value) data-{{$key}}="{{$value}}" @endforeach @endif >
    <option value="">---Select---</option>
    @foreach(examtermlist($search) as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->exam_term}}</option>
    @endforeach
</select>
