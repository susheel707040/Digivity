@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="religion" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="religion" @endif>
    <option value="">---Select---</option>
    @foreach(religionselectlist() as $data)
        <option value="{{$data->id}}" @if($data->default_at=="yes"&&(!isset($selectid))) selected @elseif((isset($selectid))&&$selectid==$data->id) selected @endif>{{$data->religion}}</option>
    @endforeach
</select>
