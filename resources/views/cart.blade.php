@extends('base')

@section('title') Корзина @endsection

@section('content')

    @if(!empty($products))

        <div class="cart">
            <div class="cart_head">
                <h1 class="cart_title">Корзина</h1>
                <button type="button" class="btn" id="order">Оформить заказ</button>
            </div>
            <div class="catalog_products">
                @foreach($products as $product)
                    @include('parts.product-card', $product)
                @endforeach
            </div>
        </div>

    @else
        <div class="message">Корзина пуста</div>
    @endif

@endsection
