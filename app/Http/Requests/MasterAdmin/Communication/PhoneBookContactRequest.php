<?php

namespace App\Http\Requests\MasterAdmin\Communication;

use Illuminate\Foundation\Http\FormRequest;

class PhoneBookContactRequest extends FormRequest
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
            'group_id'=>['required'],
            'title'=>['sometimes'],
            'name'=>['required'],
            'gender'=>['sometimes'],
            'contact_no'=>['required'],
            'email'=>['sometimes'],
            'company'=>['sometimes'],
            'designation'=>['sometimes'],
            'status'=>['required']
        ];
    }
}
