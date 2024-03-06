@php
    if(!isset($search)){
      $search=['fee_custom'=>'no'];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="fee_head_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
        @if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="fee_head_id" @endif>
    <option value="">---Select---</option>
    @foreach(feeheadlist($search) as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->fee_head}}</option>
    @endforeach
</select>
