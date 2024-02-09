<?php

namespace App\Http\Requests;

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
            "quantity" => ["required", "numeric", "min:0"],
            "price" => ["required", "numeric", "min:0"],
            "tva_percentage" => ["required", "numeric", "min:0", "max:100"]
        ];
    }
}
