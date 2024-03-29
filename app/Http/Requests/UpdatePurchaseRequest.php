<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
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
            'invoice' => 'required|unique:purchases,invoice_number,' . $this->purchase->id,
            'supplier_id' => 'required',
            'purchase_status' => 'required',
        ];

    }
}
