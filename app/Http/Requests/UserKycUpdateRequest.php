<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserKycUpdateRequest extends FormRequest
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

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'aadhar_card_number' => ['required', 'string', 'size:14'],
            'pan_card_number' => ['required', 'string', 'size:10']
        ];
    
        // Conditionally apply image validation rules if aadhar_front_pic and aadhar_back_pic are not already present
        if (!$this->has('hidden_aadhar_front_pic')) {
            $rules['aadhar_front_pic'] = 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048';
        }

        if (!$this->has('hidden_aadhar_back_pic')) {
            $rules['aadhar_back_pic'] = 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048';
        }
    
        if (!$this->has('hidden_pan_card_pic')) {
            $rules['pan_card_pic'] = 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048';
        }
    
        return $rules;
    }
}
