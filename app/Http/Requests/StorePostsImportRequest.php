<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostsImportRequest extends FormRequest
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
            'file' => 'required|mimes:csv,txt',
            'title'=> 'required',
            'description' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title' => 'Post upload csv must have 3 columns'
        ];
    }

}
