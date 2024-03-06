<select  @if(isset($id)) id="{{$id}}" @else id="concession_type_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="concession_type_id" @endif>
    <option value="">---Select---</option>
    @foreach(concessiontypelist([]) as $data)
        <option value="{{$data->id}}"  @if(!isset($select)&&isset($selectid)&&($data->id==$selectid)) selected @elseif(isset($select)&&isset($selectid)&&($data->$select==$selectid)) selected @endif>{{$data->concession_type}}</option>
    @endforeach
</select>
