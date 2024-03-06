@php
    if(!isset($search)){
      $search=[];
    }
    $bookstatus=['active'=>'Active','inactive'=>'Inactive'];
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="book_status" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="book_status" @endif >
   @if(isset($selectnull)) <option value="">---Select---</option>@endif
    @foreach($bookstatus as $key=>$value)
        <option value="{{$key}}" @if((isset($selectid))&&$key==$selectid) selected @endif >{{$value}}</option>
    @endforeach
</select>
