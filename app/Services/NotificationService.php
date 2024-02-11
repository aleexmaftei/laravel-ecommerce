<?php

namespace App\Services;

use App\Mail\ContractOrderMail;
use App\Models\DeliveryLocation;
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
        int              $seller_user_id,
        Product          $bought_product,
        int              $quantity,
        User             $buyer_user,
        DeliveryLocation $buyer_delivery_location,
        DeliveryLocation $seller_delivery_location
    ): void
    {
        $seller_user = $this->userRepository->getById($seller_user_id);
        if ($seller_user) {
            Mail::to($seller_user->email)->send(
                new ContractOrderMail(
                    $bought_product,
                    $quantity,
                    $buyer_user,
                    $seller_user,
                    $buyer_delivery_location,
                    $seller_delivery_location
                )
            );
        }
    }
}
