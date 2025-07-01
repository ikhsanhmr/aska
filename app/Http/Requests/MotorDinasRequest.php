<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotorDinasRequest extends FormRequest
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
            'nomor_polisi' => 'required',
            'nomor_rangka' => 'required',
            'nomor_mesin' => 'required',
            'model' => 'required',
            'tahun_pembuatan' => 'required',
            'warna' => 'required',
            'status_asset' => 'required',
            'bast' => 'sometimes|nullable',
            'keterangan' => 'sometimes|nullable'
        ];
    }
}
