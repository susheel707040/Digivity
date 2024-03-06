@php
    if (!isset($search)) {
        $search = [];
    }
@endphp
<select @if (isset($id)) id="{{ $id }}" @else id="section_id" @endif
    @if (isset($class)) class="{{ $class }}" @else class="form-control input-sm" @endif
    @if (isset($required)) {{ $required }} @endif
    @if (isset($name)) name="{{ $name }}" @else name="section_id" @endif
    data-parsley-error-message="Select Section">
    <option value="">---Select Course First---</option>
    @foreach (sectionlist($search) as $data)
         <option value="{{ $data->section->id }}" @if (isset($selectid) && $data->section->id == $selectid) selected @endif>
             {{ $data->section->section }}</option>
     @endforeach
</select>
