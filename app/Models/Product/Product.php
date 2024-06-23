<?php

namespace App\Models\Product;

use App\Models\Order\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $name
 * @property string $slug
 * @property Category $category
 * @property string $description
 * @property int $price
 * @property array $specs
 * @property ProductImage[]|Collection $images
 * @property ProductImage $preview
 */
class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'integer',
        'specs' => 'array',
        'images' => 'array',
    ];

    protected $guarded = ['id'];

    public function preview(): HasOne
    {
        return $this
            ->hasOne(ProductImage::class)
            ->where('is_preview', true);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
