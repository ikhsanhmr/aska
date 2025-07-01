<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'nip'           => 'required',
            'username'      => [
                'required',
                Rule::unique('users'),
                'max:255'
            ],
            'password'      => 'required|confirmed|min:8',
            'email'         => [
                'required',
                'email:rfc,dns',
                Rule::unique('users'),
            ],
            'phone'         => 'sometimes|max:255',
            'address'       => 'sometimes|max:255',
            'photo'         => 'sometimes|image|mimes:png,jpg,jpeg',
            'birthplace'    => 'sometimes|max:255',
            'birthdate'     => 'sometimes|date',
            'position'      => 'nullable',
            'kd_region'     => 'required',
            'gender'        => [
                'sometimes',
                Rule::in(['L','P']),
            ],
            'role'          => [
                'sometimes',
                Rule::in(['admin', 'user'])
            ],
        ];
    }
}
