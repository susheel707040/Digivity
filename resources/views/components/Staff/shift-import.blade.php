@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="shift_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="shift_id" @endif >
    <option value="">---Select---</option>
</select>
