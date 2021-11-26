<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;

class ChangePasswordRequest extends FormRequest
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
            'currentPassword' => ['required', 'min:8', new CurrentPassword()],
            'new_password' => 'required|min:8',
            'newConfirmPassword' => ['required', 'same:new_password'],
            
        ];
    }

    public function messages()
    {
        return [
            'currentPassword.required' => "Current Password can't be blank.",
            'new_password.required' => "New Password can't be blank.",
            'newConfirmPassword.required' => "New Confirm Password can't be blank.",
        ];
    }

   
    
}
