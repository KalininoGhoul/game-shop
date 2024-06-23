@php use App\Models\Product\Product; @endphp
<div class="filter filter__active">
    <h2 class="filter_title">Цена</h2>
    <div class="filter_options">
        <div class="filter_options-inner">
            <div class="range_inputs">
                <input id="price_from" class="range_input" data-range="0" min="0" type="number" name="price_from">
                <input id="price_to" class="range_input" data-range="1" min="0" type="number" name="price_to">
            </div>
            <div id="price-slider" data-from="0" data-to="{{ Product::query()->max('price') }}"></div>
        </div>
    </div>
</div>
