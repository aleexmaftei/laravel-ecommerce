<?php

namespace App\Models;

use App\Models\Base\Lookup;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Lookup
{
    protected $table = "role";

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
