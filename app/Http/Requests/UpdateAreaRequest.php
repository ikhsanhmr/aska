<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAreaRequest extends FormRequest
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
        $area = $this->route('area');

        return [
            'kd_region'=>'required',
            'kd_area'=>'required|unique:master_area,kd_area,'.$area->id,
            'nama_area'=>'required',
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
            'kd_region.required' => ':attribute is required',
            'kd_area.required' => ':attribute is required',
            'nama_area.required' => ':attribute is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'kd_region' => 'Region',
            'kd_area' => 'Kode Area',
            'nama_area' => 'Nama Area',
        ];
    }
}
