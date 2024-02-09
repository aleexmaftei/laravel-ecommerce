<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasTimestamps, HasFactory;

    protected $table = "product";

    protected $fillable = [
        "name",
        "quantity",
        "price",
        "tva_percentage"
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany("App/Models/Category", "id");
    }
}
