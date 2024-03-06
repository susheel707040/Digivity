@php $receiptstatus=['paid'=>'Paid','unpaid'=>'Unpaid','cancel'=>'Cancel'] @endphp
<select  @if(isset($id)) id="{{$id}}" @else id="receipt_status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="receipt_status" @endif >
    <option value="">---Select---</option>
    @foreach($receiptstatus as $id=>$value)
        <option value="{{$id}}"  @if(isset($selectid)&&($id==$selectid)) selected @endif>{{$value}}</option>
    @endforeach
</select>

