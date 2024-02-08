<?php

namespace App\Http\Controllers;

use App\DTOs\User\RegisterUserDto;
use App\Http\Requests\User\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Register user view
    public function create()
    {
        return View("user.register");
    }

    // Create user
    public function store(RegisterUserRequest $userData): RedirectResponse
    {
        $userDto = RegisterUserDto::create($userData);
        $this->userService->store($userDto);

        return redirect()->route("home");
    }

    public function destroy(string $id)
    {
        //
    }
}
