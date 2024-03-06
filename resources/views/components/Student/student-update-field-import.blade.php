@php
    if (!isset($search)) {
        $search = [];
    }
    $student_record_field_arr = [
        'admission_date' => 'Admission Date',
        'admission_no' => 'Admission Number',
        'form_no' => 'Form Number',
        'roll_no' => 'Roll Number',
        'course_id' => 'Class/Course',
        'section_id' => 'Section',
        'board_id' => 'Board',
        'house_id' => 'House',
        'stream_id' => 'Stream',
        'first_name' => 'Student Name',
        'middle_name' => 'Middle Name',
        'last_name' => 'Last Name',
        'gender' => 'Gender',
        // 'dob' => 'Date of Birth',
        'blood_group' => 'Blood Group',
        'nationality' => 'Nationality',
        'religion' => 'Religion',
        'caste' => 'Caste',
        'parish' => 'Parish',
        // 'aadhar_card_no' => 'Aadhar Card Number',
        'birth_certificate_no' => 'Birth Certificate Number',
        'rfid_no' => 'RFID Number',
        'gps_tracking_no' => 'GPS Tracking Number',
        'contact_no' => 'Contact Number',
        'email' => 'Email',
        'ac_ledger_no' => 'AC Ledger Number',
        'admission_type_id' => 'Admission Type',
        'category_id' => 'Category',
        'fee_concession_id' => 'Fee Concesstion',
        'transport_start_date' => 'Transport Start Date',
        'transport_id' => 'Transport Assign',
        'transport_status' => 'Transport Status',
        'transport_stop_date' => 'Transport Stop Date',
        'hostel_id' => 'Hostel',
        'is_ewa' => 'Is EWA',
        'is_new' => 'Student Type (New/Old)',
        'status' => 'Student Status (Active/Inactive)',
        'inactive_date' => 'Student Inactive Date',
        // 'father_photo' => 'Father Photo',
        // 'mother_photo' => 'Mother Photo',
        // 'local_guardian_photo' => 'Local Guardian Photo',
        // 'profile_img' => 'Student Photo',
    ];
@endphp

@if (isset($multiselect) && $multiselect)
    <select @if (isset($id)) id="{{ $id }}" @else id="field_id" @endif
        @if (isset($class)) class="{{ $class }}" @else class="form-control select2 select-search" multiple="multiple" @endif
        @if (isset($required)) {{ $required }} @endif
        @if (isset($name)) name="{{ $name }}" @else name="field_id[]" @endif
        data-parsley-error-message="Select at-least one field">
        <option value="">---Select---</option>
        @foreach ($student_record_field_arr as $field_key => $field_name)
            <option value="{{ $field_key }}" @if (isset($selectid) && in_array($field_key, $selectid)) selected @endif>{{ $field_name }}
            </option>
        @endforeach

    </select>
@else
    <select @if (isset($id)) id="{{ $id }}" @else id="field_id" @endif
        @if (isset($class)) class="{{ $class }}" @else class="form-control input-sm" @endif
        @if (isset($required)) {{ $required }} @endif
        @if (isset($name)) name="{{ $name }}" @else name="field_id" @endif
        data-parsley-error-message="Select at-least Select field">
        <option value="">---Select---</option>
        @foreach ($student_record_field_arr as $field_key => $field_name)
            <option value="{{ $field_key }}" @if (isset($selectid) && $field_key == $selectid) selected @endif>{{ $field_name }}
            </option>
        @endforeach
    </select>
@endif
