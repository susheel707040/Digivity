<?php

namespace App\Http\Requests\MasterAdmin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffRecordRequest extends FormRequest
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
            'joining_date'=>['required'],
            'staff_no'=>['required'],
            'date_of_retire'=>['sometimes'],
            'date_of_extend'=>['sometimes'],
            'profession_type_id'=>['sometimes'],
            'staff_type_id'=>['required'],
            'department_id'=>['required'],
            'designation_id'=>['required'],
            'show_in_transport'=>['required'],
            'transport_id'=>['sometimes'],
            'hostel_id'=>['sometimes'],
            'shift_id'=>['sometimes'],
            'integrated_id'=>['sometimes'],
            'title'=>['required'],
            'first_name'=>['required'],
            'middle_name'=>['sometimes'],
            'last_name'=>['sometimes'],
            'gender'=>['required'],
            'blood_group'=>['sometimes'],
            'dob'=>['sometimes'],
            'doa'=>['sometimes'],
            'nationality_id'=>['sometimes'],
            'religion_id'=>['sometimes'],
            'category_id'=>['sometimes'],
            'caste_id'=>['sometimes'],
            'parish_id'=>['sometimes'],
            'aadhaar_no'=>['sometimes'],
            'pan_no'=>['sometimes'],
            'license_no'=>['sometimes'],
            'passport_no'=>['sometimes'],
            'contact_no'=>['required'],
            'alt_mobile_no'=>['sometimes'],
            'email'=>['sometimes'],
            'father_name'=>['sometimes'],
            'mother_name'=>['sometimes'],
            'father_mobile_no'=>['sometimes'],
            'marital_status'=>['sometimes'],
            'spouse_name'=>['sometimes'],
            'spouse_mobile_no'=>['sometimes'],
            'residence_address'=>['sometimes'],
            'permanent_address'=>['sometimes'],
            'landmark'=>['sometimes'],
            'city'=>['sometimes'],
            'pincode'=>['sometimes'],
            'state'=>['sometimes'],
            'ex_year'=>['sometimes'],
            'ex_month'=>['sometimes'],
            'ex_day'=>['sometimes'],
            'ex_description'=>['sometimes'],
            'paymode_id'=>['sometimes'],
            'account_number'=>['sometimes'],
            'ifsc_code'=>['sometimes'],
            'bank_name'=>['sometimes'],
            'bank_location'=>['sometimes'],
            'generate_salary'=>['sometimes'],
            'salary_to_bank'=>['sometimes'],
            'gratuity_code'=>['sometimes'],
            'emp_status'=>['sometimes'],
            'pf_no'=>['sometimes'],
            'esi_no'=>['sometimes'],
            'uan_no'=>['sometimes'],
            'dispensary'=>['sometimes'],
            'nominee_name'=>['sometimes'],
            'nominee_relation'=>['sometimes'],
            'pension'=>['sometimes'],
            'machine_no'=>['sometimes'],
            'rfid_no'=>['sometimes'],
            'gps_no'=>['sometimes'],
            'attendance'=>['sometimes'],
        ];
    }
}
