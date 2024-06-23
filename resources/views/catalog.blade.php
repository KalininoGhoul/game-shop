@extends('base')

@section('title') Главная @endsection

@section('content')

    <div class="catalog">

        <div class="catalog_filter">

            <form id="filter-form">

                <div class="filters">
                    <div class="filter">
                        @include('parts.filter.filter-item', ['name' => 'categories', 'title' => 'Категории', 'options' => $categories])
                        @include('parts.filter.filter-item', ['name' => 'brands', 'title' => 'Бренды', 'options' => $brands])
                        @include('parts.filter.filter-range', ['name' => 'Цена'])
                        <button class="btn filter_btn">Применить</button>
                    </div>
                </div>

            </form>

        </div>

        <div class="catalog_products">
            @foreach($products as $product)
                @include('parts.product-card', $product)
            @endforeach
        </div>

    </div>

    <template id="product-card">
        <div class="product-card">
            <div class="product-card_img">
                <img src="https://c.dns-shop.ru/thumb/st4/fit/300/300/937de2ce4c52833650cd3fd5a559833f/32971bbcca7a23c7656c9fad55e89b98b444f3b9e58602ed37f2e6fb5bcabcd5.jpg">
            </div>
            <div class="product-card_body">
                <h3 class="product-card_category"></h3>
                <h2 class="product-card_name"></h2>
                <div class="product-card_rating"></div>
                <div class="product-card_price"></div>
            </div>
        </div>
    </template>

@endsection
