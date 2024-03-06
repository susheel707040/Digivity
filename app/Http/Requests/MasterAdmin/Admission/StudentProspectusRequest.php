<?php

namespace App\Http\Requests\MasterAdmin\Admission;

use Illuminate\Foundation\Http\FormRequest;

class StudentProspectusRequest extends FormRequest
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
            'academic_id'=>['required'],
            'financial_id'=>['required'],
            'pros_no'=>['required'],
            'admission_date'=>['required'],
            'reference'=>['sometimes'],
            'admission_type_id'=>['required'],
            'course_id'=>['required'],
            'board_id'=>['sometimes'],
            'transport_id'=>['sometimes'],
            'first_name'=>['required'],
            'middle_name'=>['sometimes'],
            'last_name'=>['sometimes'],
            'gender'=>['required'],
            'dob'=>['sometimes'],
            'aadhar_no'=>['sometimes'],
            'father_name'=>['required'],
            'f_qualification'=>['sometimes'],
            'f_annual_income'=>['sometimes'],
            'mother_name'=>['sometimes'],
            'm_qualification'=>['sometimes'],
            'm_annual_income'=>['sometimes'],
            'person_name'=>['sometimes'],
            'mobile_no'=>['required'],
            'email_id'=>['sometimes'],
            'residence_address'=>['sometimes'],
            'permanent_address'=>['sometimes'],
            'landmark'=>['sometimes'],
            'city'=>['sometimes'],
            'pincode'=>['sometimes'],
            'state'=>['sometimes'],
            'profile_img'=>['sometimes'],
            'pay_status'=>['sometimes'],
            'payable_amt'=>['sometimes'],
            'paid_amt'=>['sometimes'],
            'user_id'=>['sometimes']
        ];
    }
}
