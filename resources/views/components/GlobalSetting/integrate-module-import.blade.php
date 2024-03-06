@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="integrated_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="integrated_id" @endif >
    <option value="">---Select---</option>
    @foreach($integratedmodule as $key=>$data)
        <option value="{{$key}}" @if((isset($selectid))&&$key==$selectid) selected @endif>{{$data}}</option>
    @endforeach
</select>
