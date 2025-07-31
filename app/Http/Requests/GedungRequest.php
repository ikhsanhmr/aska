<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GedungRequest extends FormRequest
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
            // 'nama' => 'nullable|string|max:255',
            // 'alamat' => 'nullable|string',
            'kd_up' => 'nullable|string|max:255', // Renamed from kd_region
            'status_asset' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'bast' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', //for file upload
            'uraian' => 'nullable|string',
            'unit_manual' => 'nullable|string|max:255',
            'pihak_pertama' => 'nullable|string|max:255',
            'pihak_kedua' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'luas_tanah_m2' => 'nullable|numeric',
            'luas_bangunan_m2' => 'nullable|numeric',
            'asuransi_yn' => 'nullable|in:Y,N',
            'status_sewa' => 'nullable|string|max:255',
            'no_sertifikat' => 'nullable|string|max:255',
            'nomor_pj' => 'nullable|string|max:255',
            'tanggal_input' => 'nullable|date',
            'periode_awal' => 'nullable|date',
            'periode_akhir' => 'nullable|date|after_or_equal:periode_awal',
            'awal_sewa' => 'nullable|date',
            'akhir_sewa' => 'nullable|date|after_or_equal:awal_sewa',
            'tahun_sewa' => 'nullable|integer',
            'nilai' => 'nullable|numeric',
            'validasi' => 'nullable|string|max:255',
        ];
    }
}
