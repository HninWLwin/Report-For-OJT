<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRegistrationRequest extends FormRequest
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
             'name' => ['required'],
             'email' => ['required', 'email', 'unique:users,email'],
             'password' => ['required' , 'min:8'],
             'password_confirmation' => ['same:password'],
             'type' => ['required'],
             'profile' => ['required', 'image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
             'name.required' => "Name can't be blank.",
             'email.required' => "Email can't be blank.",
             'password.required' => "Password can't be blank.",
             'password_confirmation.required' => "Password can't be blank.",
             'type.required' => "Type can't be blank.",
             'profile.required' => "Profile can't be blank.",
        ];
    }
}
