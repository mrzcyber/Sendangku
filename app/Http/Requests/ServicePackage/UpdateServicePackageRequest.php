<?php

namespace App\Http\Requests\ServicePackage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServicePackageRequest extends FormRequest
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
            'service_id' => ['sometimes', 'required', 'integer', 'exists:services,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'price' => ['sometimes', 'required', 'integer', 'min:0'],
            'benefit' => ['sometimes', 'required', 'string'],
            'whatsapp_message' => ['sometimes', 'required', 'string', 'max:255'],
            'whatsapp_number' => ['sometimes', 'required', 'string', 'max:255'],
            'populer' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
