<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelevisionRequest extends FormRequest
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
            'serial_number' => 'required',
            'brand_id' => 'required',
            'model' => 'required',
            'kd_region' => 'required',
            'status_asset' => 'required',
            'bast' => 'sometimes|nullable',
            'keterangan' => 'sometimes|nullable'
        ];
    }
}
