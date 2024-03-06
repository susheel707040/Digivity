<?php

namespace App\Http\Requests\MasterAdmin\InApp;

use Illuminate\Foundation\Http\FormRequest;

class DownloadRequest extends FormRequest
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
            'type'=>['required'],
            'course_id'=>['sometimes'],
            'section_id'=>['sometimes'],
            'student_id'=>['sometimes'],
            'department_id'=>['sometimes'],
            'designation_id'=>['sometimes'],
            'staff_id'=>['sometimes'],
            'upload_date'=>['required'],
            'download_title'=>['required'],
            'download_details'=>['sometimes'],
            'file'=>['sometimes'],
            'show_app'=>['sometimes'],
            'show_website'=>['sometimes'],
            'status'=>['sometimes']
        ];
    }
}
