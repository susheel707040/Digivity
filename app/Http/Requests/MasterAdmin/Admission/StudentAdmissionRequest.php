<?php

namespace App\Http\Requests\MasterAdmin\Admission;

use Illuminate\Foundation\Http\FormRequest;

class StudentAdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admission_date' => ['required'],
            'admission_no' => ['required'],
            'form_no' => ['sometimes'],
            'roll_no' => ['sometimes'],
            'course_id' => ['required'],
            'section_id' => ['required'],
            'board_id' => ['sometimes'],
            'house_id' => ['sometimes'],
            'fee_concession_id' => ['sometimes'],
            'transport_id' => ['sometimes'],
            'hostel_id' => ['sometimes'],
            'admission_type_id' => ['sometimes'],
            'is_ewa' => ['sometimes'],
            'is_new' => ['sometimes'],
            'is_sibling' => ['sometimes'],
            'status' => ['sometimes'],
            'first_name' => ['required'],
            'middle_name' => ['sometimes'],
            'last_name' => ['sometimes'],
            'gender' => ['sometimes'],
            'dob' => ['sometimes'],
            'age' => ['sometimes'],
            'blood_group' => ['sometimes'],
            'category_id' => ['sometimes'],
            'nationality' => ['sometimes'],
            'religion' => ['sometimes'],
            'caste' => ['sometimes'],
            'parish' => ['sometimes'],
            'aadhar_card_no' => ['sometimes'],
            'birth_certificate_no' => ['sometimes'],
            'rfid_no' => ['sometimes'],
            'gps_tracking_no' => ['sometimes'],
            'father_name' => ['required'],
            'mother_name' => ['sometimes'],
            'local_guardian_name' => ['sometimes'],
            'contact_no' => ['required'],
            'email' => ['sometimes'],
            'emergency_mobile_no' => ['sometimes'],
            'residence_address' => ['sometimes'],
            'permanent_address' => ['sometimes'],
            'landmark' => ['sometimes'],
            'city' => ['sometimes'],
            'pin_code' => ['sometimes'],
            'state' => ['sometimes'],
            'father_mobile_no' => ['sometimes'],
            'father_email_id' => ['sometimes'],
            'father_qualification' => ['sometimes'],
            'father_annual_income' => ['sometimes'],
            'father_aadhar_card_no' => ['sometimes'],
            'father_profession' => ['sometimes'],
            'father_designation' => ['sometimes'],
            'father_organization_name' => ['sometimes'],
            'father_organization_address' => ['sometimes'],
            'father_organization_phone' => ['sometimes'],
            'parent_status' => ['sometimes'],
            'mother_mobile_no' => ['sometimes'],
            'mother_email_id' => ['sometimes'],
            'mother_qualification' => ['sometimes'],
            'mother_annual_income' => ['sometimes'],
            'mother_aadhar_card_no' => ['sometimes'],
            'mother_profession' => ['sometimes'],
            'mother_designation' => ['sometimes'],
            'mother_organization_name' => ['sometimes'],
            'mother_organization_address' => ['sometimes'],
            'mother_organization_phone' => ['sometimes'],
            'anniversary_date' => ['sometimes'],
            'local_guardian_relation' => ['sometimes'],
            'local_guardian_mobile_no' => ['sometimes'],
            'local_guardian_email_id' => ['sometimes'],
            'local_guardian_qualification' => ['sometimes'],
            'local_guardian_annual_income' => ['sometimes'],
            'local_guardian_aadhar_card_no' => ['sometimes'],
            'local_guardian_profession' => ['sometimes'],
            'local_guardian_designation' => ['sometimes'],
            'local_guardian_org_name' => ['sometimes'],
            'local_guardian_org_address' => ['sometimes'],
            'local_guardian_org_phone' => ['sometimes'],
            'school_name' => ['sometimes'],
            'board' => ['sometimes'],
            'class' => ['sometimes'],
            'year' => ['sometimes'],
            'percentage' => ['sometimes'],
            'stream_id' => ['sometimes'],
            'emergency_person_name' => ['sometimes'],
            'emergency_mobile_no'=>['sometimes'],
            'emergency_email_id' => ['sometimes'],
            'emg_address' => ['sometimes'],
            'emg_relation' => ['sometimes'],
            'staff_designation' => ['sometimes'],
            'staff_id' => ['sometimes'],
            'medical_history' => ['sometimes'],
            'allergie' => ['sometimes'],
            'family_doctor_name' => ['sometimes'],
            'family_doctor_phone' => ['sometimes'],
            'family_doctor_address' => ['sometimes'],
            'other_medical_info' => ['sometimes'],
            'document_id' => ['sometimes']

        ];
    }
}
