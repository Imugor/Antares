<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Partner;

use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\TinyMce;

class PartnerResource extends Resource
{
	public static string $model = Partner::class;

	public static string $title = 'Партнеры';

    public string $titleField = 'name';

    public bool $createInModal = True;

    public bool $editInModal = True;

    public bool $showInModal = True;

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Text::make('Имя партнера', 'name')
                ->required(),

            Text::make('Ссылка', 'link')
                ->default('/')
                ->required(),

            Image::make('Изображение', 'image_path')
                ->dir('images/partners')
                ->disableDeleteFiles(),

            TinyMce::make('Описание', 'description')
                ->required(),
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
