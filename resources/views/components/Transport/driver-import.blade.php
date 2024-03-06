@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="driver_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="driver_id" @endif >
    <option value="" @if(isset($selectid)&&($data->id==$selectid)) selected @endif>---Select---</option>
</select>
