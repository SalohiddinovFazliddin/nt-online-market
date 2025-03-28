<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Product;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;
    protected string $title = 'Products';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Textarea::make('Description')->customAttributes(['rows' => 7]),
            Text::make('Price')->sortable(),
            Text::make('Sale Price', 'sale_price')->sortable(),
            BelongsTo::make('Category', 'category', fn($item) => $item->name, CategoryResource::class)->nullable(),
            Number::make('Quantity', 'quantity'),
            Number::make('Pilgrim', 'pilgrim'),
            BelongsTo::make('Volume', 'volume', fn($item) => $item->name, VolumeResource::class)->nullable(),

            // Chegirmalarni mahsulot bilan bog‘lash (Many-to-Many)
            BelongsToMany::make('Discounts', 'discounts', DiscountResource::class)->async(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Textarea::make('Description')->customAttributes(['rows' => 7]),
            Text::make('Price')->sortable(),
            Text::make('Sale Price', 'sale_price')->sortable(),
            BelongsTo::make('Category', 'category', fn($item) => $item->name, CategoryResource::class)->nullable(),
            Number::make('Quantity', 'quantity'),
            Number::make('Pilgrim', 'pilgrim'),
            BelongsTo::make('Volume', 'volume', fn($item) => $item->name, VolumeResource::class)->nullable(),

            // Chegirma qo'shish qismi
            BelongsToMany::make('Discounts', 'discounts', DiscountResource::class)->async(),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Textarea::make('Description')->customAttributes(['rows' => 7]),
            Text::make('Price')->sortable(),
            Text::make('Sale Price', 'sale_price')->sortable(),
            BelongsTo::make('Category', 'category', fn($item) => $item->name, CategoryResource::class)->nullable(),
            Number::make('Quantity', 'quantity'),
            Number::make('Pilgrim', 'pilgrim'),
            BelongsTo::make('Volume', 'volume', fn($item) => $item->name, VolumeResource::class)->nullable(),

            // Chegirma ko‘rsatish qismi
            BelongsToMany::make('Discounts', 'discounts', DiscountResource::class)->async(),
        ];
    }

    /**
     * @param Product $item
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
