<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankAccountUpdateRequest extends FormRequest
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
            'full_name_in_bank' => ['required', 'string', 'max:255'],
            'account_number'=> ['required', 'string'],
            'bank_name'=> ['required', 'string', 'min:3'],
            'bank_ifsc_code'=> ['required', 'string', 'size:11']
        ];
    }
}
