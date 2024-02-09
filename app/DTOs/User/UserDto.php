<?php

namespace App\DTOs\User;


use App\Http\Requests\User\UserRequest;

class UserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {

    }

    public static function create(UserRequest $user): UserDto
    {
        return new self(
            email: $user->validated("email"),
            password: $user->validated("password"),
        );
    }
}
