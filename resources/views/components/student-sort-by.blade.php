@php
    $sorting_fields = [
        'first_name-asc' => 'Student Name Ascending Order',
        'first_name-desc' => 'Student Name Descending Order',
        'admission_no-asc' => 'Admission No. Ascending Order',
        'admission_no-desc' => 'Admission No. Descending Order',
        'roll_no-asc' => 'Roll No. Ascending Order',
        'roll_no-desc' => 'Roll No. Descending Order',
    ];
@endphp

<select @if (isset($id)) id="{{ $id }}" @else id="sort_by" @endif
    @if (isset($class)) class="{{ $class }}" @else class="form-control input-sm" @endif
    @if (isset($required)) {{ $required }} @endif
    @if (isset($name)) name="{{ $name }}" @else name="sort_by" @endif>
    @foreach ($sorting_fields as $sort_key => $sort_field)
        <option value="{{ $sort_key }}" @if (isset($selectid) && $sort_key == $selectid) selected @endif>{{ $sort_field }}
        </option>
    @endforeach
</select>
