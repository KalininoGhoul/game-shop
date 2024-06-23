<?php

namespace App\Models;

use App\Models\Order\Cart;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $login
 * @property string $password
 * @property Role $role
 * @property Cart[]|\App\Models\Collection\Collection $cart
 * @property Cart $activeCart
 * @property Order $orders
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function activeCart(): HasOne
    {
        return $this->hasOne(Cart::class)->where('is_active', true);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, Cart::class);
    }
}
