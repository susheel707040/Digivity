@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="staff_type_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="staff_type_id" @endif >
    <option value="">---Select---</option>
    @foreach(stafftypelist() as $data)
        <option value="{{$data->id}}" @if((!isset($selectid))&&$data->default_at=="yes") selected @endif @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->staff_type}}</option>
    @endforeach
</select>
