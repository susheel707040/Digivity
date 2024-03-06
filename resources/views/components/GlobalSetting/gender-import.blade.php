@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="gender" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="gender" @endif >
    <option value="">---Select---</option>
    @foreach($genderlist as $data)
        <option value="{{$data}}" @if(isset($selectid)&&($data==$selectid)) selected @endif>{{ucfirst($data)}}</option>
    @endforeach
</select>
