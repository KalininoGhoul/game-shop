<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddToCartRequest;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $products = $user->activeCart?->products()->withPivot(['price', 'number'])->get() ?? [];

        return view('cart', [
            'products' => $products
        ]);
    }

    public function addToCart(AddToCartRequest $request): JsonResource
    {
        /** @var User $user */
        $user = $request->user();
        $product = Product::query()->firstWhere('slug', $request->validated('product'));

        $cart = $user->activeCart;

        if (!$cart) {
            $user->carts()->update(['is_active' => false]);
            $cart = $user->carts()->create(['is_active' => true]);
        }

        $cart->products()->syncWithoutDetaching([
            $product->id => [
                'number' => $request->validated('number') ?? 1
            ]
        ]);

        return new JsonResource(['count' => $cart->products()->count()]);
    }

    public function removeFromCart(Product $product): void
    {
        /** @var User $user */
        $user = auth()->user();

        $user->activeCart->products()->detach($product);
    }
}
