<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'market_type_id'    => 'required',
            'name'              => 'required|min:3|max:60',
            'title'             => 'max:100',
            'phone'             => ['required', 'regex:/^((013)|(014)|(015)|(016)|(017)|(018)|(019))[0-9]{8}/', 'digits:11', 'unique:suppliers'],
            'address'           => 'max:150'
        ];
    }
}
