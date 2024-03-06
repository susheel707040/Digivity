@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="book_condition" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="book_condition" @endif >
    <option value="good">Good</option>
    <option value="damage">Damage</option>
    <option value="missing">Missing</option>
</select>
