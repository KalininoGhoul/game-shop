<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Product;

use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\IndexPage;

class ProductIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            Text::make('Название', 'name'),
            Text::make('Цена', 'price'),
            BelongsTo::make('Бренд', 'brand', 'name', new BrandResource()),
            BelongsTo::make('Категория', 'category', 'name', new CategoryResource()),
            Number::make('Рейтинг', 'rating')
                ->stars(),
        ];
    }
}
