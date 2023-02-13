<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:60',
            'email' => 'nullable|email|unique:users,email,'.auth()->id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'phone_number' => ['required',
                'regex:/^((013)|(014)|(015)|(016)|(017)|(018)|(019))[0-9]{8}/', 'digits:11',
                'unique:users,phone_number,'.auth()->id()]
            ];
    }
}
