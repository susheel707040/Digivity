@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="tag_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="tag_id" @endif >
    <option value="">---Select---</option>
    @foreach(taglist() as $data)
        <option value="{{$data->id}}" @if((isset($selectid))&&$data->id==$selectid) selected @endif >{{$data->tag}}</option>
    @endforeach
</select>
