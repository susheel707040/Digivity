<select  @if(isset($id)) id="{{$id}}" @else id="fee_head_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="fee_head_id" @endif >
    <option value="">---Select---</option>
    @foreach(feeheadlist(['fee_custom'=>'yes']) as $data)
        <option value="{{$data->id}}">{{$data->fee_head}}</option>
    @endforeach
</select>
