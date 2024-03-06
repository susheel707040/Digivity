@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select  @if(isset($id)) id="{{$id}}" @else id="paymode_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="paymode_id" @endif >
    <option value="">---Select---</option>
    @foreach(paymodelist($search) as $data)
        <option value="{{$data->id}}"  @if(isset($selectid)&&($data->id==$selectid)) selected @endif @if(!isset($selectid)&&($data->default_at=="yes")) selected @endif>{{$data->paymode}}</option>
    @endforeach
</select>
