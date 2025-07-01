<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
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
            'brand_id' => 'required',
            'information' => 'nullable|string',
            'ip_address' => 'nullable|string',
            'user_name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'year' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'brand_id.required' => ':attributes wajib diisi',
            'user_name.required' => ':attributes wajib diisi',
            'username.required' => ':attributes wajib diisi',
            'password.required' => ':attributes wajib diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'brand_id' => 'Merk Server',
            'information' => 'Informasi',
            'ip_address' => 'IP Address',
            'user_name' => 'Nama Pengguna',
            'password' => 'Password',
            'username' => 'Username',
            'year' => 'Tahun',
        ];
    }
}
