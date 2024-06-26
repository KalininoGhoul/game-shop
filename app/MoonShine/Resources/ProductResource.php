<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product\Product;
use App\MoonShine\Pages\Product\ProductFormPage;
use App\MoonShine\Pages\Product\ProductIndexPage;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Товары';

    public function pages(): array
    {
        return [
            ProductIndexPage::make($this->title()),
            ProductFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
