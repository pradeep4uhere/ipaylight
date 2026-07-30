<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserBankAccountUpdateRequest extends FormRequest
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
        $rule =  [
            'full_name_in_bank' => ['required', 'string', 'max:255'],
            'account_number'=> ['required', 'string'],
            'bank_name'=> ['required', 'string', 'min:3'],
            'bank_ifsc_code'=> ['required', 'string', 'size:11'],
            'cancle_cheque'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ];

        // Conditionally apply image validation rules if aadhar_front_pic and aadhar_back_pic are not already present
        if (!$this->has('hidden_cancle_cheque')) {
            $rules['cancle_cheque'] = 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;


    }
}
