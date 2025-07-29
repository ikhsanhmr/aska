<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaptopRequest extends FormRequest
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
            'brand_id' => 'sometimes|nullable',
            'name' => 'sometimes|nullable',
            'serial_number' => 'nullable',
            'pegawai' => 'nullable',
            'tanggal_pembelian' => 'sometimes|nullable',
            'spesification' => 'string|nullable',
            'ip_address' => 'string|nullable',
            'user_name' => 'string|nullable',
            'kd_region' => 'string|nullable',
            'ownership_status' => 'string|nullable',
            'year' => 'sometimes|nullable',
            'harga' => 'sometimes|nullable',
            'barcode' => 'string|nullable',
            'vendor' => 'string|nullable',
            'bast' => 'mimes:pdf,doc,docx|max:2048|nullable',
            'bastp' => 'mimes:pdf,doc,docx|max:2048|nullable',
            'data_kontrak' => 'mimes:pdf,doc,docx|max:2048|nullable',
            'form_permintaan' => 'mimes:pdf,doc,docx|max:2048|nullable',
            'foto' => 'mimes:pdf,doc,docx,jpg,png,jpeg,webp|max:2048|nullable',
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
            'name.required' => ':attributes wajib diisi',
            'serial_number.required' => ':attributes wajib diisi',
            'spesification.string' => ':attributes wajib teks',
            'ip_address.string' => ':attributes wajib teks',
            'user_name.string' => ':attributes wajib teks',
            'unit_id.numeric' => ':attributes wajib angka',
            'ownership_status.string' => ':attributes wajib teks',
            'year.numeric' => ':attributes wajib angka',
            'vendor.string' => ':attributes wajib teks',
            'bast.mimes' => ':attributes wajib dokumen berformat pdf, doc, docx',
            'bast.max' => ':attributes maksimal 2MB'
        ];
    }

    public function attributes(): array
    {
        return [
            'brand_id' => 'Brand',
            'name' => 'Name',
            'serial_number' => 'Serial number',
            'spesification' => 'Spesifikasi',
            'ip_address' => 'IP Address',
            'user_name' => 'Nama Pengguna',
            'unit_id' => 'Unit ID',
            'ownership_status' => 'Kepemilikan',
            'year' => 'Tahun',
            'vendor' => 'Vendor',
            'bast' => 'Bast'
        ];
    }

}
