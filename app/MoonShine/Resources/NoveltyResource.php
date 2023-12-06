<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Novelty;
use MoonShine\Fields\Image;
use MoonShine\Fields\Slug;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;

class NoveltyResource extends Resource
{
	public static string $model = Novelty::class;

	public static string $title = 'Новости';

	public function fields(): array
	{
		return [
            Grid::make('', [
                Column::make('', [
                    Block::make('Основная информация', [
                        ID::make()->sortable(),

                        Text::make('Название новости', 'name')
                            ->required(),

                        Text::make('Описание', 'description')
                            ->required()
                            ->hideOnIndex(),

                        Image::make('Обложка на странице', 'bg_image_path')
                            ->dir('images/news')
                            ->disableDeleteFiles()
                            ->hideOnIndex(),

                        Image::make('Превью новости', 'preview_image_path')
                            ->dir('images/news')
                            ->disableDeleteFiles(),
                    ])
                ])->columnSpan(7),
                Column::make('', [
                    Block::make('Дополнительная информация', [
                        
                        Number::make('Время чтения', 'time_to_read')
                            ->hint('В минутах')
                            ->default(5)
                            ->required(),

                        Date::make('Дата создания', 'created_at')
                            ->default('now-5')
                            ->withTime(),

                        SwitchBoolean::make('Опубликовать', 'show')
                            ->default(False),
                            
                        Slug::make('Slug', 'slug')
                            ->from('name')
                            ->separator('-')
                            ->unique(),
                    ])
                ])->columnSpan(5),
            ]),

            Divider::make(),

            TinyMce::make('Контент', 'content')
                ->required()
                ->hideOnIndex()
                ->required()
                ->hideOnDetail(),
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
