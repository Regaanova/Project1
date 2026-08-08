<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "category_id" => [
                'required',
                'integer',
                'exists:categories,id',
            ],
            "name" => [
                'required',
                'string',
                'max:255',
            ],
            "stock" => [
                'required',
                'integer',
            ],
            "buy_price" => [
                'required',
                'numeric',
                'min:0',
            ],
            "sell_price" => [
                'required',
                'numeric',
                'min:0',
                'gt:buy_price'
            ],
            "image" => [
                'nullable',
                'image',
                'max:2048', // 2MB
            ],
            "sku" => [
                'nullable',
                'string',
                'max:255',
            ],
            "is_active" => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
