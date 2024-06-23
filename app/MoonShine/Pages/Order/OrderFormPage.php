<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Order;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Support\Number;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Preview;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\TypeCasts\ModelCast;

class OrderFormPage extends FormPage
{
    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        Preview::make(
                            'Пользователь',
                            formatted: fn(Order $order) => $order->cart->user->name
                        ),
                    ])
                ])
                    ->columnSpan(6),

                Column::make([
                    Block::make([
                        Preview::make('Стоимость', 'cost',
                            fn(Order $order) => Number::format((int) $order->cost, locale: 'ru') . ' ₽'
                        ),
                    ])
                ])
                    ->columnSpan(6),

                Column::make([
                    Block::make([
                        TableBuilder::make()
                            ->fields([
                                Text::make('Название', 'name'),
                                Text::make('Цена', 'price'),
                                Text::make('Количество', 'quantity',
                                    fn(Product $product) => $product->pivot->number
                                ),
                            ])
                            ->items($this->getResource()->getItem()->cart->products)
                            ->cast(ModelCast::make(Product::class)),
                    ])
                ])
                    ->columnSpan(6),

                Column::make([
                    Block::make([
                        Enum::make('Статус', 'status')
                            ->attach(OrderStatus::class),
                    ])
                ])
                    ->columnSpan(6),
            ]),
        ];
    }
}
