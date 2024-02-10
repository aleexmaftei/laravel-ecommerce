<?php

namespace App\Services;

use App\Notifications\OrderNotification;
use App\Repositories\User\IUserRepository;

class NotificationService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function notifyOrderCompleteForUser(int $user_id): void
    {
        $user = $this->userRepository->getById($user_id);
        if ($user) {
            $user->notify(new OrderNotification($user));
        }
    }
}
