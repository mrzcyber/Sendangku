<?php

namespace App\Http\Requests\Table;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTableRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number' => ['required', 'integer', 'min:1', 'unique:tables,number'],
        ];
    }

    public function messages(): array
    {
        return [
            'number.required' => 'Nomor meja wajib diisi.',
            'number.integer' => 'Nomor meja harus berupa angka.',
            'number.min' => 'Nomor meja minimal 1.',
            'number.unique' => 'Nomor meja ini sudah terdaftar.',
        ];
    }
}
