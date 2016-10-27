<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DiscountRequest extends Request
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
            'code' => 'required',
            'limit' => 'required',
            'discount_type' => 'required',
            'take' => 'required|numeric',
            'discount_extra' => 'required',
            'discount_extra' => 'required',
            'discount_begins' => 'required',
            'discount_ends' => '',
        ];
    }
}
