<?php

namespace App\Http\Requests\MasterAdmin\Library;

use Illuminate\Foundation\Http\FormRequest;

class LibraryCategoryRequest extends FormRequest
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
            'item_category'=>['required'],
            'return_day'=>['required'],
            'default_at'=>['sometimes'],
            'sequence'=>['required']
        ];
    }
}
