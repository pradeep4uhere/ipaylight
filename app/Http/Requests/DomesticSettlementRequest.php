<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomesticSettlementRequest extends FormRequest
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
            'domestic_settlement' => 'required|in:Enable,Disable,Hold',
            'domestic_settlement_cycle' => 'required|string',
            'domestic_settlement_time' => 'required|string',
            'domestic_settlement_fee' => 'required|numeric|min:0',
            'gateway_id' => 'required|string',
            'user_id' => 'required|string',
        ];
    }
}
