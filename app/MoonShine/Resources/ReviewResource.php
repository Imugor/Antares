<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

use MoonShine\Fields\SwitchBoolean;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Email;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;

class ReviewResource extends Resource
{
	public static string $model = Review::class;

	public static string $title = 'Reviews';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Полное имя', 'fullname')
                ->required(),

            Email::make('Email', 'email')
                ->hideOnIndex()
                ->required(),

            Number::make('Рейтинг', 'rating')
                ->min(1)
                ->max(5)
                ->stars()
                ->required(),

            Text::make('Телефон', 'number')
                ->mask('+7(999)999-99-99')
                ->hideOnIndex(),

            Text::make('Текст', 'text')
                ->required(),

            SwitchBoolean::make('Показывать на сайте', 'show')
                ->default(False),
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
