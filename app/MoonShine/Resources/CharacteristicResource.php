<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Characteristic;
use MoonShine\Fields\BelongsTo;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Fields\Slug;

class CharacteristicResource extends Resource
{
	public static string $model = Characteristic::class;

	public static string $title = 'Характеристики';

    protected bool $showInModal = true;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            BelongsTo::make('Категория','category', fn($item) => $item ? $item->name : "-")
                ->required(),

            Text::make('Название характеристики', 'name')
                ->required(),

            Select::make('Тип значения', 'type')
                ->options([
                    'int' => 'Целые числа',
                    'float' => 'Числа с плавающей запятой',
                    'string' => 'Строка',
                ])->required()
                ->default('int'),
            
            Text::make('Единица измерения (если есть)', 'unit')
                ->hint('Необязательное поле'),

            Slug::make('Короткое имя на англ', 'slug')
                ->from('name')
                ->separator('-')
                ->unique(),
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
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
