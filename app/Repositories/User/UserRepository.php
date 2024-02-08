<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
