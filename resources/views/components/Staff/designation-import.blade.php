@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="designation_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="designation_id" @endif >
    <option value="">---Select---</option>
    @foreach(satffdesignationlist() as $data)
        <option value="{{$data->id}}" @if((!isset($selectid))&&$data->default_at=="yes") selected @endif @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->designation}}</option>
    @endforeach
</select>
