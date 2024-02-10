<?php

namespace App\Http\Controllers;

use App\DTOs\User\RegisterUserDto;
use App\DTOs\User\UserDto;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function login_index()
    {
        return View("user.login");
    }

    public function login(UserRequest $userData): RedirectResponse
    {
        $userDto = UserDto::create($userData);

        if (!$this->userService->login($userDto)) {
            return redirect()
                ->route("user.login")
                ->withErrors("Email and password combination does not exist!");
        }

        return redirect()->route("home");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect("home");
    }

    public function destroy(string $id)
    {
        //
    }
}
