@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="pagination" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="pagination" @endif >
    <option value="">---Select---</option>
    @php $paginationarray=['10','50','100','200','500','1000','2500','5000','10000','15000','20000','30000','50000','100000','150000','200000','500000','1000000'] @endphp
    @foreach($paginationarray as $key)
        <option value="{{$key}}" @if(!isset($selectid)&&isset($default)&&$default==$key) selected @endif @if(isset($selectid)&&$selectid==$key) selected @endif>{{$key}}</option>
    @endforeach
</select>
