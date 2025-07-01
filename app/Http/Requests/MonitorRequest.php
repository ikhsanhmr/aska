<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonitorRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'brand_id.numeric' => ':attributes wajib angka',
            'user_name.string' => ':attributes wajib teks',
            'kd_region.string' => ':attributes wajib pilih',
            'ownership_status.string' => ':attributes wajib teks',
            'year.required' => ':attributes wajib angka',
            'vendor.required' => ':attributes wajib teks',
        ];
    }


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
