<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceStockRequest extends FormRequest
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

            'device_type' => 'string',
            'number_of_devices' => 'integer',
            
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
            'device_type.required' => ':attributes wajib diisi',
            'number_of_devices.required' => ':attributes wajib diisi',
            
        ];
    }

    public function attributes(): array
    {
        return [
            'device_type' => 'Jenis Perangkat',
            'number_of_devices' => 'Jumlah Perangkat',
            

        ];
    }

}

