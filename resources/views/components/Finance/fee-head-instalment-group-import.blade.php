<select  @if(isset($id)) id="{{$id}}" @else id="instalment_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="instalment_id" @endif >
    <option value="">---Select---</option>
    @foreach(feeheadinstalmentgrouplist() as $data)
        <option {{$data->instalment_id}}>{{$data->print_name}}</option>
    @endforeach
</select>
