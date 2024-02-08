<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => ["required", "unique:App\Models\User,email", "email", "max:100"],
            "password" => ["required", "min:5", "max:255"],
            "first_name" => ["required", "max:100"],
            "last_name" => ["required", "max:100"],
        ];
    }
}
