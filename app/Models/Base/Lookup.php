<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    protected $hidden = [
        "id",
        "name",
    ];
}
