<?php

namespace App\Repositories\DeliveryLocation;

use App\Repositories\Base\IBaseRepository;

interface IDeliveryLocationRepository extends IBaseRepository
{
    public function getDeliveryLocationsByUserId(int $user_id);
}
