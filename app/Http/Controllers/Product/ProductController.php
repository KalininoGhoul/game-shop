<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductListResource;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Services\Product\StoreProductService;
use App\Services\Product\UpdateProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function indexPage(Request $request): View
    {
        $fields = $request->input();
        $products = Product::query()->with(['category']);

        if (isset($fields['categories'])) {
            $products->whereHas('category', fn($q) => $q->whereIn('slug', $fields['categories']));
        }

        if (isset($fields['brands'])) {
            $products->whereHas('brand', fn($q) => $q->whereIn('slug', $fields['brands']));
        }

        if (isset($fields['price_from'])) {
            $products->where('price', '>=', (int) $fields['price_from']);
        }

        if (isset($fields['price_from'])) {
            $products->where('price', '<=', (int) $fields['price_to']);
        }

        $products = $products->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('catalog', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $fields = $request->input();
        $query = Product::query()->with(['category']);

        if (isset($fields['categories'])) {
            $query->whereHas('category', fn($q) => $q->whereIn('slug', $fields['categories']));
        }

        if (isset($fields['brands'])) {
            $query->whereHas('brand', fn($q) => $q->whereIn('slug', $fields['brands']));
        }

        if (isset($fields['price_from'])) {
            $query->where('price', '>=', (int) $fields['price_from']);
        }

        if (isset($fields['price_from'])) {
            $query->where('price', '<=', (int) $fields['price_to']);
        }

        return ProductListResource::collection($query->get());
    }

    public function store(StoreProductRequest $request, StoreProductService $saveProductService): void
    {
        $saveProductService->save($request->validated());
    }

    public function update(UpdateProductRequest $request, Product $product, UpdateProductService $updateProductService): void
    {
        $updateProductService->update($product, $request->validated());
    }

    public function show(Product $product): View
    {
        return view('product', [
            'product' => $product
        ]);
    }
}
