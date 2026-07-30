<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternationalSettlementRequest extends FormRequest
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
            'international_settlement' => 'required|in:Enable,Disable,Hold',
            'international_settlement_cycle' => 'required|string',
            'international_settlement_time' => 'required|string',
            'international_settlement_fee' => 'required|numeric|min:0',
            'gateway_id' => 'required|string',
            'user_id' => 'required|string',
        ];
    }
}
