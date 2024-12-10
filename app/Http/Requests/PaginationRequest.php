<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->getMethod() == 'GET') {
            return [
                'is_pagination' => 'boolean', // 0 => all , 1 pagination
                'per_page' => 'integer|min:1|max:500',
                'sort_key' => 'string|max:255|in:id,created_at,updated_at,order,date,name,distance,sub_total_price',
                'sort_order' => 'string|in:asc,desc',
                'is_active' => 'boolean',
                'search_key' => 'string|max:255',
//                'attributes'=> 'array',
//                'attributes.*.id'=> 'required|integer|exists:attributes,id',
//                'attributes.*.value'=> 'required|string',
                'lat'=>'numeric|between:-90,90',
                'long'=>'numeric|between:-180,180',
                'start_date'=>'date_format:Y-m-d',
                'end_date'=>'date_format:Y-m-d|after:start_date|required_with:start_date',
                'from'=>'date_format:Y-m-d',
                'to'=>'date_format:Y-m-d|after:from',
                'order_item_status_id'=>'integer|exists:order_item_statuses,id',
            ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
