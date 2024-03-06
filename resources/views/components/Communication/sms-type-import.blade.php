@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="sms_type" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="sms_type" @endif>
    <option value="">---Select---</option>
    @foreach(\App\Helper\SMSTypeList::getlist() as $key=>$value)
        <option value="{{$key}}" @if(isset($selectid)&&($selectid==$key)) selected @endif>{{$value}}</option>
    @endforeach
</select>
