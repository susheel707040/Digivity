<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookmarksLinkRequest extends FormRequest
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
            'ac_user_id'=>['required'],
            'bookmarks_category_id'=>['sometimes'],
            'position'=>['sometimes'],
            'icon'=>['sometimes'],
            'title'=>['required'],
            'alias'=>['sometimes'],
            'url'=>['required'],
            'open_window'=>['required'],
            'is_active'=>['required']
        ];
    }
}
