@php
    if(!isset($search)){
      $search=[];
    }
    $value=['ab'=>'AB','lv'=>'LV','ml'=>'ML']
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="exam_attend" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="exam_attend" @endif >
    <option value="p">P</option>
    @foreach ($value as $key=>$value)
    <option value="{{$key}}" @if($selectid==$key) selected @endif>{{$value}}</option>
    @endforeach
</select>
