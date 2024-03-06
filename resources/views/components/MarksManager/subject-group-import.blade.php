@php
    if(!isset($search)){
      $search=[];
    }

@endphp
<select @if(isset($id)) id="{{$id}}" @else id="group_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="group_id" @endif >
    <option value="">---Select---</option>
    @foreach(examsubjectgrouplist() as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->subject_name}}</option>
    @endforeach
</select>
