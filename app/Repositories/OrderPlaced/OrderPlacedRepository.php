<?php

namespace App\Repositories\OrderPlaced;

use App\Models\OrderPlaced;
use App\Repositories\Base\BaseRepository;

class OrderPlacedRepository extends BaseRepository implements IOrderPlacedRepository
{
    public function __construct(OrderPlaced $model)
    {
        parent::__construct($model);
    }
}
