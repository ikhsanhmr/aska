<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppslocalRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'name' => 'required',
            'link' => 'string',
            'username' => 'string',
            'password' => 'string',
            'database_type' => 'string',

        ];
    }

 /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => ':attributes wajib diisi',
            'link.string' => ':attributes wajib diisi',
            'password.string' => ':attributes wajib diisi',
            'username.string' => ':attributes wajib diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'link' => 'Link',
            'password' => 'Password',
            'username' => 'Username',

        ];
    }

}

