@php
$integrate=['tc'=>'Transfer Certificate'];
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="integrate" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="integrate" @endif >
    <option value="">---Select---</option>
    @foreach($integrate as $key=>$value)
        <option value="{{$key}}" @if(isset($selectid)&&($key==$selectid)) selected @endif>{{$value}}</option>
    @endforeach
</select>
