<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPlacedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "product_id" => ["required", "numeric"],
            "delivery_location_id" => ["required", "numeric"],
            "quantity" => ["required", "numeric", "min:0"],
        ];
    }
}
