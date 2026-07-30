<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBeneficiaryAccountRequest extends FormRequest
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
        // return [
        //     'user_contact_id' => ['required', 'exists:user_contacts,id'],
        //     'beneficiary_name' => ['required', 'string', 'max:255'],
        //     'account_number' => ['required', 'string', 'unique:beneficiary_accounts,account_number'],
        //     'bank_name' => ['required', 'string', 'max:255'],
        //     'ifsc_code' => ['required', 'string', 'size:11'],
        // ];
        return [
            'user_contact_id' => ['required', 'exists:user_contacts,id'],
            'beneficiary_name' => ['required', 'string', 'max:255'],
            'account_number' => [
                'required',
                'string',
                Rule::unique('beneficiary_accounts')->where(function ($query) {
                    return $query->where('user_contact_id', $this->input('user_contact_id'));
                })
            ],
            'bank_name' => ['required', 'string', 'max:255'],
            'ifsc_code' => ['required', 'string', 'size:11'],
        ];
    }
}
