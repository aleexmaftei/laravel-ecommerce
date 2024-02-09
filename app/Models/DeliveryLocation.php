<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryLocation extends Model
{
    use SoftDeletes, HasTimestamps, HasFactory;

    protected $table = "delivery_location";
    protected $fillable = [
        "user_id",
        "city_id",
        "address_detail",
        "postal_code"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
