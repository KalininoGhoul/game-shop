<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Order;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\MoonShine\Resources\UserResource;
use Illuminate\Support\Number as NumberHelper;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\IndexPage;

class OrderIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            Text::make('Номер', 'id'),

            BelongsTo::make('Пользователь', 'user', 'name', new UserResource()),

            Number::make('Стоимость', 'cost',
                fn (Order $order) => NumberHelper::format((int) $order->cost, locale: 'ru') . ' ₽'
            ),

            Enum::make('Статус', 'status')
                ->attach(OrderStatus::class),

            Date::make('Дата', 'created_at'),
        ];
    }
}
