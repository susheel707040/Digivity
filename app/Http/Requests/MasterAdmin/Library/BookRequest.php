<?php

namespace App\Http\Requests\MasterAdmin\Library;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'library_id'=>['sometimes'],
            'item_category_id'=>['sometimes'],
            'racks'=>['sometimes'],
            'author_id'=>['sometimes'],
            'tag_id'=>['sometimes'],
            'genre_id'=>['sometimes'],
            'subject_id'=>['sometimes'],
            'book_no'=>['required'],
            'accession_no'=>['sometimes'],
            'ddc_no'=>['sometimes'],
            'barcode_no'=>['sometimes'],
            'book_title'=>['required'],
            'search_keyword'=>['sometimes'],
            'no_of_copy'=>['sometimes'],
            'pages'=>['sometimes'],
            'book_condition'=>['sometimes'],
            'issuable'=>['sometimes'],
            'edition'=>['sometimes'],
            'publisher'=>['sometimes'],
            'purchase_date'=>['sometimes'],
            'shelf_no'=>['sometimes'],
            'price'=>['sometimes'],
            'scan_copy'=>['sometimes'],
            'book_image'=>['sometimes'],
            'e_book_url'=>['sometimes'],
            'source'=>['sometimes'],
            'bill_no'=>['sometimes'],
            'bill_date'=>['sometimes'],
            'cost'=>['sometimes'],
            'topic'=>['sometimes'],
            'remark'=>['sometimes'],
            'status'=>['sometimes'],
            'current_issue'=>['sometimes']
        ];
    }
}
