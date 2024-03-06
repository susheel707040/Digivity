<select @if(isset($id)) id="{{$id}}" @else id="staff_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control select-search input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="staff_id" @endif >
<option value="">---Select---</option>
@foreach(staffshortlist() as $data)
    <option value="{{$data->id}}" @if((isset($selectid)) && $selectid==$data->id) selected @endif>{{$data->staff_no}} - {{$data->fullName()}} ({{$data->contact_no}}) - {{$data->DesignationName()}}</option>
@endforeach
</select>
