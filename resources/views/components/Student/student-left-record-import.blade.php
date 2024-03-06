@if (isset($student))
    @php
        $student_field_data = [
            'Admission No.' => isset($student->admission_no) ? $student->admission_no : '-',
            'Form/S.R. No.' => isset($student->form_no) ? $student->form_no : '-',
            'Course-Section' => $student->CourseSection(),
            'Student Name' => $student->FullName(),
            "Father's Name" => $student->FatherName(),
            "Mother's Name" => $student->MotherName(),
            'Contact No' => isset($student->student->contact_no) ? $student->student->contact_no : '-',
            'Address' => $student->Address(),
            'Transport' => isset($student->transport->id) ? $student->transport->route->route . ' - ' . $student->transport->routestop->route_stop . ' - ' . $student->transport->vehicle->registration_no . ' - ' . $student->transport->vehicle->vehicle_name : '-',
            // 'receipt_id' => $student->finance->store(),
        ];
    @endphp
    <div class="col-lg-12 bd">

        <center>
            <div class="avatar avatar-xxl"><img src="{{ url('uploads/student_profile_image/'. $student->profile_img)}}" class="rounded-circle" alt="">
            </div>
        </center>
        @foreach ($student_field_data as $field_name => $student_data)
            <div class="row bd-t pd-5">
                <div class="col-sm-4"><b>{{ $field_name }}:</b></div>
                <div class="col-sm-4">{{ $student_data ?? '-' }}</div>
            </div>
        @endforeach
    </div>
@endif
