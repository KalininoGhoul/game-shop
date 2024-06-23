<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\MoonShine\Pages\Order\OrderFormPage;
use App\MoonShine\Pages\Order\OrderIndexPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\QueryTags\QueryTag;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Order>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Заказы';

    public function pages(): array
    {
        return [
            OrderIndexPage::make($this->title()),
            OrderFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
        ];
    }

    public function getCreateButton(?string $componentName = null, bool $isAsync = false): ActionButton
    {
        return (new ActionButton(''))->canSee(fn() => false);
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function queryTags(): array
    {
        return [
            QueryTag::make(
                'Новые',
                fn(Builder $query) => $query->where('status', OrderStatus::NEW)
            ),
            QueryTag::make(
                'Подтвержденные',
                fn(Builder $query) => $query->where('status', OrderStatus::CONFIRMED)
            ),
            QueryTag::make(
                'Выполненные',
                fn(Builder $query) => $query->where('status', OrderStatus::COMPLETE)
            ),
            QueryTag::make(
                'Отмененные',
                fn(Builder $query) => $query->where('status', OrderStatus::CANCELLED)
            )
        ];
    }
}
