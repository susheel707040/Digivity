@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="document_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="document_id" @endif >
    <option value="">---Select---</option>
    @foreach((new \App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository())->studentdocumenttypelist() as $data)
    <option value="{{$data->id}}" @if(isset($selectid)&&($selectid==$data->id)) selected @endif>{{$data->document_type}}</option>
    @endforeach
</select>
