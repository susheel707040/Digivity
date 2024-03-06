@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="financial_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="financial_id" @endif >
    <option value="">---Select---</option>
    @foreach(financialyearlist() as $data)
        <option value="{{$data->id}}"
                @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->financial_session}}</option>
    @endforeach
</select>
