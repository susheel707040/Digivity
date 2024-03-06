@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="transport_status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="transport_status" @endif >
    <option value="">---Select---</option>
    <option value="active" @if(isset($selectid)&&($selectid=="active")) selected @endif @if(!isset($selectid)) selected @endif>Active</option>
    <option value="inactive" @if(isset($selectid)&&($selectid=="inactive")) selected @endif>Deactive</option>
</select>
