<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasTimestamps, SoftDeletes, HasFactory;

    protected $table = "category";

    protected $fillable = [
        "name",
        "parent_category_id"
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany("App/Models/Category", "id");
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany("App/Models/Product", "id");
    }
}
