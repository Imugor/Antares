<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CharacteristicProduct;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;

class CharacteristicProductResource extends Resource
{
	public static string $model = CharacteristicProduct::class;

	public static string $title = 'CharacteristicProducts';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            BelongsTo::make('Характеристика','characteristic', fn($item) => $item->name ?? '')
                ->required(),

            BelongsTo::make('Товар','product', fn($item) => $item->name ?? '')
                ->required(),

            Text::make('Значение', 'value')
                ->required(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
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
