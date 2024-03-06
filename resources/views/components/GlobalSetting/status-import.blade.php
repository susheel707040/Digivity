@php
    if(!isset($search)){
      $search=[];
    }
    $status = array ('active'=>'Active','inactive'=>'Inactive');
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="status" @endif >

    @if(isset($all)) <option value="">All</option> @else <option value="">---Select---</option> @endif
    @foreach($status as $value=>$key)
        <option value="{{$value}}" @if(isset($selectid)&&($value==$selectid)) selected @endif @if((!isset($selectid))&&($value=="active")) selected @endif>{{ucfirst($key)}}</option>
    @endforeach
</select>
