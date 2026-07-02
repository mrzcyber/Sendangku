<?php

namespace App\Http\Requests\RestaurantOrderItem;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantOrderItemRequest extends FormRequest
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
            'restaurant_menus_id' => ['nullable', 'integer', 'exists:restaurant_menus,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }
}
