<?php

namespace App\Models;

use App\Models\Base\Lookup;

class Role extends Lookup
{
    protected $table = "role";

    public final const ADMIN = 1;
    public final const USER = 2;
}
