<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Category>
 */
class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Категории';

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
