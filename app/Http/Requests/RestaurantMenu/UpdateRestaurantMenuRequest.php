<?php

namespace App\Http\Requests\RestaurantMenu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantMenuRequest extends FormRequest
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
            'status' => ['sometimes', 'required', 'boolean'],
            'category' => ['sometimes', 'required', 'in:makanan,minuman,lainnya'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'thumbnail' => ['sometimes', 'required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'price' => ['sometimes', 'required', 'integer', 'min:0'],
        ];
    }
}
