@php
    if(!isset($search)){
      $search=[];
    }
    $entrymode=['issue'=>'Issue','renew'=>'Renew','return'=>'Return'];
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="entry_status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="entry_status" @endif >
    @if(isset($selectnull)) <option value="">---Select---</option>@endif
    @if(isset($all)) <option value="">All</option> @endif
    @foreach($entrymode as $key=>$value)
        <option value="{{$key}}" @if((isset($selectid))&&$key==$selectid) selected @endif >{{$value}}</option>
    @endforeach
</select>
