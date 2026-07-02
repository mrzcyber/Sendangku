<?php

namespace App\Http\Requests\ServicePackage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreServicePackageRequest extends FormRequest
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
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'benefit' => ['required', 'string'],
            'whatsapp_message' => ['required', 'string', 'max:255'],
            'whatsapp_number' => ['required'],
            'populer' => ['required', 'boolean'],
        ];
    }
}
