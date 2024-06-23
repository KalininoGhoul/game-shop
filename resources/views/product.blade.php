@php use Illuminate\Support\Facades\Storage; @endphp
@extends('base')

@section('title')
    {{ $product->name }}
@endsection

@section('content')

    <div class="breadcrumbs">
        <a href="/">Главная</a>
        <a href="{{ route('product.index', ['categories[]' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        <span class="breadcrumbs_current">{{ $product->name }}</span>
    </div>

    <div class="product_top">
        <div class="product_slider">
            <div class="swiper swiper-container gallery-slider">
                <div class="swiper-wrapper">
                    @foreach($product->images ?? [] as $image)
                        <div class="swiper-slide"><img
                                src="{{ Storage::disk('public')->url($image) }}"
                                alt=""></div>
                    @endforeach
                </div>
            </div>
            <div class="swiper swiper-container gallery-thumbs">
                <div class="swiper-wrapper">
                    @foreach($product->images ?? [] as $image)
                        <div class="swiper-slide"><img
                                src="{{ Storage::disk('public')->url($image) }}"
                                alt=""></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="product_desc">
            <div class="product-card_rating">
                @for($i = 1; $i <= $product->rating; $i++)
                    <div class="product-card_star__active"></div>
                @endfor
                @for($i = $product->rating; $i < 5; $i++)
                    <div class="product-card_star__disabled"></div>
                @endfor
            </div>
            <h1 class="product_name">
                {{ $product->name }}
            </h1>
            <div class="product_price">{{ Number::format($product->price, locale: 'ru') }} ₽</div>
            <div class="product_specs">

                <table class="product_specs-table">

                    <tr>
                        <td>Бренд</td>
                        <td>{{ $product->brand->name }}</td>
                    </tr>

                    @foreach($product->specs ?? [] as $spec)

                        <tr>
                            <td>{{ $spec['name'] }}</td>
                            <td>{{ $spec['value'] }}</td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="product-bar">
        <div class="warranty">

            <div class="warranty_item">
                <div class="warranty_img">
                    <img src="/assets/icons/fast-delivery.svg" style="margin-top: -10px" alt="">
                </div>
                <div class="warranty_body">
                    <h3 class="warranty_title">Бесплатная доставка</h3>
                    <p class="warranty_desc">По всей России</p>
                </div>
            </div>

            <div class="warranty_item">
                <div class="warranty_img">
                    <img src="/assets/icons/security.svg" style="height: 35px" alt="">
                </div>
                <div class="warranty_body">
                    <h3 class="warranty_title">100% Гарантия</h3>
                    <p class="warranty_desc">Качество проверено</p>
                </div>
            </div>

            <div class="warranty_item">
                <div class="warranty_img">
                    <img src="/assets/icons/return.svg" style="margin-top: -10px" alt="">
                </div>
                <div class="warranty_body">
                    <h3 class="warranty_title">Оформим возврат</h3>
                    <p class="warranty_desc">Если что-то пойдет не так</p>
                </div>
            </div>

        </div>

        <div class="product_buy" data-product="{{ $product->slug }}" data-quantity="1">
            <div class="product_quantity">
                <button type="button" class="product_quantity-minus">
                    <img src="/assets/icons/minus.svg" alt="">
                </button>
                <div class="product_quantity-output">1</div>
                <button type="button" class="product_quantity-plus">
                    <img src="/assets/icons/plus.svg" alt="">
                </button>
            </div>
            <button class="btn" data-cart-btn>В корзину</button>
        </div>

    </div>

    <div class="tabs">
        <div class="tabs_head">
            <div class="tab tab__active" data-for-tab="description">Описание</div>
            <div class="tab" data-for-tab="specs">Характеристики</div>
        </div>
        <div class="tab_content" style="display: flex" data-tab="description">
            {{ $product->description }}
        </div>
        <div class="tab_content tab_content__tables" data-tab="specs">
            @php
                $specGroups = collect($product->specs)->split(2);
            @endphp

            @foreach($specGroups as $specs)
                <table class="product_specs-table">
                    @foreach($specs as $spec)
                        <tr>
                            <td>{{ $spec['name'] }}</td>
                            <td>{{ $spec['value'] }}</td>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        </div>
    </div>

@endsection
