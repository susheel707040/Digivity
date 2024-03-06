@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="title" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="title" @endif >
    @foreach($title_name as $data)
        <option value="{{$data}}" @if(isset($selectid)&&$selectid==$data) selected @endif>{{ucfirst($data)}}</option>
    @endforeach
</select>
