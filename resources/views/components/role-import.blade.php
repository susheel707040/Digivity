@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="role_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="role_id" @endif >
    <option value="">--Select---</option>
    @foreach(rolelist() as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->name}}</option>
    @endforeach
</select>
