<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComputerRequest extends FormRequest
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
            'name' => 'required',
            'serial_number' => 'required',
            'spesification' => 'string',
            'ip_address' => 'string',
            'user_name' => 'string',
            'kd_region' => 'required',
            'ownership_status' => 'string',
            'year' => 'numeric',
            'vendor' => 'string',
            'system_operation' => 'string',
            'office' => 'string',
            'status_id' =>'numeric',
            'kes' => 'string',
            'mouse' => 'string',
            'keyboard' => 'string',
            'monitor' => 'string',
            'contract_date' => 'date',
            'rental_price' => 'numeric',
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
            'brand_id.numeric' => 'Merek wajib angka',
            'name.required' => 'name wajib diisi',
            'serial_number.required' => 'Serial Number wajib diisi',
            'spesification.string' => 'Spesifikasi wajib teks',
            'serial_number.string' => 'Serial Number wajib diisi',
            'ip_address.string' => 'IP Address wajib teks',
            'user_name.string' => 'Nama Pengguna wajib teks',
            'unit_id.numeric' => 'Unit ID wajib angka',
            'ownership_status.string' => 'Kepemilikan wajib teks',
            'year.numeric' => 'Tahun wajib angka',
            'vendor.string' => 'Vendor wajib teks',
            'system_operation.string' => 'Sistem Operasi wajib teks',
            'office.string' => 'Kantor wajib teks',
            'status_id.numeric' => 'Status ID wajib angka',
            'kes.string' => 'Kes wajib teks',
            'mouse.string' => 'Mouse wajib teks',
            'keyboard.string' => 'Keyboard wajib teks',
            'monitor.string' => 'Monitor wajib teks',
            'contract_date.date' => 'Tanggal kontrak wajib date',
            'rental_price.numeric' => 'Harga Sewa wajib angka',
        ];
    }


}
