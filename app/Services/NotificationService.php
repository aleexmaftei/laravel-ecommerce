<?php

namespace App\Services;

use App\Mail\ContractOrderMail;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Mail;

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

    public function emailContractForOwnerOnOrderCompleteByUserId(
        int     $owner_user_id,
        Product $bought_product,
        int     $quantity,
        User    $buyer_user
    ): void
    {
        $owner_user = $this->userRepository->getById($owner_user_id);
        if ($owner_user) {
            Mail::to($owner_user->email)->send(new ContractOrderMail($bought_product, $quantity, $buyer_user));
        }
    }
}
