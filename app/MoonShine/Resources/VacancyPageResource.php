<?php

namespace App\MoonShine\Resources;

use App\Models\Setting;
use App\Models\VacancyPage;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Image;
use MoonShine\Resources\SingletonResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

class VacancyPageResource extends SingletonResource
{
	public static string $model = Setting::class;

	public static string $title = 'Страница вакансии';

    public function getId(): int|string
    {
        return 1;
    }

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Заголовок', 'vacancy_title'),

            Text::make('Текст снизу', 'vacancy_description'),

            Json::make('Преимущества', 'vacancy_advantage')
                ->fields([
                    Image::make('Изображение', 'image_path')
                        ->disableDeleteFiles()
                        ->dir('images/advantages'),

                    Text::make('Преимущество', 'name'),

                    Text::make('Описание', 'description'),
                    
                    
                ])
                ->hideOnIndex()
                ->removable(),
        ];
	}

	public function rules(Model $item): array
    {
        return [];
    }
}
