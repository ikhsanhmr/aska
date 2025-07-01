<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            'nip'   => [
                'required',
                Rule::unique('employees')
            ],
            'name'  => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')
            ],
            'phone' => 'sometimes|max:255'
        ];
    }
}