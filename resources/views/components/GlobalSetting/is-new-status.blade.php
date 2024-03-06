@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select  @if(isset($id)) id="{{$id}}" @else id="is_new" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="is_new" @endif >

    @if(isset($selectnull))<option value="">---Select---</option>@endif
    @if(isset($all))<option value="">All</option>@endif

    @foreach(admissionisnewstatuslist([]) as $data)
        <option value="{{$data->alias}}" @if(isset($selectid)&&($selectid=="0") && ($data->default_at=="yes")) selected @endif @if(isset($selectid)&&($selectid!="0") && ($selectid==$data->alias)) selected @endif >{{ucfirst($data->admission_status)}}</option>
    @endforeach
</select>
