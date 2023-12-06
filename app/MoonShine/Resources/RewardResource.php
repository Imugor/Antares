<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reward;

use MoonShine\Fields\Image;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;

class RewardResource extends Resource
{
	public static string $model = Reward::class;

	public static string $title = 'Rewards';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Название награды', 'name')
                ->required(),

            Image::make('Изображение', 'image_path')
                ->dir('images/rewards')
                ->disableDeleteFiles(),
            
            TinyMce::make('Описание', 'description')
                ->required()
                ->default('Описание'),
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
