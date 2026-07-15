<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'purchase' => ['required', 'in:online,offline'],
            'buyer_name' => ['required_if:purchase,online', 'string', 'max:255'],
            'buyer_phone' =>['required_if:purchase,online', 'string', 'max:255'],
            'buyer_email' =>['required_if:purchase,online', 'email', 'max:255'],
            'items' =>['required','array','min:1'],
            'items.*.ticket_type_id' => ['required','exists:ticket_types,id'],
            'items.*.qty' => ['required','min:0']
        ];
    }

    public function after(): array
    {
        return[
            function($validator){
                $hasTicket = collect($this->input('items'))
                ->contains(fn ($item) => $item['qty'] > 0);

                if(!$hasTicket){
                    $validator->errors()->add(
                        'items',
                        'pilih minimal 1 tiket'
                    );
                }
            }
        ];
    }
}
