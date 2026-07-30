<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExpiryDateValidationRule;

class CreateGeneratePaymentLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
            'gateway_id' => 'required',
            'link_title' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'expiry_date' => ['required','date', new ExpiryDateValidationRule()],
            'status' => 'nullable',
        ];
    }



    public function messages(): array
    {
        return [
            'gateway_id.required' => 'The gateway ID field is required.',
            'link_title.required' => 'The link title field is required.',
            'description.required' => 'The description field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'expiry_date.required' => 'The expiry date field is required.',
            'expiry_date.date' => 'The expiry date must be a valid date.',
        ];
    }
}
