<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrinterRequest extends FormRequest
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
            'brand_id' => 'numeric',
            'user_name' => 'string',
            'kd_region' => 'required',
            'ownership_status' => 'string',
            'year' => 'numeric',
            'vendor' => 'string',
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
            'brand_id.numeric' => ':attributes wajib angka',
            'user_name.string' => 'Nama Pengguna wajib teks',
            'kd_region.required' => 'Kantor Induk wajib diisi',
            'ownership_status.string' => 'Kepemilikan wajib teks',
            'year.numeric' => 'Tahun wajib angka',
            'vendor.string' => 'Vendor wajib teks',
        ];
    }

    /**
     * Get custom attributes for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'brand_id' => 'Brand',
            'user_name' => 'Nama Pengguna',
            'kd_region' => 'Kantor Induk',
            'ownership_status' => 'Kepemilikan',
            'year' => 'Tahun',
            'vendor' => 'Vendor',
        ];
    }
}
