@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="academic_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="academic_id" @endif >
    <option value="">---Select---</option>
    @foreach(academicyearlist() as $data)
        <option value="{{$data->id}}"
                @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->academic_session}}</option>
    @endforeach
</select>
