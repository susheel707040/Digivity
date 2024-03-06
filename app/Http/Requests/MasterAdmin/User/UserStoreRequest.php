<?php

namespace App\Http\Requests\MasterAdmin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'gender' => ['sometimes'],
            'dob' => ['sometimes'],
            'contact_no' => ['required'],
            'email' => ['sometimes'],
            'branches_id' => ['sometimes'],
            'two_fa_at' => ['required'],
            'active_at' => ['sometimes'],
            'role_id' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'retype_password' => ['required']
        ];
    }
}
