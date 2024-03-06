@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="blood_group" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="blood_group" @endif >
    <option value="">---Select---</option>
    @foreach($bloodgroup as $data)
        <option value="{{$data}}" @if(isset($selectid)&&$selectid==$data) selected @endif>{{$data}}</option>
    @endforeach
</select>
