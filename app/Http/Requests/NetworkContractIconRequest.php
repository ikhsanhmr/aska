<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NetworkContractIconRequest extends FormRequest
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
            'activation_date' => 'required',
            'service_id' => 'required|string',
            'service' => 'required',
            'unit_id' => 'required',
            'explanation' => 'required|string',
            'activation_number' => 'required|string',
            'scada' => 'required',
            'capacity' => 'required|string',
            'price' => 'required',
            'asman' => 'required',
            'status' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'activation_date.required' => ':attributes wajib diisi',
            'service_id.required' => ':attributes wajib diisi',
            'service_id.integer' => ':attributes wajib teks',
            'service.required' => ':attributes wajib diisi',
            'unit_id.required' => ':attributes wajib diisi',
            'explanation.required' => ':attributes wajib diisi',
            'explanation.string' => ':attributes wajib teks',
            'activation_number.required' => ':attributes wajib diisi',
            'activation_number.string' => ':attributes wajib teks',
            'scada.required' => ':attributes wajib diisi',
            'capacity.required' => ':attributes wajib diisi',
            'capacity.string' => ':attributes wajib teks',
            'price.required' => ':attributes wajib diisi',
            'status.required' => ':attributes wajib diisi',
            'asman.required' => ':attributes wajib diisi',
            'month.required' => ':attributes wajib diisi',
            'year.required' => ':attributes wajib diisi',
        ];
    }

    public function attributes(): array
    {
        return [
            'activation_date' => 'Tanggal Aktivasi',
            'service_id' => 'ID Service',
            'service' => 'Jenis Service',
            'unit_id' => 'Nama Unit',
            'explanation' => 'Ketenrangan',
            'activation_number' => 'No. BA Aktivasi/ADM',
            'scada' => 'Scada',
            'capacity' => 'Kapasitas/BW',
            'price' => 'Harga',
            'status' => 'Status',
            'asman' => 'Asman',
            'month' => 'Bulan',
            'year' => 'Tahun',
        ];
    }
}
