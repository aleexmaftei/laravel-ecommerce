<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasTimestamps, SoftDeletes, HasFactory;

    protected $table = "category";

    protected $fillable = [
        "name",
        "parent_category_id"
    ];

    public function category(): HasMany
    {
        return $this->HasMany(__CLASS__, "Id", "parent_category_id");
    }

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }
}
