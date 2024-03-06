@php
if(!isset($length)){
 $length=100;
}
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="position" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="position" @endif >
    @for($i=1;$i<=$length;$i++)
        <option value="{{$i}}" @if(isset($selectid)&&($selectid==$i)) selected @endif>{{$i}}</option>
    @endfor
</select>
