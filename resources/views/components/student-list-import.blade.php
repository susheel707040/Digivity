
<select @if(isset($id)) id="{{$id}}" @else id="student_id" @endif @if(isset($class)) class="{{$class}}" @else class="form-control select-search input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="student_id" @endif >
    <option value="0">---Select Student---</option>
    @foreach(studentshortlist([]) as $data)
        <option value="{{$data->student_id}}" @if(request()->route('studentid')==$data->student_id) selected @endif>
            {{$data->admission_no}} / <strong>{{ucfirst($data->fullName())}}</strong> / {{$data->CourseSection()}}
            / @if($data->student->gender=="male"){{"S/O"}}@elseif($data->student->gender=="female"){{"D/O"}}@endif {{$data->FatherName()}} / {{$data->student->contact_no}} </option>
    @endforeach
</select>
