<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePlanPostRequest extends Request
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
            'name' => 'required',
            'cups_amount' => 'required|numeric',
            'price_per_cup' => 'required|numeric',
            'discount' => 'required|numeric',
            'price' => 'required|numeric',
            'shipping_plan' => 'required',
            'featured_image' => 'image',
        ];
    }
}
