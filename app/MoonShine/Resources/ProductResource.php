<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use MoonShine\Fields\Image;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Slug;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Actions\ImportAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\BelongsToMany;
use MoonShine\Fields\HasMany;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Filters\BelongsToFilter;

class ProductResource extends Resource
{
	public static string $model = Product::class;

	public static string $title = 'Products';

	public function fields(): array
	{
		return [
            Grid::make('', [
                Column::make('Основная информация', [
                    Block::make('Основная информация', [
                        ID::make()->sortable(),
        
                        BelongsTo::make('Категория', 'category', fn($item) => ($item->parent ? $item->parent->name: 'deletedCategory')."/".$item->name)
                            ->searchable()
                            ->hideOnDetail()
                            ->hideOnIndex()
                            ->required()
                            ->valuesQuery(function($query){
                                return $query->whereNotNull('category_id');
                            }),
        
                        Text::make('Название товара', 'name')
                            ->required(),
        
                        Text::make('Цена', 'price')
                            ->required(),

                        BelongsTo::make('Бренд', 'partner', 'name')
                            ->searchable()
                            ->nullable(),
        
                        TinyMce::make('Описание', 'description')
                            ->default(' ')
                            ->required()
                            ->hideOnIndex(),
        
                        NoInput::make('Категория', 'category_id', fn($item) => $item->category->name ?? '-')
                            ->badge('green')
                            ->hideOnUpdate()
                            ->hideOnCreate(),
                    ]),
                ])->columnSpan(7),
                Column::make('Дополнительная информация', [
                    Block::make('Дополнительная информация', [
                        HasMany::make('Изображения', 'images')
                            ->fields([
                                Image::make('Файл', 'path')
                                    ->dir('images/products')
                                    ->disableDeleteFiles(),
                                
                                Number::make('Позиция', 'position')
                                    ->required()
                                    ->hideOnIndex(),
                            ])->removable(),
                        
                        Number::make('Индекс популярности', 'number_of_visit')
                            ->default(0)
                            ->sortable()
                            ->required(),

                        Slug::make('Slug', 'slug')
                            ->from('name')
                            ->separator('-')
                            ->unique(),
                    ]),
                ])->columnSpan(5),
            ]),

            Block::make('Характеристики товара', [
                BelongsToMany::make('', 'characteristic', fn($item) => $item->name.($item->unit ? ' ('.$item->unit.')' : ''))
                    ->fields([
                        Text::make('Значение', 'value'),
                    ])
                    ->hideOnIndex()
                    ->hideOnCreate()
                    ->valuesQuery(function ($query) {
                        $category_ids = [$this->item->category->parent->id ?? null, $this->item->category->id ?? null];
                        return $query->whereIn('category_id', $category_ids);
                    }),
            ]),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['name'];
    }

    public function filters(): array
    {
        return [
            BelongsToFilter::make('Категория', 'category', fn($item) => ($item->parent ? $item->parent->name: 'deletedCategory')."/".$item->name)
                ->searchable()
                ->nullable()
                ->valuesQuery(fn($query) => $query->whereNotNull('category_id')),
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
            
        ];
    }
}
