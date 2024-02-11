<?php

namespace App\Models;

use App\Models\Base\Lookup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryRegion extends Lookup
{
    protected $table = "country_region";

    protected $fillable = ["country_id"];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
