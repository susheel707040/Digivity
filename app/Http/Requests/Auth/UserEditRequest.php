<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'academic_id' => ['required'],
            'financial_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['sometimes'],
            'gender' => ['required'],
            'dob' => ['sometimes'],
            'contact_no' => ['required'],
            'email' => ['required'],
            'profile_img' => ['sometimes'],
        ];
    }
}
