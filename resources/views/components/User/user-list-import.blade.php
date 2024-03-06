@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="user_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="user_id" @endif >
    <option value="">--Select---</option>
    @foreach(userlist() as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->fullName()}} - {{$data->RoleName()}}</option>
    @endforeach
</select>
