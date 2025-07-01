<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessPointRequest extends FormRequest
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
            'kd_region' => 'required',
            'nama_ap' => 'required',
            'model' => 'required',
            'nomor_seri' => 'required',
            'mac_address' => 'required',
            'alamat_ip' => 'sometimes|nullable',
            'status' => 'required',
            'status_asset' => 'required',
            'keterangan' => 'sometimes|nullable'
        ];
    }
}
