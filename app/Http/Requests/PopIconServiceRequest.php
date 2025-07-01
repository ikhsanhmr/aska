<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopIconServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|array',
            'service_id.*' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'service_id.*.required' => 'Service wajib diisi',
            'service_id.required' => 'Service wajib diisi',
        ];
    }

}
