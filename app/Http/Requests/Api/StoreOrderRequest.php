<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'address.name' => ['required', 'string', 'max:255'],
            'address.phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:11'],
            'address.city' => ['required', 'string'],
            'address.address' => ['required', 'string'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'address.name' => 'Name',
            'address.phone' => 'Mobile Number',
            'address.city' => 'City',
            'address.address' => 'Address',
        ];
    }
}
