<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Validation\Rule;

class UpdateUnitRequest extends FormRequest
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
        $unit = $this->route('unit');

        return [
            'kd_region' => 'required',
            'kd_area' => 'required|numeric',
            'kd_unit' => 'required|integer|unique:master_unit,kd_unit,'.$unit->id,
            'nama_unit' => 'required|max:255',
        ];
    }
}
