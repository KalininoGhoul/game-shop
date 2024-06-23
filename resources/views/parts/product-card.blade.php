@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Number; @endphp
<a href="{{ route('product.show', $product) }}" class="product-card">
    <div class="product-card_img">
        <img src="{{ Storage::disk('public')->url($product->images[0] ?? '') }}" alt="{{ $product->name }}">
    </div>
    <div class="product-card_body">
        <h3 class="product-card_category">{{ $product->category->name }}</h3>
        <h2 class="product-card_name">{{ $product->name}}</h2>
        <div class="product-card_rating">
            @for($i = 1; $i <= $product->rating; $i++)
                <div class="product-card_star__active"></div>
            @endfor
            @for($i = $product->rating; $i < 5; $i++)
                <div class="product-card_star__disabled"></div>
            @endfor
        </div>
        <div class="product-card_price">{{ Number::format($product->price, locale: 'ru') }} ₽</div>
    </div>
</a>
