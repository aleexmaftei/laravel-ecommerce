<?php

namespace App\Repositories\DeliveryLocation;

use App\Models\DeliveryLocation;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class DeliveryLocationRepository extends BaseRepository implements IDeliveryLocationRepository
{

    public function __construct(DeliveryLocation $model)
    {
        parent::__construct($model);
    }

    public function getDeliveryLocationsByUserId(int $user_id): Collection|array
    {
        return $this->model::query()->where("user_id", $user_id)->get();
    }
}
