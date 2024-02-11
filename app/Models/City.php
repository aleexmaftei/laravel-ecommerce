<?php

namespace App\Models;

use App\Models\Base\Lookup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Lookup
{
    protected $table = "city";
    protected $fillable = ["country_region_id"];

    public function country_region(): BelongsTo
    {
        return $this->belongsTo(CountryRegion::class);
    }

    public function delivery_locations(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
