@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select  @if(isset($id)) id="{{$id}}" @else id="is_new" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="admission_category" @endif >

    @if(isset($selectnull))<option value="">---Select---</option>@endif
    @if(isset($all))<option value="">All</option>@endif

    @foreach(admissiontypeselectlist([]) as $data)
        <option value="{{$data->id}}" @if(isset($selectid)&&($selectid=="0") && ($data->default_at=="yes")) selected @endif @if(isset($selectid)&&($selectid!="0") && ($selectid==$data->id)) selected @endif >{{ucfirst($data->admission_type)}}</option>
    @endforeach
</select>
