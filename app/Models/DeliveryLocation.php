<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryLocation extends Model
{
    use SoftDeletes, HasTimestamps;

    protected $table = "delivery_location";
    protected $fillable = [
        "user_id",
        "country_name",
        "region_name",
        "city_name",
        "address_detail",
        "postal_code"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo("App/Models/User", "id");
    }
}
