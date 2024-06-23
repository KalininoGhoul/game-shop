<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Product;

use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\CategoryResource;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Pages\Crud\FormPage;

class ProductFormPage extends FormPage
{
    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        Text::make('Название', 'name'),
                        Slug::make('slug')->from('name'),
                        Number::make('Цена', 'price'),
                        BelongsTo::make('Бренд', 'brand', 'name', new BrandResource())
                            ->searchable(),
                        BelongsTo::make('Категория', 'category', 'name', new CategoryResource())
                            ->searchable(),
                    ]),
                ])
                    ->columnSpan(4),

                Column::make([
                    Block::make([
                        Textarea::make('Описние', 'description')
                            ->setAttribute('rows', '15'),
                    ])
                ])
                    ->columnSpan(8),

                Column::make([
                    Block::make([
                        Image::make('Картинки', 'images')
                            ->multiple(),
                    ])
                ])
                    ->columnSpan(12),

                Column::make([
                    Json::make('Характиристики', 'specs')
                        ->fields([
                            Switcher::make(''),
                            Textarea::make('Название', 'name'),
                            Textarea::make('Значение', 'value'),
                        ])
                        ->removable(),
                ])
                    ->columnSpan(12),
            ])
        ];
    }
}
