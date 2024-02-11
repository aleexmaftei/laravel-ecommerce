<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPlaced extends Model
{
    use HasTimestamps, SoftDeletes;

    protected $table = "order_placed";

    protected $fillable = [
        "order_quantity",
        "product_id",
        "buyer_user_id",
        "seller_user_id",
        "delivery_location_id",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sellerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "id", "seller_user_id");
    }

    public function buyerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "id", "buyer_user_id");
    }

    public function deliveryLocation(): BelongsTo
    {
        return $this->belongsTo(DeliveryLocation::class);
    }
}
