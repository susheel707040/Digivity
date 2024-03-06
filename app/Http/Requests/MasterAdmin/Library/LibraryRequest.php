<?php

namespace App\Http\Requests\MasterAdmin\Library;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
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
            'library_name'=>['required'],
            'alias'=>['sometimes'],
            'address'=>['sometimes'],
            'incharge'=>['sometimes'],
            'description'=>['sometimes'],
            'default_at'=>['sometimes']
        ];
    }
}
