@php
    if (!isset($search)) {
        $search = [];
    }
@endphp

<select @if (isset($id)) id="{{ $id }}" @else id="course_section_id" @endif
    @if (isset($class)) class="{{ $class }}" @else class="form-control input-sm" @endif
    @if (isset($required)) {{ $required }} @endif
    @if (isset($name)) name="{{ $name }}" @else name="course_section_id" @endif>
    <option value="">---Select---</option>
    @foreach (courselist($search) as $data)
        @foreach ($data->coursewithsection as $data1)
            @php $class_section_id=$data->id."@".$data1->section_id; @endphp
            <option value="{{ $class_section_id }}" @if ((isset($selectid) && $class_section_id == $selectid) || (isset($selectid) && $selectid == $data1->section_id)) selected @endif>{{ $data->course }}
                - {{ $data1->SectionName() }}</option>
        @endforeach
    @endforeach
</select>
