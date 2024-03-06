<?php

namespace App\Http\Requests\MasterAdmin\Transport\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class RouteStopRequest extends FormRequest
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
            'sequence'=> ['sometimes'],
            'stop_no' => ['sometimes'],
            'route_stop' => ['required'],
            'longitude' => ['sometimes'],
            'latitude' => ['sometimes'],
            'map_api_url' => ['sometimes'],
            'school_to_stop_distance' => ['sometimes'],
            'stop_to_school_distance' => ['sometimes'],
            'note' => ['sometimes']
        ];
    }
}
