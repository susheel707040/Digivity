@php
    if(!isset($search)){
      $search=[];
    }
    if((empty($search))&&(!count($search))){
        $search=[];
    }
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="subject_id" @endif @if(isset($class)) class="{{$class}}"
        @else class="form-control input-sm" @endif
        @if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="subject_id" @endif >
    <option value="">---Select---</option>
    @if(isset($subjectwithcourse))
        @foreach(subjectmapwithcourselist($search) as $data)
            <option value="{{$data->subject_id}}"
                    @if(isset($selectid)&&($data->subject_id==$selectid)) selected @endif>{{$data->subject->subject_name}}</option>
        @endforeach
    @else
        @foreach(subjectlist($search) as $data)
            <option value="{{$data->id}}"
                    @if(isset($selectid)&&($data->id==$selectid)) selected @endif>{{$data->subject_name}}</option>
        @endforeach
    @endif
</select>
