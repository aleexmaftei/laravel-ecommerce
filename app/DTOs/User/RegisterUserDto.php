<?php

namespace App\DTOs\User;

use App\Http\Requests\User\RegisterUserRequest;

class RegisterUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $first_name,
        public readonly string $last_name,
    )
    {

    }

    public static function create(RegisterUserRequest $user): RegisterUserDto
    {
        return new self(
            email: $user->validated("email"),
            password: $user->validated("password"),
            first_name: $user->validated("first_name"),
            last_name: $user->validated("last_name"),
        );
    }
}
