<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, HasFactory;

    protected $table = "user";

    protected $fillable = [
        "email",
        "password",
        "first_name",
        "last_name",
        "role_id"
    ];

    protected $hidden = [
        "remember_token",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function buyerOrdersPlaced(): HasMany
    {
        return $this->hasMany(OrderPlaced::class, "buyer_user_id", "id");
    }

    public function sellerOrdersPlaced(): HasMany
    {
        return $this->hasMany(OrderPlaced::class, "seller_user_id", "id");
    }

    public function hasRole($role): bool
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }
}
