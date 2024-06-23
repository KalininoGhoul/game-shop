<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Mail\OrderMail;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrderListResource::collection(auth()->user()->orders);
    }

    public function store(): JsonResponse
    {
        $activeCart = auth()->user()->activeCart;

        if (!$activeCart) return response()->json([
            'message' => __('order.cart_empty')
        ], 422);

        /** @var Product[] $orderedProducts */
        $orderedProducts = $activeCart
            ->products()
            ->withPivot(['number'])
            ->get();

        $cost = 0;

        foreach ($orderedProducts as $product) {
            $cost += $product->price * $product->pivot->number;

            $product->carts()->updateExistingPivot($activeCart, [
                'price' => $product->price
            ]);
        }

        $order = $activeCart->order()->create([
            'cost' => $cost,
            'status' => OrderStatus::NEW,
        ]);

        $activeCart->update(['is_active' => false]);

        Mail::to(auth()->user()->email)->send(new OrderMail($order));

        return response()->json([
            'message' => __('order.accepted'),
            'cost' => $cost,
        ]);
    }
}
