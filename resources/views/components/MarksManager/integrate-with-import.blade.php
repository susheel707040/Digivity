@php
    if(!isset($search)){
      $search=[];
    }
    $list=['none'=>'None','subject'=>'Subject','activities'=>'Category/Activities'];
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="integrate" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="integrate" @endif >
    @foreach($list as $key=>$value)
        <option value="{{$key}}" @if(isset($selectid)&&($selectid==$key)) selected @endif>{{$value}}</option>
    @endforeach
</select>
