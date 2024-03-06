@php
    if(!isset($search)){
      $search=[];
    }
    $valuearr=['m'=>'Marking Entry','g'=>'Grade Entry']
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="marking_type" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="marking_type" @endif >
    <option value="">---Select---</option>
    @foreach($valuearr as $key=>$value)
        <option value="{{$key}}" @if(isset($selectid)&&($key==$selectid)) selected @endif>{{$value}}</option>
    @endforeach
</select>
