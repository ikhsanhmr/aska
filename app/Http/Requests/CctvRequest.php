<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CctvRequest extends FormRequest
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
            'brand_id' => 'required',
            'kd_region' => 'required',
            'nama' => 'required',
            'model' => 'required',
            'nomor_seri' => 'required',
            'alamat_ip' => 'required',
            'status_cctv' => 'required',
            'tanggal_instalasi' => 'required',
            'keterangan' => 'sometimes|nullable'
        ];
    }
}
