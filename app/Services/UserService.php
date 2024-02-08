<?php

namespace App\Services;

use App\DTOs\User\RegisterUserDto;
use App\Enums\RoleEnum;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Services\Base\BaseService;

class UserService extends BaseService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function createRegisterUser(RegisterUserDto $userDto): User
    {
        $user = new User();

        $user->setAttribute("email", $userDto->email);
        $user->setAttribute("password", $userDto->password);
        $user->setAttribute("first_name", $userDto->first_name);
        $user->setAttribute("last_name", $userDto->last_name);
        $user->setAttribute("role_id", RoleEnum::USER->value);

        return $user;
    }

    public function store(RegisterUserDto $userDto): User
    {
        return $this->execute_in_transaction(function () use ($userDto) {
            $user = $this->createRegisterUser($userDto);
            return $this->userRepository->create($user->toArray());
        });
    }
}
