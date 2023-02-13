<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'date' => 'required',

            'order_item_id' => 'required',
            'product_id'    => 'required',
            'quantity'      => 'required',
            'unit_price'    => 'required',
            'total_price'   => 'required',
            'discount'      => 'required',
            'sub_total'     => 'required',

            'grand_amount'      => 'required',
            'total_discount'    => 'required',
            'total_pre_due'     => 'required',
            'total_amount'      => 'required',
            'total_pay'         => 'required',
            'total_due'         => 'required',
        ];
    }
}
