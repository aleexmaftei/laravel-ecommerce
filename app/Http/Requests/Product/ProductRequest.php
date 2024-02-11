<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "max:150"],
            "short_description" => ["nullable", "max:60"],
            "description" => ["nullable", "max:255"],
            "quantity" => ["required", "numeric", "min:0"],
            "price" => ["required", "numeric", "min:0"],
            "tva_percentage" => ["required", "numeric", "min:0", "max:100"]
        ];
    }
}
