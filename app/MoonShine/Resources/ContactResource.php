<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Email;
use MoonShine\Fields\Text;

class ContactResource extends Resource
{
	public static string $model = Contact::class;

	public static string $title = 'Контакты';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Город', 'city')
                ->required(),

            Text::make('Адрес', 'address')
                ->required(),

            Email::make('Email', 'email')
                ->required(),

            Text::make('Номер телефона', 'number')
                ->required()
                ->mask('+7 (999) 999-99-99'),

            Text::make('Скрипт для карты', 'geoposition')
                ->required()
                ->hideOnIndex(),

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
