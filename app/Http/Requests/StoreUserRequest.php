<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
            'type' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'profile' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required.',
            'email.required' => 'email is required',
            'password.required' => 'password is required.',
            'password_confirmation.required' => 'password_confirmation is required',
        ];
    }
}
