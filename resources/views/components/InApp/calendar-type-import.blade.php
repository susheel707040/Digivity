<select @if(isset($id)) id="{{$id}}" @else id="calendar_type_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="calendar_type_id" @endif>
    <option value="">---Select---</option>
    @foreach(calendartypelist([]) as $data)
        <option value="{{$data->id}}">{{$data->calendar_type}}</option>
    @endforeach
</select>
