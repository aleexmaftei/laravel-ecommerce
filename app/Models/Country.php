<?php

namespace App\Models;

use App\Models\Base\Lookup;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Lookup
{
    protected $table = "country";

    public function country_regions(): HasMany
    {
        return $this->hasMany(CountryRegion::class);
    }
}
