<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user_id = $this->route('user')->id;
        return [
            'name'                  => 'required|max:255',
            'username'              => [
                'sometimes',
                Rule::unique('users')->ignore($user_id),
                'max:255'
            ],
            'password'              => 'sometimes|confirmed',
            'email'                 => [
                'sometimes',
                'email:rfc,dns',
                Rule::unique('users')->ignore($user_id),
            ],
            'phone'                 => 'sometimes|max:255',
            'address'               => 'sometimes|max:255',
            'photo'                 => 'sometimes|image|mimes:png,jpg,jpeg',
            'birthplace'            => 'sometimes|max:255',
            'birthdate'             => 'sometimes|date',
            'position'              => 'nullable',
            'kd_region'             => 'required',
            'gender'                => [
                'sometimes',
                Rule::in(['L', 'P']),
            ],
            'role'                  => [
                'sometimes',
                Rule::in(['admin', 'user'])
            ],
        ];
    }
}
