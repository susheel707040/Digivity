@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select  @if(isset($id)) id="{{$id}}" @else id="parent_status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="parent_status" @endif >
    <option value="">---Select---</option>
    @foreach(parentstatuslist($search) as $data)
        <option value="{{$data->id}}" @if((!isset($selectid))&&$data->default_at=="yes") selected @endif @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->parent_status}}</option>
    @endforeach
</select>
