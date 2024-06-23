<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product\Brand;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Brand>
 */
class BrandResource extends ModelResource
{
    protected string $model = Brand::class;

    protected string $title = 'Бренды';

    public function fields(): array
    {
        return [
            Text::make('Название', 'name'),
            Slug::make('slug', 'slug')
                ->from('name'),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
