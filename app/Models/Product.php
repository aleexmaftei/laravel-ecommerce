<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasTimestamps, HasFactory;

    protected $table = "product";

    protected $fillable = [
        "name",
        "quantity",
        "price",
        "tva_percentage",
        "short_description",
        "description",
        "user_id"
    ];

    protected $hidden = [
        "user_id"
    ];

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
