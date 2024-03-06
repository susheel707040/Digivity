@php
    if(!isset($search)){
      $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="question_category_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control1 input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="question_category_id" @endif >
    <option value="">---Select---</option>
    @foreach(onlineexamquestioncategorylist($search) as $data)
        <option value="{{$data->id}}" @if(!isset($selectid)&&($data->default==1)) selected @endif @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->question_category}}</option>
    @endforeach
</select>
