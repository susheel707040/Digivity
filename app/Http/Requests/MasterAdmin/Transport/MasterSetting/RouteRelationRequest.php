<?php

namespace App\Http\Requests\MasterAdmin\Transport\MasterSetting;

use Illuminate\Foundation\Http\FormRequest;

class RouteRelationRequest extends FormRequest
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
            'route_id'=>['required'],
            'route_stop_id'=>['required'],
            'vehicle_id'=>['sometimes'],
            'driver_id'=>['sometimes'],
            'morning_time'=>['sometimes'],
            'afternoon_time'=>['sometimes']
        ];
    }
}
