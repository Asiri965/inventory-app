<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class DeductInventoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|gt:0',
            'items.*.note' => 'nullable|string|max:500',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $items = $this->input('items', []);

                foreach ($items as $index => $item) {
                    if (!isset($item['item_id']) || !isset($item['quantity'])) {
                        continue;
                    }

                    $inventoryItem = Item::find($item['item_id']);

                    if ($inventoryItem && $item['quantity'] > $inventoryItem->quantity) {
                        $validator->errors()->add(
                            "items.{$index}.quantity",
                            "Insufficient quantity. Available: {$inventoryItem->quantity}"
                        );
                    }
                }
            }
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'At least one item is required.',
            'items.*.item_id.required' => 'Item is required.',
            'items.*.item_id.exists' => 'Selected item is invalid.',
            'items.*.quantity.required' => 'Quantity is required.',
            'items.*.quantity.gt' => 'Quantity must be greater than 0.',
        ];
    }
}
