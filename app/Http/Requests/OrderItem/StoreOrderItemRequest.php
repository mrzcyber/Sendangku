<?php

namespace App\Http\Requests\OrderItem;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
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

            'ticket_type_id' => ['nullable', 'integer', 'exists:ticket_types,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }
}
