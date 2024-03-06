@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="item_category_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="item_category_id" @endif >
    <option value="">---Select---</option>
    @foreach(libraryitemcategorylist() as $data)
        <option value="{{$data->id}}" @if((!isset($selectid))&&$data->default_at=="yes") selected @endif @if((isset($selectid))&&$data->id==$selectid) selected @endif >{{$data->item_category}}</option>
    @endforeach
</select>
