@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="racks" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="racks" @endif >
    <option value="">---Select---</option>
    @foreach(rackslist() as $data)
        <option value="{{$data->id}}" @if((isset($selectid))&&$data->id==$selectid) selected @endif >{{$data->racks}}</option>
    @endforeach
</select>
