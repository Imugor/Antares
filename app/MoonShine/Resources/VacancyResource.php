<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vacancy;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

class VacancyResource extends Resource
{
	public static string $model = Vacancy::class;

	public static string $title = 'Вакансии';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Название вакансии', 'name')
                ->required(),

            BelongsTo::make('Местоположение', 'contact', fn($item) => $item->city)
                ->required(),

            Text::make('Зарплата', 'payment')
                ->required()
                ->default('От 35 000 до 45 000')
                ->hint('Например: "От 35 000 до 45 000"'),

            Text::make('Требуемый опыт', 'experience')
                ->required()
                ->default('требуемый опыт работы: ')
                ->hint('Например: "требуемый опыт работы: 1-3 года"'),

            Text::make('Рабочий день', 'work_day')
                ->required()
                ->default('полный рабочий день')
                ->hint('Например: "полный рабочий день"'),

            Json::make('Требования', 'requirements')
                ->required()
                ->onlyValue('Требование')
                ->default([
                    "Высшее образование",
                    "Грамотная устная и письменная речь, навыки деловой переписки",
                    "Усидчивость, внимательность",
                    "Базовые знания MS Office",
                    "Ответственность",
                    "Пунктуальность",
                    "Высокие навыки коммуникации",
                ])
                ->removable()
                ->hideOnIndex(),
            

            Json::make('Условия', 'conditions')
                ->required()
                ->onlyValue('Условия')
                ->default([
                    "Комфортное место в офисе",
                    "Хороший коллектив",
                    "Хорошее кофе и еда",
                ])
                ->removable()
                ->hideOnIndex(),

            
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
