<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

use MoonShine\Fields\Image;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;

class ProjectResource extends Resource
{
	public static string $model = Project::class;

	public static string $title = 'Реализованные проекты';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Название проекта', 'name')
                ->required(),
            
            Image::make('Обложка', 'image_path')
                ->dir('images/projects')
                ->disableDeleteFiles(),
            
            TinyMce::make('Описание', 'description')
                ->default('Описание')
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
