<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdateBusiness extends FormRequest
{
    public $name, $address, $description, $business;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($business)
    {
        return [

            'name' => 'required|string|min:3|max:20',
            'address' => 'required|string|min:3|max:80',
            'description' => 'min:3'
        ];
    }


    // mensajes
    public function messages()
    {
        return [

            'name.required' => 'The name field is required',
            'address.required' => 'The address field is required',
            'name.min' => 'The name field must contain at least 3 characters',
            'address.min' => 'The address field must contain at least 3 characters',

        ];
    }
}
