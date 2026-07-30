<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GatewayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          
            'pg_name' => ['required', 'string', 'max:50', 'unique:gateways'],
            'pg_short_code' => ['required', 'string', 'max:10', 'unique:gateways'],
            'pg_client_key' => ['required', 'string', 'max:255'],
            'pg_secert_key' => ['required', 'string', 'max:255'],

        ];
    }


    public function messages(): array
{
    return [
        'gateway_name'=> 'The payment gateway already added.',
        'pg_name.required' => 'The payment gateway name is required.',
        'pg_name.unique' => 'The payment gateway name is already taken. Please choose a different one.',
        'pg_name.string' => 'The payment gateway name must be a string.',
        'pg_name.max' => 'The payment gateway name must not exceed 50 characters.',
        'pg_short_code.required' => 'The payment gateway short code is required.',
        'pg_short_code.unique' => 'The payment gateway short code is already taken. Please choose a different one.',
        'pg_short_code.string' => 'The payment gateway short code must be a string.',
        'pg_short_code.max' => 'The payment short code must not exceed 10 characters.',
        'pg_client_key.required' => 'The payment gateway client key is required.',
        'pg_secert_key.required' => 'The payment gateway secret key is required.',
    ];
}
}
